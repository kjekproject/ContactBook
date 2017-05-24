<?php

namespace ContactBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="addresses")
 * @ORM\Entity(repositoryClass="ContactBookBundle\Repository\AddressRepository")
 */
class Address
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
     * @ORM\Column(name="street_name", type="string", length=128)
     */
    private $streetName;

    /**
     * @var int
     *
     * @ORM\Column(name="building_number", type="string", length=32)
     */
    private $buildingNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="flat_number", type="string", length=32, nullable=true)
     */
    private $flatNumber;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="addresses")
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
     * Set streetName
     *
     * @param string $streetName
     * @return Address
     */
    public function setStreetName($streetName)
    {
        $this->streetName = $streetName;

        return $this;
    }

    /**
     * Get streetName
     *
     * @return string 
     */
    public function getStreetName()
    {
        return $this->streetName;
    }

    /**
     * Set buildingNumber
     *
     * @param integer $buildingNumber
     * @return Address
     */
    public function setBuildingNumber($buildingNumber)
    {
        $this->buildingNumber = $buildingNumber;

        return $this;
    }

    /**
     * Get buildingNumber
     *
     * @return integer 
     */
    public function getBuildingNumber()
    {
        return $this->buildingNumber;
    }

    /**
     * Set flatNumber
     *
     * @param string $flatNumber
     * @return Address
     */
    public function setFlatNumber($flatNumber)
    {
        $this->flatNumber = $flatNumber;

        return $this;
    }

    /**
     * Get flatNumber
     *
     * @return string 
     */
    public function getFlatNumber()
    {
        return $this->flatNumber;
    }



    /**
     * Set person
     *
     * @param \ContactBookBundle\Entity\Person $person
     * @return Address
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
