<?php

namespace Dudek\FormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Step
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Step
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
     * @var integer
     *
     * @ORM\Column(name="rank", type="integer")
     */
    private $rank;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Form", inversedBy="steps")
     */
    private $form;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="step", cascade={"all"})
     */
    private $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $rank
     * @return Step
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param string $name
     * @return Step
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \Dudek\FormBundle\Entity\Form $form
     * @return Step
     */
    public function setForm(\Dudek\FormBundle\Entity\Form $form = null)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * @return \Dudek\FormBundle\Entity\Form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param \Dudek\FormBundle\Entity\Question $questions
     * @return Step
     */
    public function addQuestion(\Dudek\FormBundle\Entity\Question $question)
    {
        $this->questions[] = $question;

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
