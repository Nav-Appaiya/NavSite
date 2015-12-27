<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Positions
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Positions
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
     * @ORM\Column(name="unit_id", type="integer")
     */
    private $unitId;

    /**
     * @var float
     *
     * @ORM\Column(name="rDx", type="float")
     */
    private $rDx;

    /**
     * @var float
     *
     * @ORM\Column(name="rDy", type="float")
     */
    private $rDy;

    /**
     * @var float
     *
     * @ORM\Column(name="speed", type="float")
     */
    private $speed;

    /**
     * @var float
     *
     * @ORM\Column(name="course", type="float")
     */
    private $course;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_sat", type="integer")
     */
    private $numSat;

    /**
     * @var integer
     *
     * @ORM\Column(name="hdop", type="integer")
     */
    private $hdop;

    /**
     * @var string
     *
     * @ORM\Column(name="quality", type="string", length=255)
     */
    private $quality;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_time", type="datetime")
     */
    private $dateTime;


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
     * Set unitId
     *
     * @param integer $unitId
     *
     * @return Positions
     */
    public function setUnitId($unitId)
    {
        $this->unitId = $unitId;

        return $this;
    }

    /**
     * Get unitId
     *
     * @return integer
     */
    public function getUnitId()
    {
        return $this->unitId;
    }

    /**
     * Set rDx
     *
     * @param float $rDx
     *
     * @return Positions
     */
    public function setRDx($rDx)
    {
        $this->rDx = $rDx;

        return $this;
    }

    /**
     * Get rDx
     *
     * @return float
     */
    public function getRDx()
    {
        return $this->rDx;
    }

    /**
     * Set rDy
     *
     * @param float $rDy
     *
     * @return Positions
     */
    public function setRDy($rDy)
    {
        $this->rDy = $rDy;

        return $this;
    }

    /**
     * Get rDy
     *
     * @return float
     */
    public function getRDy()
    {
        return $this->rDy;
    }

    /**
     * Set speed
     *
     * @param float $speed
     *
     * @return Positions
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return float
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set course
     *
     * @param float $course
     *
     * @return Positions
     */
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return float
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set numSat
     *
     * @param integer $numSat
     *
     * @return Positions
     */
    public function setNumSat($numSat)
    {
        $this->numSat = $numSat;

        return $this;
    }

    /**
     * Get numSat
     *
     * @return integer
     */
    public function getNumSat()
    {
        return $this->numSat;
    }

    /**
     * Set hdop
     *
     * @param integer $hdop
     *
     * @return Positions
     */
    public function setHdop($hdop)
    {
        $this->hdop = $hdop;

        return $this;
    }

    /**
     * Get hdop
     *
     * @return integer
     */
    public function getHdop()
    {
        return $this->hdop;
    }

    /**
     * Set quality
     *
     * @param string $quality
     *
     * @return Positions
     */
    public function setQuality($quality)
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * Get quality
     *
     * @return string
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Set dateTime
     *
     * @param \DateTime $dateTime
     *
     * @return Positions
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get dateTime
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }
}

