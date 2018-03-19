<?php

namespace AdminBundle\Entity;

/**
 * epizy_langues
 */
class epizy_langues
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $isoLang;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $libele;

    /**
     * @var string
     */
    private $etat;

    /**
     * @var \DateTime
     */
    private $created;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set isoLang
     *
     * @param string $isoLang
     *
     * @return epizy_langues
     */
    public function setIsoLang($isoLang)
    {
        $this->isoLang = $isoLang;

        return $this;
    }

    /**
     * Get isoLang
     *
     * @return string
     */
    public function getIsoLang()
    {
        return $this->isoLang;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return epizy_langues
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set libele
     *
     * @param string $libele
     *
     * @return epizy_langues
     */
    public function setLibele($libele)
    {
        $this->libele = $libele;

        return $this;
    }

    /**
     * Get libele
     *
     * @return string
     */
    public function getLibele()
    {
        return $this->libele;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return epizy_langues
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return epizy_langues
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
}

