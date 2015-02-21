<?php

namespace Dudek\FormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Form
 *
 * @ORM\Table()
 * @ORM\Entity()
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
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $closeDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inscriptionMandatory;

    /**
     * @ORM\OneToMany(targetEntity="Step", mappedBy="form", cascade={"all"})
     */
    private $steps;


    public function __construct()
    {
        $this->created = new \DateTime();
        $this->steps = new ArrayCollection();
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
     * @param \DateTime $closeDate
     * @return Form
     */
    public function setCloseDate($closeDate)
    {
        $this->closeDate = $closeDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCloseDate()
    {
        return $this->closeDate;
    }

    /**
     * @param string $name
     * @return Form
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
     * @return boolean
     */
    public function isInscriptionMandatory()
    {
        return $this->inscriptionMandatory;
    }

    /**
     * @param boolean $boolean
     * @return Form
     */
    public function setInscriptionMandatory($boolean)
    {
        $this->inscriptionMandatory = $boolean;

        return $this;
    }

    /**
     * @param \Dudek\FormBundle\Entity\Step $steps
     * @return Form
     */
    public function addStep(\Dudek\FormBundle\Entity\Step $step)
    {
        $this->steps[] = $step;

        return $this;
    }

    /**
     * @param \Dudek\FormBundle\Entity\Step $steps
     */
    public function removeStep(\Dudek\FormBundle\Entity\Step $step)
    {
        $this->steps->removeElement($step);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSteps()
    {
        return $this->steps;
    }
}
