<?php

namespace HackspaceUni\ChatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Canal
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Canal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombrecanal", type="string", length=255, unique=true)
     */
    private $nombrecanal;


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
     * Set nombrecanal
     *
     * @param string $nombrecanal
     * @return Canal
     */
    public function setNombrecanal($nombrecanal)
    {
        $this->nombrecanal = $nombrecanal;

        return $this;
    }

    /**
     * Get nombrecanal
     *
     * @return string
     */
    public function getNombrecanal()
    {
        return $this->nombrecanal;
    }
}
