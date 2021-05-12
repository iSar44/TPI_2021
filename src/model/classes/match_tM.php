<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

require_once('./src/web.inc.all.php');

/**
 * Classe qui représente un match
 */
class Match_tM
{
    /**
     * Champ qui représente l'ID de la première équipe
     *
     * @var int
     */
    private $idTeam1;

    /**
     * Champ qui représente l'ID de la seconde équipe
     *
     * @var int
     */
    private $idTeam2;

    /**
     * Champ qui représente l'ID de l'équipe gagnante
     *
     * @var int
     */
    private $idWinner;

    /**
     * Get the value of idTeam1
     */
    public function getIdTeam1()
    {
        return $this->idTeam1;
    }

    /**
     * Set the value of idTeam1
     */
    public function setIdTeam1($idTeam1): self
    {
        $this->idTeam1 = $idTeam1;

        return $this;
    }

    /**
     * Get the value of idTeam2
     */
    public function getIdTeam2()
    {
        return $this->idTeam2;
    }

    /**
     * Set the value of idTeam2
     */
    public function setIdTeam2($idTeam2): self
    {
        $this->idTeam2 = $idTeam2;

        return $this;
    }

    /**
     * Get the value of idWinner
     */
    public function getIdWinner()
    {
        return $this->idWinner;
    }

    /**
     * Set the value of idWinner
     */
    public function setIdWinner($idWinner): self
    {
        $this->idWinner = $idWinner;

        return $this;
    }

    /**
     * Constructeur de la classe Match_tM
     *
     * @param integer $team1Id
     * @param integer $team2Id
     * @param integer $winnerId
     */
    public function __construct($team1Id = 0, $team2Id = 0, $winnerId = 0)
    {
        $this->setIdTeam1($team1Id);
        $this->setIdTeam2($team2Id);
        $this->setIdWinner($winnerId);
    }
}
