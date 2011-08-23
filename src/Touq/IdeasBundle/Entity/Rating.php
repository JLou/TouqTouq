<?php

namespace Touq\IdeasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Touq\IdeasBundle\Entity\Rating
 *
 * @ORM\Table(name="ratings")
 * @ORM\Entity
 */
class Rating
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
     * @var Author $author
     *
     * @ORM\ManyToOne(targetEntity="Touq\SecurityBundle\Entity\User")
     */
    private $author;

    /**
     * @var boolean $value
     *
     * @ORM\Column(name="value", type="boolean")
     */
    private $value;

    /**     
     * @var Idea $idea
     * 
     * @ORM\ManyToOne(targetEntity="Idea")
     */
    protected $idea;

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
     * Set author
     *
     * @param integer $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }
    
    /**
     * Get author
     *
     * @return User 
     */
     public function getAuthor()
    {
        return $this->author;
    }

    /**
     *Get idea
     * 
     * @return Idea
     */
    public function getIdea() 
    {
        return $this->idea;
    }

    /**
     * Set idea
     * 
     * @param Idea $idea 
     */
    public function setIdea($idea) 
    {
        $this->idea = $idea;
    }

    /**
     * Set value
     *
     * @param boolean $value
     */
    public function setValue($value)
    {
        $this->value = (bool) $value;
    }

    /**
     * Get value
     *
     * @return boolean 
     */
    public function getValue()
    {
        return (bool) $this->value;
    }
    
    static function cmp_obj($a, $b)
    {
        
        if ($a->getRating() == $b->getRating()) {
            return 0;
        }
        return ($a->getRating() > $b->getRating()) ? +1 : -1;
    }
}