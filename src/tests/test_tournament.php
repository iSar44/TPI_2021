<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

require_once('./src/web.inc.all.php');


$tournoi = new Tournoi_tM(1, "Test1", "TestUnit Tournoi", "2021-06-20 10:00:00", 8, "2021-06-10 10:00:00", "2021-06-12 10:00:00", "00:30:00");
$tournoiControl = new Tournoi_tM_Controller();

$equipeControl = new Equipe_tM_Controller();
$equipe1 = $equipeControl->FindTeam(8);
$equipe2 = $equipeControl->FindTeam(9);


#region Test de la fonction SelectTournament() - TEST PASSED
// echo "<pre>";
// var_dump($tournoiControl->SelectTournament(1));
// echo "</pre>";
#endregion

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

#region Test de la fonction LoadTournamentTeams(Tournoi_tM $unTournoi) - TEST PASSED!
// echo "<pre>";
// var_dump($tournoiControl::LoadTournamentTeams($tournoi));
// echo "</pre>";
#endregion

#region Test de la fonction CreateRoundTournament(Tournoi_tM $unTournoi, $level, $nbMatches, $tempsPreparation = "00:00") - TEST PASSED!
// echo "<pre>";
// var_dump($tournoiControl->CreateRoundTournament($tournoi, 1, 8));
// echo "</pre>";
#endregion

#region Test de la fonction CreateMatchTournament(Equipe_tM $team1, Equipe_tM $team2) - TEST PASSED!
// echo "<pre>";
// var_dump($tournoiControl->CreateMatchTournament($equipe1, $equipe2));
// echo "</pre>";
#endregion

#region Test de la fonction LoadTournamentRounds(Tournoi_tM $unTournoi) - TEST PASSED
// echo "<pre>";
// var_dump($tournoiControl::LoadTournamentRounds($tournoi));
// echo "</pre>";
#endregion

#region Test de la fonction CheckIfTeamsHaveMet(Tournoi_tM $unTournoi, Equipe_tM $team1, Equipe_tM $team2) - TEST PASSED
// echo "<pre>";
// var_dump($tournoiControl->CheckIfTeamsHaveMet($tournoi, $equipe1, $equipe2));
// echo "</pre>";
#endregion
