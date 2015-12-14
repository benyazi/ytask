<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaskComments
 */
class TaskComments
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var \DateTime
     */
    private $createDate;

    /**
     * @var integer
     */
    private $deleted;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Tasks
     */
    private $task;

    /**
     * @var \UserBundle\Entity\User
     */
    private $user;


    /**
     * Set text
     *
     * @param string $text
     * @return TaskComments
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return TaskComments
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime 
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     * @return TaskComments
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
     * Set task
     *
     * @param \AppBundle\Entity\Tasks $task
     * @return TaskComments
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
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     * @return TaskComments
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
