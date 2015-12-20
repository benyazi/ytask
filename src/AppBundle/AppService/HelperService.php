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

    public function getRandomAvatar() {
        $array = [
            "daniel.jpg",
            "elliot.jpg",
            "elyse.png",
            "helen.jpg",
            "jenny.jpg",
            "kristy.png",
            "matthew.png",
            "molly.png",
            "steve.jpg",
            "stevie.jpg",
            "veronika.jpg"
        ];
        return "/img/avatars/".$array[array_rand($array)];
    }
}