<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaskFiles
 */
class TaskFiles
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Mediateka
     */
    private $file;

    /**
     * @var \AppBundle\Entity\Tasks
     */
    private $task;


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
     * Set file
     *
     * @param \AppBundle\Entity\Mediateka $file
     * @return TaskFiles
     */
    public function setFile(\AppBundle\Entity\Mediateka $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \AppBundle\Entity\Mediateka 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set task
     *
     * @param \AppBundle\Entity\Tasks $task
     * @return TaskFiles
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
}
