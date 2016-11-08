<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Pvpcontests
 *
 * @ORM\Table(name="pvpContests")
 * @ORM\Entity
 */
class Pvpcontests
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
     * @ORM\Column(name="gameID", type="integer", nullable=false)
     */
    private $gameid;

    /**
     * @var integer
     *
     * @ORM\Column(name="disciplineID", type="integer", nullable=false)
     */
    private $disciplineid;

    /**
     * @var string
     *
     * @ORM\Column(name="stage", type="string", length=50, nullable=false)
     */
    private $stage;

    /**
     * @var integer
     *
     * @ORM\Column(name="unitFirst", type="integer", nullable=false)
     */
    private $unitfirst;

    /**
     * @var integer
     *
     * @ORM\Column(name="unitSecond", type="integer", nullable=false)
     */
    private $unitsecond;

    /**
     * @var integer
     *
     * @ORM\Column(name="resultUnitFirst", type="integer", nullable=false)
     */
    private $resultunitfirst;

    /**
     * @var integer
     *
     * @ORM\Column(name="resultUnitSecond", type="integer", nullable=false)
     */
    private $resultunitsecond;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=1000, nullable=false)
     */
    private $info;

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
     * Set gameid
     *
     * @param integer $gameid
     * @return Pvpcontests
     */
    public function setGameid($gameid)
    {
        $this->gameid = $gameid;

        return $this;
    }

    /**
     * Get gameid
     *
     * @return integer 
     */
    public function getGameid()
    {
        return $this->gameid;
    }

    /**
     * Set disciplineid
     *
     * @param integer $disciplineid
     * @return Pvpcontests
     */
    public function setDisciplineid($disciplineid)
    {
        $this->disciplineid = $disciplineid;

        return $this;
    }

    /**
     * Get disciplineid
     *
     * @return integer 
     */
    public function getDisciplineid()
    {
        return $this->disciplineid;
    }

    /**
     * Set stage
     *
     * @param string $stage
     * @return Pvpcontests
     */
    public function setStage($stage)
    {
        $this->stage = $stage;

        return $this;
    }

    /**
     * Get stage
     *
     * @return string 
     */
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * Set unitfirst
     *
     * @param integer $unitfirst
     * @return Pvpcontests
     */
    public function setUnitfirst($unitfirst)
    {
        $this->unitfirst = $unitfirst;

        return $this;
    }

    /**
     * Get unitfirst
     *
     * @return integer 
     */
    public function getUnitfirst()
    {
        return $this->unitfirst;
    }

    /**
     * Set unitsecond
     *
     * @param integer $unitsecond
     * @return Pvpcontests
     */
    public function setUnitsecond($unitsecond)
    {
        $this->unitsecond = $unitsecond;

        return $this;
    }

    /**
     * Get unitsecond
     *
     * @return integer 
     */
    public function getUnitsecond()
    {
        return $this->unitsecond;
    }

    /**
     * Set resultunitfirst
     *
     * @param integer $resultunitfirst
     * @return Pvpcontests
     */
    public function setResultunitfirst($resultunitfirst)
    {
        $this->resultunitfirst = $resultunitfirst;

        return $this;
    }

    /**
     * Get resultunitfirst
     *
     * @return integer 
     */
    public function getResultunitfirst()
    {
        return $this->resultunitfirst;
    }

    /**
     * Set resultunitsecond
     *
     * @param integer $resultunitsecond
     * @return Pvpcontests
     */
    public function setResultunitsecond($resultunitsecond)
    {
        $this->resultunitsecond = $resultunitsecond;

        return $this;
    }

    /**
     * Get resultunitsecond
     *
     * @return integer 
     */
    public function getResultunitsecond()
    {
        return $this->resultunitsecond;
    }

    /**
     * Set info
     *
     * @param string $info
     * @return Pvpcontests
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string 
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set cdate
     *
     * @param \DateTime $cdate
     * @return Pvpcontests
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
