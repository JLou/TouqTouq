<?php

namespace Touq\IdeasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Touq\InventoryBundle\Entity\ItemCategory as ItemCategory;
/**
 * Touq\IdeasBundle\Entity\Idea
 *
 * @ORM\Table(name="ideas")
 * @ORM\Entity
 */
class Idea
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
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @var integer $category
     *
     * @ORM\ManyToOne(targetEntity="Touq\InventoryBundle\Entity\ItemCategory")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var text $content
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;
    
    /**
     *
     * @var Array $comments
     * 
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="idea")
     */
    protected $comments;

    /**
     * @var integer $totalRatings
     */
    protected $totalRatings;
    
    /**
     * @var integer $rating
     */
    private $rating;
    
    /**
     * @var array $ratings
     * 
     * @ORM\OneToMany(targetEntity="Rating", mappedBy="idea")
     */
    protected $ratings;

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
     * @param Author $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return integer 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set category
     *
     * @param integer $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return integer 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        if($this->rating == null)
        {
            $positive = 0;
            $this->rating = 0;
            foreach ($this->ratings as $rating)
            {
                if($rating->getValue())
                    $positive++;
//                else
//                    $this->rating--
            }
            $this->rating = $positive * 100 / $this->getTotalRatings();
        }
        return $this->rating;
    }
    
    public function getRatings() 
    {
        return $this->ratings;
    }
    
    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    
    public function setRatings($ratings) 
    {
        $this->ratings = $ratings;
    }
    public function getTotalRatings()
    {
        if($this->totalRatings == null)
        {
            $this->totalRatings = count($this->ratings);
        }
        return $this->totalRatings;
    }

    public function setTotalRatings($totalRatings)
    {
        $this->totalRatings = $totalRatings;
    }



}