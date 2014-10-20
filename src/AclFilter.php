<?php namespace Origami\Permissions;

use Illuminate\Auth\AuthManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Origami\Permissions\Acl;
use Origami\Permissions\Exceptions\PermissionException;

class AclFilter {

    /**
     * @var AuthManager
     */
    private $auth;
    /**
     * @var Acl
     */
    private $acl;

    public function __construct(AuthManager $auth, Acl $acl)
    {
        $this->auth = $auth;
        $this->acl = $acl;
    }

    public function filter($route, $request)
    {
        if ( $this->auth->guest() ) {
            return Redirect::guest('login');
        }

        $name = $route->getName();

        if ( $this->isAclResource($name) && ! $this->checkPermission($name) ) {
            throw new PermissionException('You are not permitted to perform this action');
        }
    }

    public function isAclResource($name)
    {
        return $this->acl->hasResource($name);
    }

    private function checkPermission($name)
    {
        $parts = new Collection(explode('.', $name));

        $resource = $parts->first();
        $action = ( $parts->count() > 1 ? $parts->last() : null );

        switch ( $action ) {
            case 'index':
                $permission = 'search';
                break;
            case 'create':
            case 'store':
                $permission = 'create';
                break;
            case 'edit':
            case 'update':
                $permission = 'update';
                break;
            case 'destroy':
                $permission = 'delete';
            default:
                $permission = null;
        }

        return $this->auth->user()->can($resource, $permission);
    }

}