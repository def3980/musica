<?php

namespace Musica\TodoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Albums
 *
 * @ORM\Table(name="albums", indexes={@ORM\Index(name="IDX_F4E2474F66589A5A", columns={"artistas_ar_id"})})
 * @ORM\Entity
 */
class Albums
{
    /**
     * @var integer
     *
     * @ORM\Column(name="al_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="albums_al_id_seq", allocationSize=1, initialValue=1)
     */
    private $alId;

    /**
     * @var string
     *
     * @ORM\Column(name="al_nombre", type="string", length=100, nullable=true)
     */
    private $alNombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="al_anio", type="date", nullable=true)
     */
    private $alAnio;

    /**
     * @var \Musica\TodoBundle\Entity\Artistas
     *
     * @ORM\ManyToOne(targetEntity="Musica\TodoBundle\Entity\Artistas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="artistas_ar_id", referencedColumnName="ar_id")
     * })
     */
    private $artistasAr;



    /**
     * Get alId
     *
     * @return integer 
     */
    public function getAlId()
    {
        return $this->alId;
    }

    /**
     * Set alNombre
     *
     * @param string $alNombre
     * @return Albums
     */
    public function setAlNombre($alNombre)
    {
        $this->alNombre = $alNombre;

        return $this;
    }

    /**
     * Get alNombre
     *
     * @return string 
     */
    public function getAlNombre()
    {
        return $this->alNombre;
    }

    /**
     * Set alAnio
     *
     * @param \DateTime $alAnio
     * @return Albums
     */
    public function setAlAnio($alAnio)
    {
        $this->alAnio = $alAnio;

        return $this;
    }

    /**
     * Get alAnio
     *
     * @return \DateTime 
     */
    public function getAlAnio()
    {
        return $this->alAnio;
    }

    /**
     * Set artistasAr
     *
     * @param \Musica\TodoBundle\Entity\Artistas $artistasAr
     * @return Albums
     */
    public function setArtistasAr(\Musica\TodoBundle\Entity\Artistas $artistasAr = null)
    {
        $this->artistasAr = $artistasAr;

        return $this;
    }

    /**
     * Get artistasAr
     *
     * @return \Musica\TodoBundle\Entity\Artistas 
     */
    public function getArtistasAr()
    {
        return $this->artistasAr;
    }
}
