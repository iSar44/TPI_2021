<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

/**
 * Classe qui représente un utilisateur du site tournamentManager (tM)
 */
class Utilisateur_tM
{

    #region Champs
    /**
     * l'ID de l'utilisateur
     *
     * @var int
     */
    private $id;

    /**
     * Le nickname de l'utilisateur
     *
     * @var string
     */
    private $nickname;

    /**
     * L'email de l'utilisateur
     *
     * @var string
     */
    private $email;

    /**
     * Le mot de passe de l'utilisateur
     *
     * @var string
     */
    private $mdp;

    /**
     * Champ qui représente si l'utilisateur est un administrateur ou non
     *
     * @var int
     */
    private $admin;
    #endregion

    #region Propriétés

    /**
     * Get the value of id
     *
     * @return int ID de l'utilisateur
     */

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     * @return Utilisateur_tM retourne la classe Utilisateur_tM
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nickname
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set the value of nickname
     */
    public function setNickname($nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of mdp
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set the value of mdp
     */
    public function setMdp($mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get the value of admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set the value of admin
     */
    public function setAdmin($admin): self
    {
        $this->admin = $admin;

        return $this;
    }
    #endregion

    /**
     * Constructeur de la classe utilisateur
     *
     * @param string $aNickname
     * @param string $anEmail
     * @param string $anAdmin
     */
    public function __construct($aNickname = "Un nickname", $anEmail = "email@email.com", $anAdmin = "0")
    {
        $this->setNickname($aNickname);
        $this->setEmail($anEmail);
        $this->setAdmin($anAdmin);
    }

    /**
     * Méthode qui retourne l'utilisateur sous forme d'une chaîne de caractères
     *
     * @return string
     */

    public function __toString()
    {
        return printf("NICKNAME: %s; EMAIL: %s; MDP: %s, ADMIN: %s", $this->getNickname(), $this->getEmail(), $this->getMdp(), $this->getAdmin());
    }
}
