<?php

namespace Musica\TodoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Covers
 *
 * @ORM\Table(name="covers", indexes={@ORM\Index(name="IDX_F08DF1B2DADE7FBA", columns={"albums_al_id"})})
 * @ORM\Entity
 */
class Covers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="co_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="covers_co_id_seq", allocationSize=1, initialValue=1)
     */
    private $coId;

    /**
     * @var string
     *
     * @ORM\Column(name="co_nombre", type="string", length=100, nullable=true)
     */
    private $coNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="co_tamanio", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $coTamanio;

    /**
     * @var string
     *
     * @ORM\Column(name="co_bin", type="blob", nullable=true)
     */
    private $coBin;

    /**
     * @var string
     *
     * @ORM\Column(name="co_extension", type="string", length=100, nullable=true)
     */
    private $coExtension;

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
     * Get coId
     *
     * @return integer 
     */
    public function getCoId()
    {
        return $this->coId;
    }

    /**
     * Set coNombre
     *
     * @param string $coNombre
     * @return Covers
     */
    public function setCoNombre($coNombre)
    {
        $this->coNombre = $coNombre;

        return $this;
    }

    /**
     * Get coNombre
     *
     * @return string 
     */
    public function getCoNombre()
    {
        return $this->coNombre;
    }

    /**
     * Set coTamanio
     *
     * @param string $coTamanio
     * @return Covers
     */
    public function setCoTamanio($coTamanio)
    {
        $this->coTamanio = $coTamanio;

        return $this;
    }

    /**
     * Get coTamanio
     *
     * @return string 
     */
    public function getCoTamanio()
    {
        return $this->coTamanio;
    }

    /**
     * Set coBin
     *
     * @param string $coBin
     * @return Covers
     */
    public function setCoBin($coBin)
    {
        $this->coBin = $coBin;

        return $this;
    }

    /**
     * Get coBin
     *
     * @return string 
     */
    public function getCoBin()
    {
        return $this->coBin;
    }

    /**
     * Set coExtension
     *
     * @param string $coExtension
     * @return Covers
     */
    public function setCoExtension($coExtension)
    {
        $this->coExtension = $coExtension;

        return $this;
    }

    /**
     * Get coExtension
     *
     * @return string 
     */
    public function getCoExtension()
    {
        return $this->coExtension;
    }

    /**
     * Set albumsAl
     *
     * @param \Musica\TodoBundle\Entity\Albums $albumsAl
     * @return Covers
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
}
