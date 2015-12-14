<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistoryLog
 */
class HistoryLog
{
    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $actionType;

    /**
     * @var string
     */
    private $meta;

    /**
     * @var \DateTime
     */
    private $historyDate;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Tasks
     */
    private $task;

    /**
     * @var \AppBundle\Entity\Projects
     */
    private $project;

    /**
     * @var \UserBundle\Entity\User
     */
    private $user;


    /**
     * Set action
     *
     * @param string $action
     * @return HistoryLog
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set actionType
     *
     * @param string $actionType
     * @return HistoryLog
     */
    public function setActionType($actionType)
    {
        $this->actionType = $actionType;

        return $this;
    }

    /**
     * Get actionType
     *
     * @return string 
     */
    public function getActionType()
    {
        return $this->actionType;
    }

    /**
     * Set meta
     *
     * @param string $meta
     * @return HistoryLog
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Get meta
     *
     * @return string 
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Set historyDate
     *
     * @param \DateTime $historyDate
     * @return HistoryLog
     */
    public function setHistoryDate($historyDate)
    {
        $this->historyDate = $historyDate;

        return $this;
    }

    /**
     * Get historyDate
     *
     * @return \DateTime 
     */
    public function getHistoryDate()
    {
        return $this->historyDate;
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
     * Set task
     *
     * @param \AppBundle\Entity\Tasks $task
     * @return HistoryLog
     */
    public function setTask(\AppBundle\Entity\Tasks $task = null)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return \AppBundle\Entity\Tasks 
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Set project
     *
     * @param \AppBundle\Entity\Projects $project
     * @return HistoryLog
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
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     * @return HistoryLog
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
