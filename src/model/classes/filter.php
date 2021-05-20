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
class Filter
{
    public $dateStart;
    public $dateStop;
    public $tournamentStatus;
    public $nbEquipe;

    public function __construct()
    {
        $this->dateStart = "";
        $this->dateStop = "";
        $this->tournamentStatus = -1;
        $this->nbEquipe = -1;
    }
}
