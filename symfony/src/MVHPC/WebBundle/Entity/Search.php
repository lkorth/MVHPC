<?php

namespace MVHPC\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Search
 *
 * @ORM\Table(name="search")
 * @ORM\Entity
 */
class Search
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
     * @ORM\Column(name="location", type="string", length=5000, nullable=false)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="medlg", type="string", length=5000, nullable=false)
     */
    private $medlg;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnail", type="string", length=5000, nullable=false)
     */
    private $thumbnail;

    /**
     * @var string
     *
     * @ORM\Column(name="mid", type="string", length=5000, nullable=false)
     */
    private $mid;

    /**
     * @var string
     *
     * @ORM\Column(name="information", type="text", nullable=true)
     */
    private $information;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="text", nullable=true)
     */
    private $tags;

    /**
     * @var string
     *
     * @ORM\Column(name="views", type="string", length=5000, nullable=false)
     */
    private $views;

    /**
     * @var string
     *
     * @ORM\Column(name="trueviews", type="string", length=5000, nullable=false)
     */
    private $trueviews;

    /**
     * @var integer
     *
     * @ORM\Column(name="edit", type="integer", nullable=false)
     */
    private $edit;

    /**
     * @var integer
     *
     * @ORM\Column(name="live", type="integer", nullable=false)
     */
    private $live;



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
     * Set location
     *
     * @param string $location
     * @return Search
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set medlg
     *
     * @param string $medlg
     * @return Search
     */
    public function setMedlg($medlg)
    {
        $this->medlg = $medlg;
    
        return $this;
    }

    /**
     * Get medlg
     *
     * @return string 
     */
    public function getMedlg()
    {
        return $this->medlg;
    }

    /**
     * Set thumbnail
     *
     * @param string $thumbnail
     * @return Search
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
    
        return $this;
    }

    /**
     * Get thumbnail
     *
     * @return string 
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set mid
     *
     * @param string $mid
     * @return Search
     */
    public function setMid($mid)
    {
        $this->mid = $mid;
    
        return $this;
    }

    /**
     * Get mid
     *
     * @return string 
     */
    public function getMid()
    {
        return $this->mid;
    }

    /**
     * Set information
     *
     * @param string $information
     * @return Search
     */
    public function setInformation($information)
    {
        $this->information = $information;
    
        return $this;
    }

    /**
     * Get information
     *
     * @return string 
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return Search
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    
        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set views
     *
     * @param string $views
     * @return Search
     */
    public function setViews($views)
    {
        $this->views = $views;
    
        return $this;
    }

    /**
     * Get views
     *
     * @return string 
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set trueviews
     *
     * @param string $trueviews
     * @return Search
     */
    public function setTrueviews($trueviews)
    {
        $this->trueviews = $trueviews;
    
        return $this;
    }

    /**
     * Get trueviews
     *
     * @return string 
     */
    public function getTrueviews()
    {
        return $this->trueviews;
    }

    /**
     * Set edit
     *
     * @param integer $edit
     * @return Search
     */
    public function setEdit($edit)
    {
        $this->edit = $edit;
    
        return $this;
    }

    /**
     * Get edit
     *
     * @return integer 
     */
    public function getEdit()
    {
        return $this->edit;
    }

    /**
     * Set live
     *
     * @param integer $live
     * @return Search
     */
    public function setLive($live)
    {
        $this->live = $live;
    
        return $this;
    }

    /**
     * Get live
     *
     * @return integer 
     */
    public function getLive()
    {
        return $this->live;
    }
}