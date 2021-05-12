<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

require_once('./src/web.inc.all.php');


/**
 * Classe qui représente un tournoi
 */
class Tournoi_tM
{

    #region Champs
    /**
     * L'ID du tournoi
     *
     * @var int
     */
    private $id;

    /**
     * Le titre du tournoi
     *
     * @var string
     */
    private $titre;

    /**
     * La description du tournoi
     *
     * @var string
     */
    private $description;

    /**
     * La date et l'heure du démarrage du tournoi
     *
     * @var datetime
     */
    private $dateHeureDemarrage;

    /**
     * Le nombre d'équipes qui participent au tournoi
     *
     * @var int
     */
    private $nbEquipes;

    /**
     * La date et l'heure du début des inscriptions au tournoi
     *
     * @var datetime
     */
    private $dateHeureDebutInscription;

    /**
     * La date et l'heure de la fin des inscription au tournoi
     *
     * @var datetime
     */
    private $dateHeureFinInscription;

    /**
     * Le temps entre les rondes (optionnel)
     *
     * @var time
     */
    private $tempsEntreRondes;

    /**
     * Le tableau des teams
     *
     * @var array
     */
    private $teams;

    /**
     * Le tableau des rondes
     *
     * @var array
     */
    private $rounds;


    #endregion

    #region Accesseurs/Mutateurs
    /**
     * Accesseur qui retourne l'ID du tournoi
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Mutateur qui "set" l'ID du tournoi
     *
     * @param int $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Accesseur qui retoune le titre du Tournoi
     *
     * @return string $titre
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Mutateur qui "set" le titre du tournoi
     *
     * @param string $titre
     * @return self
     */
    public function setTitre($titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Accesseur qui retourne la description du tournoi
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Mutateur qui "set" la description du tournoi
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Accesseur qui retourne la date et l'heure du démarrage du tournoi
     *
     * @return datetime $dateHeureDemarrage
     */
    public function getDateHeureDemarrage()
    {
        return $this->dateHeureDemarrage;
    }

    /**
     * Mutateur qui "set" la date et l'heure du démarrage du tournoi
     *
     * @param datetime $dateHeureDemarrage
     * @return self
     */
    public function setDateHeureDemarrage($dateHeureDemarrage): self
    {
        $this->dateHeureDemarrage = $dateHeureDemarrage;

        return $this;
    }

    /**
     * Accesseur qui retourne le nombre d'équipes qui participent au tournoi
     *
     * @return int $nbEquipes
     */
    public function getNbEquipes()
    {
        return $this->nbEquipes;
    }

    /**
     * Mutateur qui "set" le nombre d'équipes qui participent au tournoi
     *
     * @param int $nbEquipes
     * @return self
     */
    public function setNbEquipes($nbEquipes): self
    {
        $this->nbEquipes = $nbEquipes;

        return $this;
    }

    /**
     * Accesseur qui retourne la date et l'heure du début des inscriptions au tournoi
     *
     * @return datetime $dateHeureDebutInscription
     */
    public function getDateHeureDebutInscription()
    {
        return $this->dateHeureDebutInscription;
    }

    /**
     * Mutateur qui "set" la date et l'heure du début des inscriptions au tournoi
     *
     * @param datetime $dateHeureDebutInscription
     * @return self
     */
    public function setDateHeureDebutInscription($dateHeureDebutInscription): self
    {
        $this->dateHeureDebutInscription = $dateHeureDebutInscription;

        return $this;
    }

    /**
     * Accesseur qui retourne la date et l'heure de la fin des inscriptions au tournoi
     *
     * @return datetime $dateHeureFinInscription
     */
    public function getDateHeureFinInscription()
    {
        return $this->dateHeureFinInscription;
    }

    /**
     * Mutateur qui "set" la date et l'heure de la fin des inscriptions au tournoi
     *
     * @param datetime $dateHeureFinInscription
     * @return self
     */
    public function setDateHeureFinInscription($dateHeureFinInscription): self
    {
        $this->dateHeureFinInscription = $dateHeureFinInscription;

        return $this;
    }

    /**
     * Accesseur qui retourne le temps entre les rondes
     *
     * @return time $tempsEntreRondes
     */
    public function getTempsEntreRondes()
    {
        return $this->tempsEntreRondes;
    }

    /**
     * Mutateur qui "set" le temps entre les rondes
     *
     * @param time $tempsEntreRondes
     * @return self
     */
    public function setTempsEntreRondes($tempsEntreRondes): self
    {
        $this->tempsEntreRondes = $tempsEntreRondes;

        return $this;
    }

    /**
     * Get the value of teams
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Set the value of teams
     */
    public function setTeams($teams): self
    {
        $this->teams = $teams;

        return $this;
    }

    /**
     * Get the value of rounds
     */
    public function getRounds()
    {
        return $this->rounds;
    }

    /**
     * Set the value of rounds
     */
    public function setRounds($rounds): self
    {
        $this->rounds = $rounds;

        return $this;
    }
    #endregion

    #region Constructeur

    /**
     * Constructeur de la classe Tournoi_tM
     *
     * @param string $unTitre
     * @param string $uneDescription
     * @param datetime $uneDateHeureDemarrage
     * @param int $unNbEquipes
     * @param datetime $uneDateHeureDebutInscription
     * @param datetime $uneDateHeureFinInscription
     * @param time $unTempsEntreRondes
     */
    public function __construct($unTitre = "", $uneDescription = "", $uneDateHeureDemarrage = "", $unNbEquipes = 0, $uneDateHeureDebutInscription = "", $uneDateHeureFinInscription = "", $unTempsEntreRondes = "")
    {
        $this->setTitre($unTitre);
        $this->setDescription($uneDescription);
        $this->setDateHeureDemarrage($uneDateHeureDemarrage);
        $this->setNbEquipes($unNbEquipes);
        $this->setDateHeureDebutInscription($uneDateHeureDebutInscription);
        $this->setDateHeureFinInscription($uneDateHeureFinInscription);
        $this->setTempsEntreRondes($unTempsEntreRondes);
    }


    public function getProperties()
    {
        return get_object_vars($this);
    }

    #endregion
}
