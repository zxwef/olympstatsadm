<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Athletscountries
 *
 * @ORM\Table(name="athletsCountries")
 * @ORM\Entity
 */
class Athletscountries
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="athletID", type="integer", nullable=false)
     */
    private $athletid;

    /**
     * @var integer
     *
     * @ORM\Column(name="countryID", type="integer", nullable=false)
     */
    private $countryid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cdate", type="datetime", nullable=false)
     */
    private $cdate;



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
     * Set athletid
     *
     * @param integer $athletid
     * @return Athletscountries
     */
    public function setAthletid($athletid)
    {
        $this->athletid = $athletid;

        return $this;
    }

    /**
     * Get athletid
     *
     * @return integer 
     */
    public function getAthletid()
    {
        return $this->athletid;
    }

    /**
     * Set countryid
     *
     * @param integer $countryid
     * @return Athletscountries
     */
    public function setCountryid($countryid)
    {
        $this->countryid = $countryid;

        return $this;
    }

    /**
     * Get countryid
     *
     * @return integer 
     */
    public function getCountryid()
    {
        return $this->countryid;
    }

    /**
     * Set cdate
     *
     * @param \DateTime $cdate
     * @return Athletscountries
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
