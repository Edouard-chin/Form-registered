<?php

namespace Dudek\FormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Question
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Question
{
    const TYPE_DATE = 'date';
    const TYPE_DATETIME = 'datetime';
    const TYPE_STRING = 'text';
    const TYPE_TEXT = 'textarea';
    const TYPE_CHOICE = 'choice';
    const TYPE_MULTI_CHOICES = 'multi-choices';
    const TYPE_NUMBER = 'number';


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
     * @ORM\Column(name="Rank", type="integer")
     */
    private $rank = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Step", inversedBy="questions")
     */
    private $step;

    /**
     * @ORM\OneToMany(targetEntity="Choice", mappedBy="question", cascade={"all"})
     */
    private $choices;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question")
     */
    private $answers;

    public function __construct()
    {
        $this->choices = new ArrayCollection();
        $this->answers = new ArrayCollection();
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
     * @return Question
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
     * @param string $type
     * @return Question
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $name
     * @return Question
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
     * @param \Dudek\FormBundle\Entity\Step $step
     * @return Question
     */
    public function setStep(\Dudek\FormBundle\Entity\Step $step = null)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * @return \Dudek\FormBundle\Entity\Step
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * @param \Dudek\FormBundle\Entity\Choice $choices
     * @return Question
     */
    public function addChoice(\Dudek\FormBundle\Entity\Choice $choice)
    {
        $this->choices[] = $choice;
        $choice->setQuestion($this);

        return $this;
    }

    /**
     * @param \Dudek\FormBundle\Entity\Choice $choices
     */
    public function removeChoice(\Dudek\FormBundle\Entity\Choice $choice)
    {
        $this->choices->removeElement($choice);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * @param \Dudek\FormBundle\Entity\Answer $answers
     * @return Question
     */
    public function addAnswer(\Dudek\FormBundle\Entity\Answer $answer)
    {
        $this->answers[] = $answer;
        $answer->setQuestion($this);

        return $this;
    }

    /**
     * @param \Dudek\FormBundle\Entity\Answer $answers
     */
    public function removeAnswer(\Dudek\FormBundle\Entity\Answer $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers()
    {
        return $this->answers;
    }
}
