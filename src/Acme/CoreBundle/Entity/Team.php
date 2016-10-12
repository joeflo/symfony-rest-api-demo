<?php

namespace Acme\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity()
 */
class Team
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="mascot", type="string", length=255)
     */
    private $mascot;

    /**
     * @var ArrayCollection|Athlete[]
     *
     * @ORM\OneToMany(targetEntity="Acme\CoreBundle\Entity\Athlete", mappedBy="team", cascade={"persist"})
     */
    private $athletes;

    /**
     * Team constructor.
     */
    public function __construct()
    {
        $this->athletes = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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

    /**
     * Set mascot
     *
     * @param string $mascot
     *
     * @return Team
     */
    public function setMascot($mascot)
    {
        $this->mascot = $mascot;

        return $this;
    }

    /**
     * Get mascot
     *
     * @return string
     */
    public function getMascot()
    {
        return $this->mascot;
    }

    /**
     * @return Athlete[]|ArrayCollection
     */
    public function getAthletes()
    {
        return $this->athletes;
    }

    /**
     * @param Athlete[]|ArrayCollection $athletes
     *
     * @return $this
     */
    public function setAthletes($athletes)
    {
        $this->athletes = $athletes;

        return $this;
    }

    /**
     * @param Athlete $athlete
     *
     * @return $this
     */
    public function addAthlete(Athlete $athlete)
    {
        $this->athletes->add($athlete);

        return $this;
    }

    /**
     * @param Athlete $athlete
     *
     * @return $this
     */
    public function removeAthlete(Athlete $athlete)
    {
        $this->athletes->removeElement($athlete);

        return $this;
    }
}

