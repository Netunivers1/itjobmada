<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * epizy_entreprises
 *
 * @ORM\Table(name="epizy_entreprises")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\epizy_entreprisesRepository")
 */
class epizy_entreprises
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer")
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="id_role", type="integer")
     */
    private $idRole;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_entreprise", type="string", length=255)
     */
    private $nomEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_physique", type="string", length=255)
     */
    private $adressePhysique;

    /**
     * @var string
     *
     * @ORM\Column(name="nif", type="string", length=255)
     */
    private $nif;

    /**
     * @var string
     *
     * @ORM\Column(name="statistique", type="string", length=255)
     */
    private $statistique;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_fixe_entreprise", type="string", length=255)
     */
    private $telFixeEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_responsable", type="string", length=255)
     */
    private $nomResponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_responsable", type="string", length=255)
     */
    private $prenomResponsable;


    /**
     * @var string
     *
     * @ORM\Column(name="emaill_responsable", type="string", length=255,unique=true)
     */
    private $emailResponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_mobil_responsable", type="string", length=255)
     */
    private $telMobilResponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="secteur_activite", type="string", length=255)
     */
    private $secteurActivite;

    /**
     * @var string
     *
     * @ORM\Column(name="newsletter", type="string", length=255, nullable=true)
     */
    private $newsletter;

    /**
     * @var string
     *
     * @ORM\Column(name="notification_cv_poste", type="string", length=255, nullable=true)
     */
    private $notificationCvPoste;

    /**
     * @var string
     *
     * @ORM\Column(name="notification_datelimite_offre", type="string", length=255, nullable=true)
     */
    private $notificationDatelimiteOffre;

    /**
     * @var string
     *
     * @ORM\Column(name="voeux", type="string", length=255, nullable=true)
     */
    private $voeux;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=100, nullable=true)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="produit_vendu", type="string", length=1024, nullable=true)
     */
    private $produitVendu;

    /**
     * @var string
     *
     * @ORM\Column(name="photo1", type="string", length=255, nullable=true)
     */
    private $photo1;

    /**
     * @var string
     *
     * @ORM\Column(name="photo2", type="string", length=255, nullable=true)
     */
    private $photo2;

    /**
     * @var string
     *
     * @ORM\Column(name="autres", type="string", length=1024, nullable=true)
     */
    private $autres;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255, nullable=true)
     */
    private $reference;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="datetimetz")
     */
    private $dateAjout;

    public function __construct()
    {

        $this->dateAjout = new \Datetime();

    }

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
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return epizy_entreprises
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
     * Set idRole
     *
     * @param integer $idRole
     *
     * @return epizy_entreprises
     */
    public function setIdRole($idRole)
    {
        $this->idRole = $idRole;

        return $this;
    }

    /**
     * Get idRole
     *
     * @return int
     */
    public function getIdRole()
    {
        return $this->idRole;
    }

    /**
     * Set nomEntreprise
     *
     * @param string $nomEntreprise
     *
     * @return epizy_entreprises
     */
    public function setNomEntreprise($nomEntreprise)
    {
        $this->nomEntreprise = $nomEntreprise;

        return $this;
    }

    /**
     * Get nomEntreprise
     *
     * @return string
     */
    public function getNomEntreprise()
    {
        return $this->nomEntreprise;
    }

    /**
     * Set adressePhysique
     *
     * @param string $adressePhysique
     *
     * @return epizy_entreprises
     */
    public function setAdressePhysique($adressePhysique)
    {
        $this->adressePhysique = $adressePhysique;

        return $this;
    }

    /**
     * Get adressePhysique
     *
     * @return string
     */
    public function getAdressePhysique()
    {
        return $this->adressePhysique;
    }

    /**
     * Set nif
     *
     * @param string $nif
     *
     * @return epizy_entreprises
     */
    public function setNif($nif)
    {
        $this->nif = $nif;

        return $this;
    }

    /**
     * Get nif
     *
     * @return string
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * Set statistique
     *
     * @param string $statistique
     *
     * @return epizy_entreprises
     */
    public function setStatistique($statistique)
    {
        $this->statistique = $statistique;

        return $this;
    }

    /**
     * Get statistique
     *
     * @return string
     */
    public function getStatistique()
    {
        return $this->statistique;
    }

    /**
     * Set telFixeEntreprise
     *
     * @param string $telFixeEntreprise
     *
     * @return epizy_entreprises
     */
    public function setTelFixeEntreprise($telFixeEntreprise)
    {
        $this->telFixeEntreprise = $telFixeEntreprise;

        return $this;
    }

    /**
     * Get telFixeEntreprise
     *
     * @return string
     */
    public function getTelFixeEntreprise()
    {
        return $this->telFixeEntreprise;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return epizy_entreprises
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set nomResponsable
     *
     * @param string $nomResponsable
     *
     * @return epizy_entreprises
     */
    public function setNomResponsable($nomResponsable)
    {
        $this->nomResponsable = $nomResponsable;

        return $this;
    }

    /**
     * Get nomResponsable
     *
     * @return string
     */
    public function getNomResponsable()
    {
        return $this->nomResponsable;
    }

    /**
     * Set prenomResponsable
     *
     * @param string $prenomResponsable
     *
     * @return epizy_entreprises
     */
    public function setPrenomResponsable($prenomResponsable)
    {
        $this->prenomResponsable = $prenomResponsable;

        return $this;
    }

    /**
     * Get prenomResponsable
     *
     * @return string
     */
    public function getPrenomResponsable()
    {
        return $this->prenomResponsable;
    }

    /**
     * Set telMobilResponsable
     *
     * @param string $telMobilResponsable
     *
     * @return epizy_entreprises
     */
    public function setTelMobilResponsable($telMobilResponsable)
    {
        $this->telMobilResponsable = $telMobilResponsable;

        return $this;
    }

    /**
     * Get telMobilResponsable
     *
     * @return string
     */
    public function getTelMobilResponsable()
    {
        return $this->telMobilResponsable;
    }

    /**
     * Set secteurActivite
     *
     * @param string $secteurActivite
     *
     * @return epizy_entreprises
     */
    public function setSecteurActivite($secteurActivite)
    {
        $this->secteurActivite = $secteurActivite;

        return $this;
    }

    /**
     * Get secteurActivite
     *
     * @return string
     */
    public function getSecteurActivite()
    {
        return $this->secteurActivite;
    }

    /**
     * Set newsletter
     *
     * @param string $newsletter
     *
     * @return epizy_entreprises
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
     * Set notificationCvPoste
     *
     * @param string $notificationCvPoste
     *
     * @return epizy_entreprises
     */
    public function setNotificationCvPoste($notificationCvPoste)
    {
        $this->notificationCvPoste = $notificationCvPoste;

        return $this;
    }

    /**
     * Get notificationCvPoste
     *
     * @return string
     */
    public function getNotificationCvPoste()
    {
        return $this->notificationCvPoste;
    }

    /**
     * Set notificationDatelimiteOffre
     *
     * @param string $notificationDatelimiteOffre
     *
     * @return epizy_entreprises
     */
    public function setNotificationDatelimiteOffre($notificationDatelimiteOffre)
    {
        $this->notificationDatelimiteOffre = $notificationDatelimiteOffre;

        return $this;
    }

    /**
     * Get notificationDatelimiteOffre
     *
     * @return string
     */
    public function getNotificationDatelimiteOffre()
    {
        return $this->notificationDatelimiteOffre;
    }

    /**
     * Set voeux
     *
     * @param string $voeux
     *
     * @return epizy_entreprises
     */
    public function setVoeux($voeux)
    {
        $this->voeux = $voeux;

        return $this;
    }

    /**
     * Get voeux
     *
     * @return string
     */
    public function getVoeux()
    {
        return $this->voeux;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return epizy_entreprises
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
     * Set produitVendu
     *
     * @param string $produitVendu
     *
     * @return epizy_entreprises
     */
    public function setProduitVendu($produitVendu)
    {
        $this->produitVendu = $produitVendu;

        return $this;
    }

    /**
     * Get produitVendu
     *
     * @return string
     */
    public function getProduitVendu()
    {
        return $this->produitVendu;
    }

    /**
     * Set photo1
     *
     * @param string $photo1
     *
     * @return epizy_entreprises
     */
    public function setPhoto1($photo1)
    {
        $this->photo1 = $photo1;

        return $this;
    }

    /**
     * Get photo1
     *
     * @return string
     */
    public function getPhoto1()
    {
        return $this->photo1;
    }

    /**
     * Set photo2
     *
     * @param string $photo2
     *
     * @return epizy_entreprises
     */
    public function setPhoto2($photo2)
    {
        $this->photo2 = $photo2;

        return $this;
    }

    /**
     * Get photo2
     *
     * @return string
     */
    public function getPhoto2()
    {
        return $this->photo2;
    }

    /**
     * Set autres
     *
     * @param string $autres
     *
     * @return epizy_entreprises
     */
    public function setAutres($autres)
    {
        $this->autres = $autres;

        return $this;
    }

    /**
     * Get autres
     *
     * @return string
     */
    public function getAutres()
    {
        return $this->autres;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return epizy_entreprises
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     *
     * @return epizy_entreprises
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * Set emailResponsable
     *
     * @param string $emailResponsable
     *
     * @return epizy_entreprises
     */
    public function setEmailResponsable($emailResponsable)
    {
        $this->emailResponsable = $emailResponsable;

        return $this;
    }

    /**
     * Get emailResponsable
     *
     * @return string
     */
    public function getEmailResponsable()
    {
        return $this->emailResponsable;
    }
}
