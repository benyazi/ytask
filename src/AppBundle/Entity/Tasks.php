<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tasks
 */
class Tasks
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $dateCreate;

    /**
     * @var \DateTime
     */
    private $dateDue;

    /**
     * @var \DateTime
     */
    private $dateClosed;

    /**
     * @var string
     */
    private $status;

    /**
     * @var integer
     */
    private $deleted;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Sprints
     */
    private $sprint;

    /**
     * @var \AppBundle\Entity\IssueStatuses
     */
    private $status2;

    /**
     * @var \AppBundle\Entity\IssuePriority
     */
    private $priority;

    /**
     * @var \AppBundle\Entity\IssueResolutions
     */
    private $resolution;

    /**
     * @var \AppBundle\Entity\Projects
     */
    private $project;

    /**
     * @var \AppBundle\Entity\IssueTypes
     */
    private $type;

    /**
     * @var \UserBundle\Entity\User
     */
    private $userCreate;


    /**
     * Set name
     *
     * @param string $name
     * @return Tasks
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Tasks
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Tasks
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     * @return Tasks
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return \DateTime 
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * Set dateDue
     *
     * @param \DateTime $dateDue
     * @return Tasks
     */
    public function setDateDue($dateDue)
    {
        $this->dateDue = $dateDue;

        return $this;
    }

    /**
     * Get dateDue
     *
     * @return \DateTime 
     */
    public function getDateDue()
    {
        return $this->dateDue;
    }

    /**
     * Set dateClosed
     *
     * @param \DateTime $dateClosed
     * @return Tasks
     */
    public function setDateClosed($dateClosed)
    {
        $this->dateClosed = $dateClosed;

        return $this;
    }

    /**
     * Get dateClosed
     *
     * @return \DateTime 
     */
    public function getDateClosed()
    {
        return $this->dateClosed;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Tasks
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     * @return Tasks
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return integer 
     */
    public function getDeleted()
    {
        return $this->deleted;
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
     * Set sprint
     *
     * @param \AppBundle\Entity\Sprints $sprint
     * @return Tasks
     */
    public function setSprint(\AppBundle\Entity\Sprints $sprint = null)
    {
        $this->sprint = $sprint;

        return $this;
    }

    /**
     * Get sprint
     *
     * @return \AppBundle\Entity\Sprints 
     */
    public function getSprint()
    {
        return $this->sprint;
    }

    /**
     * Set status2
     *
     * @param \AppBundle\Entity\IssueStatuses $status2
     * @return Tasks
     */
    public function setStatus2(\AppBundle\Entity\IssueStatuses $status2 = null)
    {
        $this->status2 = $status2;

        return $this;
    }

    /**
     * Get status2
     *
     * @return \AppBundle\Entity\IssueStatuses 
     */
    public function getStatus2()
    {
        return $this->status2;
    }

    /**
     * Set priority
     *
     * @param \AppBundle\Entity\IssuePriority $priority
     * @return Tasks
     */
    public function setPriority(\AppBundle\Entity\IssuePriority $priority = null)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return \AppBundle\Entity\IssuePriority 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set resolution
     *
     * @param \AppBundle\Entity\IssueResolutions $resolution
     * @return Tasks
     */
    public function setResolution(\AppBundle\Entity\IssueResolutions $resolution = null)
    {
        $this->resolution = $resolution;

        return $this;
    }

    /**
     * Get resolution
     *
     * @return \AppBundle\Entity\IssueResolutions 
     */
    public function getResolution()
    {
        return $this->resolution;
    }

    /**
     * Set project
     *
     * @param \AppBundle\Entity\Projects $project
     * @return Tasks
     */
    public function setProject(\AppBundle\Entity\Projects $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \AppBundle\Entity\Projects 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\IssueTypes $type
     * @return Tasks
     */
    public function setType(\AppBundle\Entity\IssueTypes $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\IssueTypes 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set userCreate
     *
     * @param \UserBundle\Entity\User $userCreate
     * @return Tasks
     */
    public function setUserCreate(\UserBundle\Entity\User $userCreate = null)
    {
        $this->userCreate = $userCreate;

        return $this;
    }

    /**
     * Get userCreate
     *
     * @return \UserBundle\Entity\User
     */
    public function getUserCreate()
    {
        return $this->userCreate;
    }
}
