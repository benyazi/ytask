<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectUsers
 */
class ProjectUsers
{
    /**
     * @var integer
     */
    private $roleId;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Projects
     */
    private $project;

    /**
     * @var \UserBundle\Entity\User
     */
    private $user;


    /**
     * Set roleId
     *
     * @param integer $roleId
     * @return ProjectUsers
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Get roleId
     *
     * @return integer 
     */
    public function getRoleId()
    {
        return $this->roleId;
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
     * Set project
     *
     * @param \AppBundle\Entity\Projects $project
     * @return ProjectUsers
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
     * @return ProjectUsers
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
    /**
     * @var \AppBundle\Entity\ProjectRoles
     */
    private $role;


    /**
     * Set role
     *
     * @param \AppBundle\Entity\ProjectRoles $role
     * @return ProjectUsers
     */
    public function setRole(\AppBundle\Entity\ProjectRoles $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \AppBundle\Entity\ProjectRoles 
     */
    public function getRole()
    {
        return $this->role;
    }
}
