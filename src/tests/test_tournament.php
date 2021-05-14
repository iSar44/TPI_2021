<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

require_once('./src/web.inc.all.php');


$tournoiControl = new Tournoi_tM_Controller();
$tournoiK = $tournoiControl->SelectTournament(1);

$equipeControl = new Equipe_tM_Controller();
// $loser = $equipeControl->FindTeam(5);
// $equipe2 = $equipeControl->FindTeam(3);
// $winner = $equipeControl->FindTeam(7);
// $equipe4 = $equipeControl->FindTeam(5);
// $equipe5 = $equipeControl->FindTeam(6);
// $equipe6 = $equipeControl->FindTeam(7);
// $equipe7 = $equipeControl->FindTeam(8);
// $equipe8 = $equipeControl->FindTeam(9);



#region Test de la fonction SelectTournament() - TEST PASSED!
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
// var_dump($tournoiControl->RegisterTeam($tournoiK, $equipe8));
// echo "</pre>";
#endregion

#region Test de la fonction UnregisterTeam($idTournoi, $idEquipe) - TEST PASSED
// echo "<pre>";
// var_dump($tournoiControl->UnregisterTeam(1, 9));
// echo "</pre>";
#endregion

#region Test de la fonction LoadTournamentTeams(Tournoi_tM $unTournoi) - TEST PASSED!
// echo "<pre>";
// $tournoiControl::LoadTournamentTeams($tournoiK);
// var_dump($tournoiK);
// echo "</pre>";
#endregion

#region Test de la fonction CreateAllRoundsForTournament(Tournoi_tM $unTournoi, $nbMatches, $tempsPreparation = "00:00") - TEST PASSED!
echo "<pre>";
var_dump($tournoiControl->CreateAllRoundsForTournament($tournoiK, 8, "00:01"));
echo "</pre>";
#endregion

#region Test de la fonction CreateMatchTournament(Equipe_tM $team1, Equipe_tM $team2) - TEST PASSED!
// echo "<pre>";
// var_dump($tournoiControl->CreateMatchTournament($equipe1, $equipe2));
// echo "</pre>";
#endregion

#region Test de la fonction LoadTournamentRounds(Tournoi_tM $unTournoi) - TEST PASSED!
// echo "<pre>";
// $tournoiControl::LoadTournamentRounds($tournoiK);
// var_dump($tournoiK);
// echo "</pre>";
#endregion

#region Test de la fonction CheckIfTeamsHaveMet(Tournoi_tM $unTournoi, Equipe_tM $team1, Equipe_tM $team2) - TEST PASSE!
// echo "<pre>";
// var_dump($tournoiControl->CheckIfTeamsHaveMet($tournoi, $equipe1, $equipe2));
// echo "</pre>";
#endregion

#region Test de la fonction StartTournament(Tournoi_tM $unTournoi) - TEST PASSED (à vérifier plus tard)
// echo "<pre>";
// var_dump($tournoiControl::StartTournament($tournoiK));
// echo "</pre>";
#endregion

#region Test de la fonction SetWinner(Equipe_tM $winnerTeam, Equipe_tM $loserTeam) - TEST PASSED
// echo "<pre>";
// var_dump($tournoiControl->SetWinner($winner, $loser));
// echo "</pre>";
#endregion

#region Test de la fonction StopRound(Tournoi_tM $unTournoi) - TEST PENDING
// echo "<pre>";
// var_dump($tournoiControl->StopRound($tournoiK));
// echo "</pre>";
#endregion

// echo "<pre>";
// $tournoiControl::LoadTournamentTeams($tournoiK);
// $tournoiControl::LoadTournamentRounds($tournoiK);
// var_dump($tournoiK);
// echo "</pre>";
