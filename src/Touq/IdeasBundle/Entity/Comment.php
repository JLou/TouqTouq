<?php

/**
 * Description of Comment
 *
 * @author JLou
 */
namespace Touq\IdeasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="comments")
 * @ORM\Entity
 */
class Comment
{
    /**
     *
     * @var integer $id
     * 
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     *
     * @var User $author
     * 
     * @ORM\ManyToOne(targetEntity="Touq\SecurityBundle\Entity\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    protected  $author;
    
    /**
     *
     * @var Idea $idea
     * 
     * @ORM\ManyToOne(targetEntity="Idea")
     */
    protected $idea;
    
    /**
     *
     * @var string $content
     * 
     * @ORM\Column(name="content", type="text")
     */
    protected $content;
    
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     *
     * @param User $author 
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getIdea()
    {
        return $this->idea;
    }

    public function setIdea($idea)
    {
        $this->idea = $idea;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
    
    
}