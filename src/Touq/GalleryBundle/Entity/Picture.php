<?php

namespace Touq\GaleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Touq\GaleryBundle\Entity\Picture
 *
 * @ORM\Table(name="pictures")
 * @ORM\Entity
 */
class Picture
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var datetime $postDate
     *
     * @ORM\Column(name="postDate", type="datetime")
     */
    private $postDate;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer $postedBy
     *
     * @ORM\Column(name="postedBy", type="integer")
     */
    private $postedBy;

    /**
     * @var Album $album
     * @ORM\ManyToOne(targetEntity="Album")
     * @ORM\JoinColumn(name="album_id", referencedColumnName="id")
     */
    private $album;


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
     * Set postDate
     *
     * @param datetime $postDate
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;
    }

    /**
     * Get postDate
     *
     * @return datetime 
     */
    public function getPostDate()
    {
        return $this->postDate;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set postedBy
     *
     * @param integer $postedBy
     */
    public function setPostedBy($postedBy)
    {
        $this->postedBy = $postedBy;
    }

    /**
     * Get postedBy
     *
     * @return integer 
     */
    public function getPostedBy()
    {
        return $this->postedBy;
    }

    /**
     * Set album
     *
     * @param string $album
     */
    public function setAlbum($album)
    {
        $this->album = $album;
    }

    /**
     * Get album
     *
     * @return string 
     */
    public function getAlbum()
    {
        return $this->album;
    }
}