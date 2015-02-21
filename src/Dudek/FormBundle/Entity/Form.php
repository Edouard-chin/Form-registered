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
     * @ORM\OneToMany(targetEntity="Question", mappedBy="form", cascade={"all"})
     */
    protected $questions;


    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->created = new \DateTime();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \DateTime $created
     * @return Form
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $opendate
     * @return Form
     */
    public function setOpendate($opendate)
    {
        $this->opendate = $opendate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOpendate()
    {
        return $this->opendate;
    }

    /**
     * @param \DateTime $closedate
     * @return Form
     */
    public function setClosedate($closedate)
    {
        $this->closedate = $closedate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getClosedate()
    {
        return $this->closedate;
    }

    /**
     * @param \Dudek\FormBundle\Entity\Question $questions
     * @return Form
     */
    public function addQuestion(\Dudek\FormBundle\Entity\Question $question)
    {
        $this->questions[] = $question;
        $question->setForm($this);

        return $this;
    }

    /**
     * @param \Dudek\FormBundle\Entity\Question $questions
     */
    public function removeQuestion(\Dudek\FormBundle\Entity\Question $question)
    {
        $this->questions->removeElement($question);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestions()
    {
        return $this->questions;
    }
}
