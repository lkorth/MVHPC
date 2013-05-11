<?php

namespace MVHPC\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nid", type="string", length=32, nullable=false)
     */
    private $nid;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=65, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=65, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="level", type="string", length=128, nullable=false)
     */
    private $level;



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
     * Set nid
     *
     * @param string $nid
     * @return Users
     */
    public function setNid($nid)
    {
        $this->nid = $nid;
    
        return $this;
    }

    /**
     * Get nid
     *
     * @return string 
     */
    public function getNid()
    {
        return $this->nid;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set level
     *
     * @param string $level
     * @return Users
     */
    public function setLevel($level)
    {
        $this->level = $level;
    
        return $this;
    }

    /**
     * Get level
     *
     * @return string 
     */
    public function getLevel()
    {
        return $this->level;
    }
}