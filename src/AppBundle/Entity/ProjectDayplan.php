<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectDayplan
 */
class ProjectDayplan
{
    /**
     * @var \DateTime
     */
    private $datePlan;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Tasks
     */
    private $issue;

    /**
     * @var \UserBundle\Entity\User
     */
    private $user;


    /**
     * Set datePlan
     *
     * @param \DateTime $datePlan
     * @return ProjectDayplan
     */
    public function setDatePlan($datePlan)
    {
        $this->datePlan = $datePlan;

        return $this;
    }

    /**
     * Get datePlan
     *
     * @return \DateTime 
     */
    public function getDatePlan()
    {
        return $this->datePlan;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set issue
     *
     * @param \AppBundle\Entity\Tasks $issue
     * @return ProjectDayplan
     */
    public function setIssue(\AppBundle\Entity\Tasks $issue = null)
    {
        $this->issue = $issue;

        return $this;
    }

    /**
     * Get issue
     *
     * @return \AppBundle\Entity\Tasks 
     */
    public function getIssue()
    {
        return $this->issue;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     * @return ProjectDayplan
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
