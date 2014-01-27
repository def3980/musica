<?php

namespace Musica\TodoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tracks
 *
 * @ORM\Table(name="""musica"."tracks""", indexes={@ORM\Index(name="IDX_C3F2C506DADE7FBA", columns={"albums_al_id"})})
 * @ORM\Entity
 */
class Tracks
{
    /**
     * @var integer
     *
     * @ORM\Column(name="tr_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="musica.tracks_tr_id_seq", allocationSize=1, initialValue=1)
     */
    private $trId;

    /**
     * @var string
     *
     * @ORM\Column(name="tr_nombre", type="string", length=100, nullable=true)
     */
    private $trNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="tr_longitud", type="string", nullable=true)
     */
    private $trLongitud;

    /**
     * @var \Musica\TodoBundle\Entity\Albums
     *
     * @ORM\ManyToOne(targetEntity="Musica\TodoBundle\Entity\Albums")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="albums_al_id", referencedColumnName="al_id")
     * })
     */
    private $albumsAl;



    /**
     * Get trId
     *
     * @return integer 
     */
    public function getTrId()
    {
        return $this->trId;
    }

    /**
     * Set trNombre
     *
     * @param string $trNombre
     * @return Tracks
     */
    public function setTrNombre($trNombre)
    {
        $this->trNombre = $trNombre;
    
        return $this;
    }

    /**
     * Get trNombre
     *
     * @return string 
     */
    public function getTrNombre()
    {
        return $this->trNombre;
    }

    /**
     * Set trLongitud
     *
     * @param string $trLongitud
     * @return Tracks
     */
    public function setTrLongitud($trLongitud)
    {
        $this->trLongitud = $trLongitud;
    
        return $this;
    }

    /**
     * Get trLongitud
     *
     * @return string 
     */
    public function getTrLongitud()
    {
        return $this->trLongitud;
    }

    /**
     * Set albumsAl
     *
     * @param \Musica\TodoBundle\Entity\Albums $albumsAl
     * @return Tracks
     */
    public function setAlbumsAl(\Musica\TodoBundle\Entity\Albums $albumsAl = null)
    {
        $this->albumsAl = $albumsAl;
    
        return $this;
    }

    /**
     * Get albumsAl
     *
     * @return \Musica\TodoBundle\Entity\Albums 
     */
    public function getAlbumsAl()
    {
        return $this->albumsAl;
    }
    
    /**
     * Metodo magico para convertir Object a String
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->getTrNombre();
    }
}