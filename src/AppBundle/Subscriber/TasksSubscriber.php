<?php
// src/Acme/SearchBundle/EventListener/SearchIndexerSubscriber.php
namespace AppBundle\Subscriber;

use AppBundle\Entity\HistoryLog;
use AppBundle\Entity\Tasks;
use AppBundle\Entity\IssuePriority;
use AppBundle\Entity\IssueResolutions;
use AppBundle\Entity\IssueStatuses;
use AppBundle\Entity\IssueTypes;
use AppBundle\Form\Type\IssueType;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class TasksSubscriber implements EventSubscriber
{
    protected $container;
    private $type;
    private $uow;
    private $changeSet;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getSubscribedEvents()
    {
        return array(
            'postPersist',
            'postUpdate',
            'preUpdate',
        );
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->uow = $args->getEntityManager()->getUnitOfWork();
        $this->uow->computeChangeSets();
        $this->changeSet = $this->uow->getEntityChangeSet($entity);

        //$this->container->get('doctrine')->getRepository('AppBundle:Requests')->find($args->getEntity()->getId());
        //$this->oldObj = $args->getEntity();
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->type = "update";
        $this->index($args);
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->type = "create";
        $this->index($args);
    }

    public function updateCalls(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        //$calls = $entity->getCalls();

    }

    public function index(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        // perhaps you only want to act on some "Product" entity
        if ($entity instanceof Tasks) {
            $history = new HistoryLog();
            $history->setTask($entity);
            $history->setHistoryDate(new \DateTime());
            $action = "Unknow action";
            switch($this->type) {
                case "create":
                    $action = $this->container->get('translator')->trans('Created issue.');
                    break;
                case "update":
                    $action = $this->container->get('translator')->trans('Updated issue.');
                    if(count($this->changeSet)>0) {
                        if(isset($this->changeSet["status"])) {
                            //Типа статус был изменен
                            switch($this->changeSet["status"][1]) {
                                case 1:
                                    $action = $this->container->get('translator')->trans('Set issue status to OPEN').".";
                                    break;
                                case 2:
                                    $action = $this->container->get('translator')->trans('Set issue status to INPROGRESS').".";
                                    break;
                                case 3:
                                    $action = $this->container->get('translator')->trans('Set issue status to RESOLVED').".";
                                    break;
                                case 4:
                                    $action = $this->container->get('translator')->trans('Set issue status to REOPENED').".";
                                    break;
                                case 5:
                                    $action = $this->container->get('translator')->trans('Set issue status to CLOSED').".";
                                    break;
                            }
                        }
                        elseif(count($this->changeSet)>0) {
                            //Чтото было обновлено
                            $action = $this->container->get('translator')->trans('In issue updated rows').":</br>";
                            foreach ($this->changeSet as $key=>$data) {
                                for($i=0;$i<=1;$i++) {
                                    if($data[$i] instanceof \DateTime) {
                                        $data[$i] = $data[$i]->format("d.m.Y H:i:s");
                                    }
                                    elseif($data[$i] instanceof IssuePriority) {
                                        $data[$i] = $data[$i]->getName();
                                    }
                                    elseif($data[$i] instanceof IssueStatuses) {
                                        $data[$i] = $data[$i]->getName();
                                    }
                                    elseif($data[$i] instanceof IssueTypes) {
                                        $data[$i] = $data[$i]->getName();
                                    }
                                    elseif($data[0] instanceof IssueResolutions) {
                                        $data[$i] = $data[$i]->getName();
                                    }
                                    elseif($data[$i] instanceof User) {
                                        $data[$i] = $data[$i]->getName();
                                    }
                                }
                                $action .= "<strong>".$key."</strong> updated ".
                                    "<strong>".$data[0]."</strong> &rarr; ".
                                    "<strong>".$data[1]."</strong></br>";
                            }
                        }
                    }
                    break;
            }
            $history->setActionType($this->type);
            $history->setAction($action);
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $history->setUser($user);
            $entityManager->persist($history);
            $entityManager->flush();
            // ... do something with the Product
        }
    }
}