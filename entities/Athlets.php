<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Athlets
 *
 * @ORM\Table(name="athlets")
 * @ORM\Entity
 */
class Athlets
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
     * @var string
     *
     * @ORM\Column(name="nameEN", type="string", length=250, nullable=false)
     */
    private $nameen;

    /**
     * @var string
     *
     * @ORM\Column(name="nameRU", type="string", length=250, nullable=false)
     */
    private $nameru;

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
     * Set nameen
     *
     * @param string $nameen
     * @return Athlets
     */
    public function setNameen($nameen)
    {
        $this->nameen = $nameen;

        return $this;
    }

    /**
     * Get nameen
     *
     * @return string 
     */
    public function getNameen()
    {
        return $this->nameen;
    }

    /**
     * Set nameru
     *
     * @param string $nameru
     * @return Athlets
     */
    public function setNameru($nameru)
    {
        $this->nameru = $nameru;

        return $this;
    }

    /**
     * Get nameru
     *
     * @return string 
     */
    public function getNameru()
    {
        return $this->nameru;
    }

    /**
     * Set cdate
     *
     * @param \DateTime $cdate
     * @return Athlets
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
