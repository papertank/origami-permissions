<?php namespace Origami\Permissions\Acl;

interface AclInterface {

    public function getResources();
    public function setResources(array $resources);
    public function addResource($name);
    public function hasResource($name);
    public function removeResource($name);

    public function getRoles();
    public function addRole($name, $parents = null);
    public function removeRole($name);

    public function allow($role, $resource, $permission);
    public function deny($role, $resource, $permission);

    public function isAllowed($role, $resource, $permission);

}