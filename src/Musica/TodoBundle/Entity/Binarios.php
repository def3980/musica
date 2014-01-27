<?php

namespace Musica\TodoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Binarios
 *
 * @ORM\Table(name="""musica"."binarios""", indexes={@ORM\Index(name="IDX_BFDF38C4DADE7FBA", columns={"albums_al_id"})})
 * @ORM\Entity(repositoryClass="Musica\TodoBundle\Entity\BinariosRepository")
 */
class Binarios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="bi_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="musica.binarios_bi_id_seq", allocationSize=1, initialValue=1)
     */
    private $biId;

    /**
     * @var string
     *
     * @ORM\Column(name="bi_nombre", type="string", length=100, nullable=true)
     */
    private $biNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="bi_tamanio_bytes", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $biTamanioBytes;

    /**
     * @var string
     *
     * @ORM\Column(name="bi_bin", type="blob", nullable=true)
     */
    private $biBin;

    /**
     * @var string
     *
     * @ORM\Column(name="bi_extension", type="string", length=100, nullable=true)
     */
    private $biExtension;

    /**
     * @var string
     *
     * @ORM\Column(name="bi_ruta", type="string", length=255, nullable=true)
     */
    private $biRuta;

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
     * Get biId
     *
     * @return integer 
     */
    public function getBiId()
    {
        return $this->biId;
    }

    /**
     * Set biNombre
     *
     * @param string $biNombre
     * @return Binarios
     */
    public function setBiNombre($biNombre)
    {
        $this->biNombre = $biNombre;
    
        return $this;
    }

    /**
     * Get biNombre
     *
     * @return string 
     */
    public function getBiNombre()
    {
        return $this->biNombre;
    }

    /**
     * Set biTamanioBytes
     *
     * @param string $biTamanioBytes
     * @return Binarios
     */
    public function setBiTamanioBytes($biTamanioBytes)
    {
        $this->biTamanioBytes = $biTamanioBytes;
    
        return $this;
    }

    /**
     * Get biTamanioBytes
     *
     * @return string 
     */
    public function getBiTamanioBytes()
    {
        return $this->biTamanioBytes;
    }

    /**
     * Set biBin
     *
     * @param string $biBin
     * @return Binarios
     */
    public function setBiBin($biBin)
    {
        $this->biBin = $biBin;
    
        return $this;
    }

    /**
     * Get biBin
     *
     * @return string 
     */
    public function getBiBin()
    {
        return $this->biBin;
    }

    /**
     * Set biExtension
     *
     * @param string $biExtension
     * @return Binarios
     */
    public function setBiExtension($biExtension)
    {
        $this->biExtension = $biExtension;
    
        return $this;
    }

    /**
     * Get biExtension
     *
     * @return string 
     */
    public function getBiExtension()
    {
        return $this->biExtension;
    }

    /**
     * Set biRuta
     *
     * @param string $biRuta
     * @return Binarios
     */
    public function setBiRuta($biRuta)
    {
        $this->biRuta = $biRuta;
    
        return $this;
    }

    /**
     * Get biRuta
     *
     * @return string 
     */
    public function getBiRuta()
    {
        return $this->biRuta;
    }

    /**
     * Set albumsAl
     *
     * @param \Musica\TodoBundle\Entity\Albums $albumsAl
     * @return Binarios
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
        return $this->getBiNombre();
    }
}