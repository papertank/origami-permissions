<?php namespace Origami\Permissions;

trait PermissionTrait {

    abstract public function getRole();

    public function can($resource, $permission)
    {
        return app('acl')->isAllowed($this->getRole(), $resource, $permission);
    }

    public function cannot($resource, $permission)
    {
        return ! $this->can($resource, $permission);
    }

}