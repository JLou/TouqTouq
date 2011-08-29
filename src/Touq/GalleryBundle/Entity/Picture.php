<?php

namespace Touq\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Touq\GalleryBundle\Entity\Picture
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
     * @var text $description
     *
     * @ORM\Column(name="description", type="text", nullable="true")
     */
    private $description;

    /**
     * @var integer $postedBy
     *
     * @ORM\Column(name="postedBy", type="integer", nullable="true")
     */
    private $postedBy;

    /**
     * @var Album $album
     * @ORM\ManyToOne(targetEntity="Album")
     * @ORM\JoinColumn(name="album_id", referencedColumnName="id")
     */
    private $album;

    /**
     * @var string $url
     * 
     * @ORM\Column(name="url", type="string", length="255")
     */
    private $url;
    
    /**
     *
     * @var Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @Assert\Image(
     *     maxSize = "4M"     
     * )
     */
    protected $file;
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId()
    {
        
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
    
    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }
    
    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->file) {
            return;
        }
        
        // set the path property to the filename where you will save the file
        $this->setUrl(uniqid() . '.' . $this->file->guessExtension());
        
        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the target filename to move to
        $this->file->move($this->getUploadRootDir(), $this->getUrl());

        
        

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

    public function getAbsolutePath()
    {
        return null === $this->url ? null : $this->getUploadRootDir().'/'.$this->url;
    }

    public function getWebPath()
    {
        return null === $this->url ? null : $this->getUploadDir().'/'.$this->url;
    }
    
    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    
    public function getUploadDir()
    {
        return 'uploads/gallery';
    }
}