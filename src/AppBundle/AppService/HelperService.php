<?php
namespace AppBundle\AppService;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HelperService
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function isCurrent($route) {
        $routeName = $this->container->get('request')->get('_route');
        if($route == $routeName) {
            return true;
        }
        return false;
    }
}