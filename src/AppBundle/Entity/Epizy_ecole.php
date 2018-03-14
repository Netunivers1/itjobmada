<?php

namespace AppBundle\Entity;

/**
 * Epizy_ecole
 */
class Epizy_ecole
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $place;

    /**
     * @var string
     */
    private $newsletter;

    /**
     * @var int
     */
    private $idUser;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $address;

    /**
     * @var int
     */
    private $bp;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $region;

    /**
     * @var int
     */
    private $tel;

    /**
     * @var string
     */
    private $nomResp;

    /**
     * @var string
     */
    private $diplReconnu;

    /**
     * @var string
     */
    private $photo;

    /**
     * @var string
     */
    private $site;

    /**
     * @var string
     */
    private $lienfb;

    /**
     * @var int
     */
    private $status;

    /**
     * @var int
     */
    private $nbrVue;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $published;

    /**
     * @var \DateTime
     */
    private $featured;


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
     * Set place
     *
     * @param integer $place
     *
     * @return Epizy_ecole
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return int
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set newsletter
     *
     * @param string $newsletter
     *
     * @return Epizy_ecole
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return string
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Epizy_ecole
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Epizy_ecole
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
     * Set address
     *
     * @param string $address
     *
     * @return Epizy_ecole
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set bp
     *
     * @param integer $bp
     *
     * @return Epizy_ecole
     */
    public function setBp($bp)
    {
        $this->bp = $bp;

        return $this;
    }

    /**
     * Get bp
     *
     * @return int
     */
    public function getBp()
    {
        return $this->bp;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Epizy_ecole
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Epizy_ecole
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set tel
     *
     * @param integer $tel
     *
     * @return Epizy_ecole
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return int
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set nomResp
     *
     * @param string $nomResp
     *
     * @return Epizy_ecole
     */
    public function setNomResp($nomResp)
    {
        $this->nomResp = $nomResp;

        return $this;
    }

    /**
     * Get nomResp
     *
     * @return string
     */
    public function getNomResp()
    {
        return $this->nomResp;
    }

    /**
     * Set diplReconnu
     *
     * @param string $diplReconnu
     *
     * @return Epizy_ecole
     */
    public function setDiplReconnu($diplReconnu)
    {
        $this->diplReconnu = $diplReconnu;

        return $this;
    }

    /**
     * Get diplReconnu
     *
     * @return string
     */
    public function getDiplReconnu()
    {
        return $this->diplReconnu;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Epizy_ecole
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set site
     *
     * @param string $site
     *
     * @return Epizy_ecole
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set lienfb
     *
     * @param string $lienfb
     *
     * @return Epizy_ecole
     */
    public function setLienfb($lienfb)
    {
        $this->lienfb = $lienfb;

        return $this;
    }

    /**
     * Get lienfb
     *
     * @return string
     */
    public function getLienfb()
    {
        return $this->lienfb;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Epizy_ecole
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set nbrVue
     *
     * @param integer $nbrVue
     *
     * @return Epizy_ecole
     */
    public function setNbrVue($nbrVue)
    {
        $this->nbrVue = $nbrVue;

        return $this;
    }

    /**
     * Get nbrVue
     *
     * @return int
     */
    public function getNbrVue()
    {
        return $this->nbrVue;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Epizy_ecole
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

    /**
     * Set published
     *
     * @param \DateTime $published
     *
     * @return Epizy_ecole
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return \DateTime
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set featured
     *
     * @param \DateTime $featured
     *
     * @return Epizy_ecole
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get featured
     *
     * @return \DateTime
     */
    public function getFeatured()
    {
        return $this->featured;
    }
}

