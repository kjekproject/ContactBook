<?php

namespace ContactBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Phone
 *
 * @ORM\Table(name="phones")
 * @ORM\Entity(repositoryClass="ContactBookBundle\Repository\PhoneRepository")
 */
class Phone
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
     * @ORM\Column(name="number", type="string", length=64, unique=true)
     * @Assert\Length(min = 3, minMessage = "Phone number must be at least 3 characters long.")
     * @Assert\Regex(pattern = "/^[#+0-9]\d+$/", match = true, message = "Invalid number.")
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=64)
     * @Assert\Choice(choices = {"home", "business", "private", "other"}, 
     *      message = "Choose a valid type.")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="phones")
     */
    private $person;

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
     * Set number
     *
     * @param string $number
     * @return Phone
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Phone
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set person
     *
     * @param \ContactBookBundle\Entity\Person $person
     * @return Phone
     */
    public function setPerson(\ContactBookBundle\Entity\Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \ContactBookBundle\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }
}
