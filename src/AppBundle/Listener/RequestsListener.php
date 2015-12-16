<?php
namespace AppBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use AppBundle\Entity\Requests;
//use Acme\DemoBundle\Mailer\UserMailer;

class RequestsListener
{
    private $log = array();

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // False check is compulsory otherwise duplication occurs
        if ($entity instanceof Requests) {
            $em = $args->getEntityManager();
            $oldText = $entity->getText();
            $entity->setText($oldText." -> 2 ");
            $em->persist($entity);
            $em->flush();
            $this->log[] = $entity;
        }
    }
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // False check is compulsory otherwise duplication occurs
        if ($entity instanceof Requests) {
            $em = $args->getEntityManager();
            $oldText = $entity->getText();
            $entity->setText($oldText." -> 2 ");
            $em->persist($entity);
            $em->flush();
            $this->log[] = $entity;
        }
    }
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // False check is compulsory otherwise duplication occurs
        if ($entity instanceof Requests) {
            $em = $args->getEntityManager();
            $oldText = $entity->getText();
            $entity->setText($oldText." -> 2 ");
            $em->persist($entity);
            $em->flush();
            $this->log[] = $entity;
        }
    }

    public function postFlush(PostFlushEventArgs $args)
    {
        /*$entity = $args->getEntity();

        // False check is compulsory otherwise duplication occurs
        if ($entity instanceof Requests) {
            $em = $args->getEntityManager();
            $oldText = $entity->getText();
            $entity->setText($oldText." -> 2 ");
            $em->persist($entity);
            $em->flush();
            $this->log[] = $entity;
        }*/
        /*if (! empty($this->log)) {
            $em = $args->getEntityManager();
            foreach ($this->log as $log) {
                $em->persist($log);
            }
            $em->flush();
        }*/
    }
}