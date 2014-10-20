<?php namespace Origami\Permissions;

use Origami\Permissions\AclInterface;
use InvalidParametersException;
use Zend\Permissions\Acl\Exception\InvalidArgumentException;

class Acl implements AclInterface
{
    /**
     * @var AclInterface
     */
    private $driver;

    public function __construct(AclInterface $driver)
    {
        $this->driver = $driver;
    }

    public function getResources()
    {
        return $this->driver->getResources();
    }

    public function setResources(array $resources)
    {
        return $this->driver->setResources($resources);
    }

    public function addResource($name)
    {
        return $this->driver->addResource($name);
    }

    public function removeResource($name)
    {
        return $this->driver->removeResource($name);
    }

    public function getRoles()
    {
        return $this->driver->getRoles();
    }

    public function addRole($name, $parents = null)
    {
        return $this->driver->addRole($name, $parents);
    }

    public function removeRole($name)
    {
        return $this->driver->removeRole($name);
    }

    public function allow($role, $resource, $permission)
    {
        return $this->driver->allow($role, $resource, $permission);
    }

    public function deny($role, $resource, $permission)
    {
        return $this->driver->deny($role, $resource, $permission);
    }

    public function isAllowed($role, $resource, $permission)
    {
        return $this->driver->isAllowed($role, $resource, $permission);
    }

    public function hasResource($name)
    {
        return $this->driver->hasResource($name);
    }
}