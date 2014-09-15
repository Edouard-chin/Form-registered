<?php

namespace Dudek\FormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Form
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dudek\FormBundle\Entity\FormRepository")
 */
class Form
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="opendate", type="datetime")
     */
    private $opendate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="closedate", type="datetime")
     */
    private $closedate;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="form")
     */
    protected $questions;


    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

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
     * Set created
     *
     * @param \DateTime $created
     * @return Form
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set opendate
     *
     * @param \DateTime $opendate
     * @return Form
     */
    public function setOpendate($opendate)
    {
        $this->opendate = $opendate;

        return $this;
    }

    /**
     * Get opendate
     *
     * @return \DateTime 
     */
    public function getOpendate()
    {
        return $this->opendate;
    }

    /**
     * Set closedate
     *
     * @param \DateTime $closedate
     * @return Form
     */
    public function setClosedate($closedate)
    {
        $this->closedate = $closedate;

        return $this;
    }

    /**
     * Get closedate
     *
     * @return \DateTime 
     */
    public function getClosedate()
    {
        return $this->closedate;
    }

    /**
     * Add questions
     *
     * @param \Dudek\FormBundle\Entity\Question $questions
     * @return Form
     */
    public function addQuestion(\Dudek\FormBundle\Entity\Question $questions)
    {
        $this->questions[] = $questions;

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \Dudek\FormBundle\Entity\Question $questions
     */
    public function removeQuestion(\Dudek\FormBundle\Entity\Question $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestions()
    {
        return $this->questions;
    }
}
