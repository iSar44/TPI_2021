<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

//Classes
require_once('./src/model/classes/session.php');
require_once('./src/model/db_model/database.php');
require_once('./src/model/classes/utilisateur_tM.php');
require_once('./src/model/classes/equipe_tM.php');
require_once('./src/model/classes/tournoi_tM.php');
require_once('./src/model/classes/ronde_tM.php');
require_once('./src/model/classes/match_tM.php');

//Controllers
require_once('./src/controllers/utilisateur_tM_controller.php');
require_once('./src/controllers/tournoi_tM_controller.php');
require_once('./src/controllers/equipe_tM_controller.php');
