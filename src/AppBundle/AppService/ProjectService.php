<?php
namespace AppBundle\AppService;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class ProjectService
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getIssueByList($list, $project=null) {
        $status = "NEW";
        switch($list) {
            case "TODO":
                $status = "ASSIGNED";
                break;
            case "INPROGRESS":
                $status = "INPROGRESS";
                break;
            case "TESTING":
                $status = "COMPLETED";
                break;
            case "DONE":
                $status = "CLOSED";
                break;
        }

        $issues =  $this->container->get("doctrine")->getRepository('AppBundle:Tasks')->findBy(
            [
                "project" => $project,
                "status" => $status
            ]
        );

        return $issues;
    }
}