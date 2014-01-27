<?php

namespace Musica\TodoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artistas
 *
 * @ORM\Table(name="""musica"."artistas""")
 * @ORM\Entity
 */
class Artistas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ar_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="musica.artistas_ar_id_seq", allocationSize=1, initialValue=1)
     */
    private $arId;

    /**
     * @var string
     *
     * @ORM\Column(name="ar_nombre", type="string", length=100, nullable=true)
     */
    private $arNombre;



    /**
     * Get arId
     *
     * @return integer 
     */
    public function getArId()
    {
        return $this->arId;
    }

    /**
     * Set arNombre
     *
     * @param string $arNombre
     * @return Artistas
     */
    public function setArNombre($arNombre)
    {
        $this->arNombre = $arNombre;
    
        return $this;
    }

    /**
     * Get arNombre
     *
     * @return string 
     */
    public function getArNombre()
    {
        return $this->arNombre;
    }

    /**
     * Metodo magico para convertir Object a String
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->getArNombre();
    }
}