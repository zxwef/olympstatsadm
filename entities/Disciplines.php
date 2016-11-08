<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Disciplines
 *
 * @ORM\Table(name="disciplines")
 * @ORM\Entity
 */
class Disciplines
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
     * @ORM\Column(name="sportID", type="integer", nullable=false)
     */
    private $sportid;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", nullable=false)
     */
    private $sex;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=250, nullable=false)
     */
    private $title;

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
     * Set sportid
     *
     * @param integer $sportid
     * @return Disciplines
     */
    public function setSportid($sportid)
    {
        $this->sportid = $sportid;

        return $this;
    }

    /**
     * Get sportid
     *
     * @return integer 
     */
    public function getSportid()
    {
        return $this->sportid;
    }

    /**
     * Set sex
     *
     * @param string $sex
     * @return Disciplines
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Disciplines
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set cdate
     *
     * @param \DateTime $cdate
     * @return Disciplines
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
