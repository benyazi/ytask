<?php
// src/AppBundle/Repository/ProjectsRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProjectsRepository extends EntityRepository
{
    public function findAllToUser($user) {
        if($user=="anon."||empty($user)) {return null;}
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM AppBundle:Projects p ORDER BY p.name ASC'
            )
            ->getResult();
    }

    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM AppBundle:Product p ORDER BY p.name ASC'
            )
            ->getResult();
    }
}