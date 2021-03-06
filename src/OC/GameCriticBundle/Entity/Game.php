<?php

namespace OC\GameCriticBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="OC\GameCriticBundle\Repository\GameRepository")
 */
class Game
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="score", type="decimal", precision=4, scale=2)
     */
    private $score;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="release_date", type="date")
     */
    private $releaseDate;

    /**
     * @ORM\OneToOne(targetEntity="OC\GameCriticBundle\Entity\Image", cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

     /**
     * @ORM\OneToMany(targetEntity="OC\GameCriticBundle\Entity\Critic", mappedBy="game")
     */
    private $critics;

    /**
     * @ORM\ManyToMany(targetEntity="OC\GameCriticBundle\Entity\Platform", cascade={"persist"})
     */
    private $platforms;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->critics = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Game
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
     * Set description
     *
     * @param string $description
     *
     * @return Game
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set score
     *
     * @param string $score
     *
     * @return Game
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return string
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set releaseDate
     *
     * @param \DateTime $releaseDate
     *
     * @return Game
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate
     *
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Add critic
     *
     * @param \OC\GameCriticBundle\Entity\Critic $critic
     *
     * @return Game
     */
    public function addCritic(\OC\GameCriticBundle\Entity\Critic $critic)
    {
        $this->critics[] = $critic;

        $critic->setAdvert($this);

        return $this;
    }

    /**
     * Remove critic
     *
     * @param \OC\GameCriticBundle\Entity\Critic $critic
     */
    public function removeCritic(\OC\GameCriticBundle\Entity\Critic $critic)
    {
        $this->critics->removeElement($critic);
    }

    /**
     * Get critics
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCritics()
    {
        return $this->critics;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString() {
        return $this->getName();
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Game
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set image
     *
     * @param \OC\GameCriticBundle\Entity\Image $image
     *
     * @return Game
     */
    public function setImage(\OC\GameCriticBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \OC\GameCriticBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add platform
     *
     * @param \OC\GameCriticBundle\Entity\Platform $platform
     *
     * @return Game
     */
    public function addPlatform(\OC\GameCriticBundle\Entity\Platform $platform)
    {
        $this->platforms[] = $platform;

        return $this;
    }

    /**
     * Remove platform
     *
     * @param \OC\GameCriticBundle\Entity\Platform $platform
     */
    public function removePlatform(\OC\GameCriticBundle\Entity\Platform $platform)
    {
        $this->platforms->removeElement($platform);
    }

    /**
     * Get platforms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlatforms()
    {
        return $this->platforms;
    }
}
