<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity
 */
class Test
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
     * @ORM\Column(name="login123", type="string", length=255, nullable=false)
     */
    private $login123;



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
     * Set login123
     *
     * @param string $login123
     * @return Test
     */
    public function setLogin123($login123)
    {
        $this->login123 = $login123;

        return $this;
    }

    /**
     * Get login123
     *
     * @return string 
     */
    public function getLogin123()
    {
        return $this->login123;
    }
}
