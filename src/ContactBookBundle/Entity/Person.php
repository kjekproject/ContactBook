<?php

namespace ContactBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="persons")
 * @ORM\Entity(repositoryClass="ContactBookBundle\Repository\PersonRepository")
 */
class Person
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
     * @ORM\Column(name="name", type="string", length=128)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=128)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="person")
     */
    private $addresses;
    
    /**
     * @ORM\OneToMany(targetEntity="Email", mappedBy="person")
     */
    private $emails;
    
    /**
     * @ORM\OneToMany(targetEntity="Phone", mappedBy="person")
     */
    private $phones;
    
    /**
     * @ORM\ManyToMany(targetEntity="Team", inversedBy="persons")
     */
    private $teams;
    
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
     * Set name
     *
     * @param string $name
     * @return Person
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
     * Set surname
     *
     * @param string $surname
     * @return Person
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Person
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
     * Set photo
     *
     * @param string $photo
     * @return Person
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->emails = new \Doctrine\Common\Collections\ArrayCollection();
        $this->phones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add addresses
     *
     * @param \ContactBookBundle\Entity\Address $addresses
     * @return Person
     */
    public function addAddress(\ContactBookBundle\Entity\Address $addresses)
    {
        $this->addresses[] = $addresses;

        return $this;
    }

    /**
     * Remove addresses
     *
     * @param \ContactBookBundle\Entity\Address $addresses
     */
    public function removeAddress(\ContactBookBundle\Entity\Address $addresses)
    {
        $this->addresses->removeElement($addresses);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Add emails
     *
     * @param \ContactBookBundle\Entity\Email $emails
     * @return Person
     */
    public function addEmail(\ContactBookBundle\Entity\Email $emails)
    {
        $this->emails[] = $emails;

        return $this;
    }

    /**
     * Remove emails
     *
     * @param \ContactBookBundle\Entity\Email $emails
     */
    public function removeEmail(\ContactBookBundle\Entity\Email $emails)
    {
        $this->emails->removeElement($emails);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Add phones
     *
     * @param \ContactBookBundle\Entity\Phone $phones
     * @return Person
     */
    public function addPhone(\ContactBookBundle\Entity\Phone $phones)
    {
        $this->phones[] = $phones;

        return $this;
    }

    /**
     * Remove phones
     *
     * @param \ContactBookBundle\Entity\Phone $phones
     */
    public function removePhone(\ContactBookBundle\Entity\Phone $phones)
    {
        $this->phones->removeElement($phones);
    }

    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Add teams
     *
     * @param \ContactBookBundle\Entity\Team $teams
     * @return Person
     */
    public function addTeam(\ContactBookBundle\Entity\Team $teams)
    {
        $this->teams[] = $teams;

        return $this;
    }

    /**
     * Remove teams
     *
     * @param \ContactBookBundle\Entity\Team $teams
     */
    public function removeTeam(\ContactBookBundle\Entity\Team $teams)
    {
        $this->teams->removeElement($teams);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeams()
    {
        return $this->teams;
    }
}
