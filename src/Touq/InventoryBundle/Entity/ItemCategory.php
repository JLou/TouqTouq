<?php

namespace Touq\InventoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Touq\InventoryBundle\Entity\ItemCategory
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity
 */
class ItemCategory
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     *
     * @var array $items
     * 
     * @ORM\OneToMany(targetEntity="Item", mappedBy="type")
     */
    public $items;
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    public function __toString()
    {
        return $this->getName();
    }
}