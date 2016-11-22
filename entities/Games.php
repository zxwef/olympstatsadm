<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Games
 *
 * @ORM\Table(name="games", uniqueConstraints={@ORM\UniqueConstraint(name="year", columns={"year"})})
 * @ORM\Entity
 */
class Games
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="integer", nullable=false)
     */
    private $year;

    /**
    * @var string
    *
    * @ORM\Column(name="season", type="string", nullable=false)
    */
    private $season;

    /**
     * @var integer
     *
     * @ORM\Column(name="countryID", type="integer", nullable=false)
     */
    private $countryID;

    /**
     * @ORM\ManyToOne(targetEntity="Countries")
     * @ORM\JoinColumn(name="countryID", referencedColumnName="id")
     */
    private $countries;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=250, nullable=false)
     */
    private $city;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cdate", type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    private $cdate;

      /**
       * Set id
       *
       * @param integer $id
       * @return Games
       */
      public function setId($id)
      {
          $this->id = $id;

          return $this;
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
     * Set year
     *
     * @param integer $year
     * @return Games
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set countryID
     *
     * @param integer $countryID
     * @return Games
     */
    public function setCountryID($countryID)
    {
        $this->countryID = $countryID;

        return $this;
    }

    /**
     * Get countryID
     *
     * @return integer
     */
    public function getCountryID()
    {
        return $this->countryID;
    }

    public function setCountry(Countries $country) {
      $this->countries = $country;
      return $this;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Games
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

      /**
       * Set season
       *
       * @param string $season
       * @return Games
       */
      public function setSeason($season)
      {
          $this->season = $season;

          return $this;
      }

      /**
       * Get season
       *
       * @return string
       */
      public function getSeason()
      {
          return $this->season;
      }

    /**
     * Set cdate
     *
     * @param \DateTime $cdate
     * @return Games
     */
    public function setCdate($cdate)
    {
        $this->cdate = $cdate;

        return $this;
    }

    /**
     * Get cdate
     *
     * @return \DateTime
     */
    public function getCdate()
    {
        return $this->cdate;
    }
}
