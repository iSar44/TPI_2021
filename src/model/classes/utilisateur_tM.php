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

    #region Accesseurs/Mutateurs
    /**
     * Accesseur qui retourne l'ID de l'utilisateur
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Mutateur qui "set" l'ID de l'utilisateur
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
     * Accesseur qui retourne le nickname de l'utilisateur
     *
     * @return string $nickname
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Mutateur qui "set" le nickname de l'utilisateur
     *
     * @param string $nickname
     * @return self
     */
    public function setNickname($nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Accesseur qui retourne l'email de l'utilisateur
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Mutateur qui "set" l'email de l'utilisateur
     *
     * @param string $email
     * @return self
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Accesseur qui retourne le mot de passe de l'utilisateur
     *
     * @return string $mdp
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Mutateur qui "set" le mot de passe de l'utilisateur
     *
     * @param string $mdp
     * @return self
     */
    public function setMdp($mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Accesseur qui retourne la valeur qui représente si l'utilisateur est un administrateur ou non
     *
     * @return int $admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Mutateur qui "set" la valeur qui représente si l'utilisateur est un administrateur ou non
     *
     * @param int $admin
     * @return self
     */
    public function setAdmin($admin): self
    {
        $this->admin = $admin;

        return $this;
    }
    #endregion

    #region Constructeur
    /**
     * Constructeur de la classe Utilisateur_tM
     *
     * @param string $aNickname
     * @param string $anEmail
     * @param string $anAdmin
     */
    public function __construct($anId = -1, $aNickname = "Un nickname", $anEmail = "email@email.com", $anAdmin = "0")
    {
        $this->setId($anId);
        $this->setNickname($aNickname);
        $this->setEmail($anEmail);
        $this->setAdmin($anAdmin);
    }
    #endregion

    #region Fonction
    /**
     * Méthode qui retourne l'utilisateur sous forme d'une chaîne de caractères
     *
     * @return string
     */
    public function __toString(): string
    {
        return printf("NICKNAME: %s; EMAIL: %s; MDP: %s, ADMIN: %s", $this->getNickname(), $this->getEmail(), $this->getMdp(), $this->getAdmin());
    }
    #endregion
}
