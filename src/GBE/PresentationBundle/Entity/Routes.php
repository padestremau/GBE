<?php

namespace GBE\PresentationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Routes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GBE\PresentationBundle\Entity\RoutesRepository")
 */
class Routes
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
     * @ORM\Column(name="routeNumber", type="integer")
     */
    private $routeNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="start_city", type="string", length=255, nullable=true)
     */
    private $startCity;

    /**
     * @var string
     *
     * @ORM\Column(name="end_city", type="string", length=255, nullable=true)
     */
    private $endCity;

    /**
     * @var integer
     *
     * @ORM\Column(name="length", type="string", length=255, nullable=true)
     */
    private $length;

    /**
     * @var integer
     *
     * @ORM\Column(name="height_pos", type="string", length=255, nullable=true)
     */
    private $height_pos;

    /**
     * @var integer
     *
     * @ORM\Column(name="height_neg", type="string", length=255, nullable=true)
     */
    private $height_neg;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;


    /*   *********      construct  *************  */

    public function __construct()
    {
        $this->createdAt         = new \Datetime;
        $this->updatedAt         = new \Datetime;

    }


    /*   *********     Setter and getter Functions  *************  */

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
     * @return Routes
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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Routes
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Routes
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Routes
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Routes
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set startCity
     *
     * @param string $startCity
     * @return Routes
     */
    public function setStartCity($startCity)
    {
        $this->startCity = $startCity;

        return $this;
    }

    /**
     * Get startCity
     *
     * @return string 
     */
    public function getStartCity()
    {
        return $this->startCity;
    }

    /**
     * Set endCity
     *
     * @param string $endCity
     * @return Routes
     */
    public function setEndCity($endCity)
    {
        $this->endCity = $endCity;

        return $this;
    }

    /**
     * Get endCity
     *
     * @return string 
     */
    public function getEndCity()
    {
        return $this->endCity;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Routes
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     * @return Routes
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set height_pos
     *
     * @param integer $heightPos
     * @return Routes
     */
    public function setHeightPos($heightPos)
    {
        $this->height_pos = $heightPos;

        return $this;
    }

    /**
     * Get height_pos
     *
     * @return integer 
     */
    public function getHeightPos()
    {
        return $this->height_pos;
    }

    /**
     * Set height_neg
     *
     * @param integer $heightNeg
     * @return Routes
     */
    public function setHeightNeg($heightNeg)
    {
        $this->height_neg = $heightNeg;

        return $this;
    }

    /**
     * Get height_neg
     *
     * @return integer 
     */
    public function getHeightNeg()
    {
        return $this->height_neg;
    }

    /**
     * Set length
     *
     * @param string $length
     * @return Routes
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return string 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set routeNumber
     *
     * @param integer $routeNumber
     * @return Routes
     */
    public function setRouteNumber($routeNumber)
    {
        $this->routeNumber = $routeNumber;

        return $this;
    }

    /**
     * Get routeNumber
     *
     * @return integer 
     */
    public function getRouteNumber()
    {
        return $this->routeNumber;
    }
}
