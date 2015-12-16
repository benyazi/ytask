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
                $statusIds = [1];
                break;
            case "INPROGRESS":
                $statusIds = [2,4];
                break;
            case "TESTING":
                $statusIds = [3];
                break;
            case "DONE":
                $statusIds = [5];
                break;
        }
        $statusArray = [];
        foreach($statusIds as $id) {
            $statusArray[] = $this->container->get("doctrine")->getRepository('AppBundle:IssueStatuses')->find($id);
        }
        $issues =  $this->container->get("doctrine")->getRepository('AppBundle:Tasks')->findBy(
            [
                "project" => $project,
                "status2" => $statusArray
            ]
        );

        return $issues;
    }
}