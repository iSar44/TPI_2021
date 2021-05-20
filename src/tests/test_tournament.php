<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

require_once('./src/web.inc.all.php');


$tournoiControl = new Tournoi_tM_Controller();
$tournoiK = $tournoiControl->SelectTournament(2);
// $tournoi16 = $tournoiControl->SelectTournament(2);

$equipeControl = new Equipe_tM_Controller();

$lake2 = $equipeControl->FindTeam(2);
$river3 = $equipeControl->FindTeam(3);
$road4 = $equipeControl->FindTeam(4);
$tree5 = $equipeControl->FindTeam(5);
$cloud6 = $equipeControl->FindTeam(6);
$mountain7 = $equipeControl->FindTeam(7);
$forest8 = $equipeControl->FindTeam(8);
$house9 = $equipeControl->FindTeam(9);
$test10 = $equipeControl->FindTeam(10);
$hill11 = $equipeControl->FindTeam(11);
$hamilton12 = $equipeControl->FindTeam(12);
$alonso13 = $equipeControl->FindTeam(13);
$webber14 = $equipeControl->FindTeam(14);
$mansell15 = $equipeControl->FindTeam(15);
$stewart16 = $equipeControl->FindTeam(16);
$senna17 = $equipeControl->FindTeam(17);



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
// echo "<pre>";
// var_dump($tournoiControl->CreateRoundForTournament($tournoiK, 8, "00:01"));
// echo "</pre>";
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
// var_dump($tournoiControl::TournamentContinues($tournoiK));
// echo "</pre>";

// echo "<pre>";
// $tournoiControl::LoadTournamentTeams($tournoiK);
// $tournoiControl::LoadTournamentRounds($tournoiK);
// var_dump($tournoiK);
// echo "</pre>";


#region TEST -> Simulation d'un tournoi complet! (Equipes déjà inscrites)

// //Création de la 1ère ronde et début du tournoi
// $tournoiControl->CreateRoundForTournament($tournoiK, 8);

#region Deprecated
//Début du tournoi (1ère ronde)
// $tournoiControl->StartTournament($tournoiK);
#endregion

//Résultats de la 1ère ronde
// $tournoiControl->SetWinner($mountain7, $lake2);
// $tournoiControl->SetWinner($river3, $road4);
// $tournoiControl->SetWinner($tree5, $forest8);
// $tournoiControl->SetWinner($cloud6, $house9);

//Fin de la 1ème ronde, création et début de la 2ème
// $tournoiControl->StopRound($tournoiK);

// //Résultats de la 2ème ronde
// $tournoiControl->SetWinner($tree5, $river3);
// $tournoiControl->SetWinner($cloud6, $mountain7);
// $tournoiControl->SetWinner($road4, $lake2);
// $tournoiControl->SetWinner($forest8, $house9);

//Fin de la 2ème ronde, création et début de la 3ème
// $tournoiControl->StopRound($tournoiK);

// Résultats de la 2ème ronde
// $tournoiControl->SetWinner($forest8, $road4);
// $tournoiControl->SetWinner($tree5, $cloud6);
// $tournoiControl->SetWinner($river3, $lake2);
// $tournoiControl->SetWinner($mountain7, $house9);

// //Fin de la 3ème ronde, création et début de la 4ème
//$tournoiControl->StopRound($tournoiK);

#endregion


#region SIMULATION tournoi avec 16 équipes

//Register Team
// $tournoiControl->RegisterTeam($tournoi16, $lake2);
// $tournoiControl->RegisterTeam($tournoi16, $river3);
// $tournoiControl->RegisterTeam($tournoi16, $road4);
// $tournoiControl->RegisterTeam($tournoi16, $tree5);
// $tournoiControl->RegisterTeam($tournoi16, $cloud6);
// $tournoiControl->RegisterTeam($tournoi16, $mountain7);
// $tournoiControl->RegisterTeam($tournoi16, $forest8);
// $tournoiControl->RegisterTeam($tournoi16, $house9);
// $tournoiControl->RegisterTeam($tournoi16, $test10);
// $tournoiControl->RegisterTeam($tournoi16, $hill11);
// $tournoiControl->RegisterTeam($tournoi16, $hamilton12);
// $tournoiControl->RegisterTeam($tournoi16, $alonso13);
// $tournoiControl->RegisterTeam($tournoi16, $webber14);
// $tournoiControl->RegisterTeam($tournoi16, $mansell15);
// $tournoiControl->RegisterTeam($tournoi16, $stewart16);
// $tournoiControl->RegisterTeam($tournoi16, $senna17);


//Création de la 1ère ronde et début du tournoi
// $tournoiControl->CreateRoundForTournament($tournoi16, 16, "00:00");
#endregion


// sendMailTournamentEnded($tournoiK, $mailer);
