<?php

namespace OC\GameCriticBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Critic
 *
 * @ORM\Table(name="critic")
 * @ORM\Entity(repositoryClass="OC\GameCriticBundle\Repository\CriticRepository")
 */
class Critic
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
     * @ORM\Column(name="score", type="decimal", precision=4, scale=2)
     */
    private $score;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="report_counter", type="integer")
     */
    private $reportCounter;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\ManyToOne(targetEntity="OC\GameCriticBundle\Entity\Game", inversedBy="critics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\User")
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setScore('5');
        $this->setCreationDate(new \DateTime());
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
     * Set score
     *
     * @param string $score
     *
     * @return Critic
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
     * Set content
     *
     * @param string $content
     *
     * @return Critic
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Critic
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set game
     *
     * @param \OC\GameCriticBundle\Entity\Game $game
     *
     * @return Critic
     */
    public function setGame(\OC\GameCriticBundle\Entity\Game $game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \OC\GameCriticBundle\Entity\Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set user
     *
     * @param \OC\UserBundle\Entity\User $user
     *
     * @return Critic
     */
    public function setUser(\OC\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \OC\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set reportCounter
     *
     * @param integer $reportCounter
     *
     * @return Critic
     */
    public function setReportCounter($reportCounter)
    {
        $this->reportCounter = $reportCounter;

        return $this;
    }

    /**
     * Get reportCounter
     *
     * @return integer
     */
    public function getReportCounter()
    {
        return $this->reportCounter;
    }
}
