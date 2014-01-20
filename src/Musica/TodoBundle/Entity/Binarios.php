<?php

namespace Musica\TodoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Binarios
 *
 * @ORM\Table(name="binarios", indexes={@ORM\Index(name="fk_binarios_albums1_idx", columns={"albums_al_id"})})
 * @ORM\Entity
 */
class Binarios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="bi_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $biId;

    /**
     * @var string
     *
     * @ORM\Column(name="bi_nombre", type="string", length=254, nullable=true)
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
     * @ORM\Column(name="bi_ext", type="string", length=100, nullable=true)
     */
    private $biExt;

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
     * Set biExt
     *
     * @param string $biExt
     * @return Binarios
     */
    public function setBiExt($biExt)
    {
        $this->biExt = $biExt;

        return $this;
    }

    /**
     * Get biExt
     *
     * @return string 
     */
    public function getBiExt()
    {
        return $this->biExt;
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