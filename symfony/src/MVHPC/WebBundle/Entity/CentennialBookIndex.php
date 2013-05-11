<?php

namespace MVHPC\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CentennialBookIndex
 *
 * @ORM\Table(name="centennial_book_index")
 * @ORM\Entity
 */
class CentennialBookIndex
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
     * @ORM\Column(name="letter", type="string", length=1, nullable=false)
     */
    private $letter;

    /**
     * @var string
     *
     * @ORM\Column(name="index", type="string", length=80, nullable=false)
     */
    private $index;

    /**
     * @var string
     *
     * @ORM\Column(name="pages", type="string", length=100, nullable=false)
     */
    private $pages;



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
     * Set letter
     *
     * @param string $letter
     * @return CentennialBookIndex
     */
    public function setLetter($letter)
    {
        $this->letter = $letter;
    
        return $this;
    }

    /**
     * Get letter
     *
     * @return string 
     */
    public function getLetter()
    {
        return $this->letter;
    }

    /**
     * Set index
     *
     * @param string $index
     * @return CentennialBookIndex
     */
    public function setIndex($index)
    {
        $this->index = $index;
    
        return $this;
    }

    /**
     * Get index
     *
     * @return string 
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Set pages
     *
     * @param string $pages
     * @return CentennialBookIndex
     */
    public function setPages($pages)
    {
        $this->pages = $pages;
    
        return $this;
    }

    /**
     * Get pages
     *
     * @return string 
     */
    public function getPages()
    {
        return $this->pages;
    }
}