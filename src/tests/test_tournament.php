<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

require_once('./src/web.inc.all.php');


$tournoi = new Tournoi_tM("Test1", "TestUnit Tournoi", "2021-06-20 10:00:00", 8, "2021-06-10 10:00:00", "2021-06-12 10:00:00", "00:30:00");
$tournoiControl = new Tournoi_tM_Controller();

$equipe = new Equipe_tM(10, "TestEquipe");
$equipeControl = new Equipe_tM_Controller();




#region Test de la fonction CreateTournament(Tournoi_tM $unTournoi) - TEST PASSED
// echo "<pre>";
// var_dump($tournoiControl->CreateTournament($tournoi));
// echo "</pre>";
#endregion

#region Test de la fonction SelectAll() du contrôleur de l'équipe - TEST PASSED
// echo "<pre>";
// var_dump($equipeControl->SelectAll());
// echo "</pre>";
#endregion

#region Test de la fonction FindTeam($idUser) du contrôleur de l'équipe - TEST PASSED
// echo "<pre>";
// var_dump($equipeControl->FindTeam(7));
// echo "</pre>";
#endregion

#region Test de la fonction RegisterTeam($idTournoi, $idEquipe) - TEST PASSED
// echo "<pre>";
// var_dump($tournoiControl->RegisterTeam(1, 9));
// echo "</pre>";
#endregion

#region Test de la fonction UnregisterTeam($idTournoi, $idEquipe) - TEST PASSED
// echo "<pre>";
// var_dump($tournoiControl->UnregisterTeam(1, 9));
// echo "</pre>";
#endregion
