<?php namespace Origami\Permissions\Acl;

use InvalidParametersException;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Exception\InvalidArgumentException;

class ZendAclAdapter implements AclInterface {

    /**
     * @var Acl
     */
    private $acl;

    public function __construct(Acl $acl)
    {
        $this->acl = $acl;
    }

    public function getResources()
    {
        return $this->acl->getResources();
    }

    public function setResources(array $resources)
    {
        $this->acl->removeResourceAll();

        foreach ( $resources as $name ) {
            $this->acl->addResource($name);
        }

        return $this;
    }

    public function addResource($name)
    {
        $this->acl->addResource($name);

        return $this;
    }

    public function removeResource($name)
    {
        $this->acl->removeResource($name);

        return $this;
    }

    public function getRoles()
    {
        return $this->acl->getRoles();
    }

    public function addRole($name, $parents = null)
    {
        $this->acl->addRole($name, $parents);

        return $this;
    }

    public function removeRole($name)
    {
        $this->acl->removeRole($name);

        return $this;
    }

    public function allow($role, $resource, $permission)
    {
        $this->acl->allow($role, $resource, $permission);

        return $this;
    }

    public function deny($role, $resource, $permission)
    {
        $this->acl->deny($role, $resource, $permission);

        return $this;
    }

    public function isAllowed($role, $resource, $permission)
    {
        try {
            return $this->acl->isAllowed($role, $resource, $permission);
        } catch ( InvalidArgumentException $e ) {
            throw new InvalidParametersException($e->getMessage());
        }
    }

    public function hasResource($name)
    {
        return $this->acl->hasResource($name);
    }
}