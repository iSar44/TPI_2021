<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

/**
 * Classe qui répresente une équipe du site tournamentManager
 */
class Equipe_tM
{

    #region 
    /**
     * l'ID de l'équipe
     *
     * @var int
     */
    private $id;

    /**
     * Le nom de l'équipe
     *
     * @var string
     */
    private $nomEquipe;

    /**
     * L'ID de l'utilisateur
     *
     * @var int
     */
    private $utilisateurId;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nomEquipe
     */
    public function getNomEquipe()
    {
        return $this->nomEquipe;
    }

    /**
     * Set the value of nomEquipe
     */
    public function setNomEquipe($nomEquipe): self
    {
        $this->nomEquipe = $nomEquipe;

        return $this;
    }

    /**
     * Get the value of utilisateurId
     */
    public function getUtilisateurId()
    {
        return $this->utilisateurId;
    }

    /**
     * Set the value of utilisateurId
     */
    public function setUtilisateurId($utilisateurId): self
    {
        $this->utilisateurId = $utilisateurId;

        return $this;
    }
}
