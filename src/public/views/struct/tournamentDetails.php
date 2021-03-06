<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

// unset($_SESSION['startEmailSent']);

$displayDateDemarrage = date("d/m/Y H:i:s", strtotime($tournoi->getDateHeureDemarrage()));
$displayDateDebutInscription = date("d/m/Y H:i:s", strtotime($tournoi->getDateHeureDebutInscription()));
$displayDateFinInscription = date("d/m/Y H:i:s", strtotime($tournoi->getDateHeureFinInscription()));

$regiser = filter_input(INPUT_POST, "register");
$unregister = filter_input(INPUT_POST, "unregister");
$setResultTeam1Wins = filter_input(INPUT_POST, "setResultTeam1Wins");
$setResultTeam2Wins = filter_input(INPUT_POST, "setResultTeam2Wins");

$arrMatches = $t_controller->GetResultsFromTournament($tournoi);
$teams = $t_controller->GetTournamentTeams($tournoi);
$rounds = $t_controller->GetTournamentRounds($tournoi);

$lastRound = end($rounds);

if (!empty($lastRound)) {
    $lastRoundLevel = $lastRound->getLevel();
}

$_SESSION['tournamentFinished'] = false;

if ($currentDate >= strtotime($tournoi->getDateHeureDemarrage()) && isset($_SESSION['tournamentFinished']) && $_SESSION['tournamentFinished'] != true) {
    $_SESSION['tournamentStarted'] = true;

    if (empty($rounds)) {

        $nbTeams = $tournoi->getNbEquipes();
        $nbMatches = $nbTeams / 2;

        $t_controller::CreateRoundForTournament($tournoi, $nbMatches);

        $getRounds = $t_controller->GetTournamentRounds($tournoi);


        //$_SESSION['tournamentStarted'] = true;


        foreach ($getRounds as $uneRonde) {

            $lesMatchs = $uneRonde->getMatches();

            foreach ($lesMatchs as $unMatch) {

                $team1Id = $unMatch->getIdTeam1();
                $team2Id = $unMatch->getIdTeam2();

                $infoTeam1 = $e_controller::FindTeam($team1Id);
                $infoTeam2 = $e_controller::FindTeam($team2Id);

                sendMailToPlayersStartTournament($infoTeam1, $infoTeam2, $tournoi, $mailer);
                sendMailToPlayersStartTournament($infoTeam2, $infoTeam1, $tournoi, $mailer);
            }
        }

        $_SESSION['startEmailSent'] = true;

        header("Location: " . $_SERVER['REQUEST_URI']);
        // header("Location: ./?action=getDetails&id" . $_GET['id'] . "");
    } /*elseif (count($rounds) == 1 && !isset($_SESSION['startEmailSent'])) {

        foreach ($rounds as $uneRonde) {

            $lesMatchs = $uneRonde->getMatches();

            foreach ($lesMatchs as $unMatch) {

                $team1Id = $unMatch->getIdTeam1();
                $team2Id = $unMatch->getIdTeam2();

                $infoTeam1 = $e_controller::FindTeam($team1Id);
                $infoTeam2 = $e_controller::FindTeam($team2Id);

                sendMailToPlayersStartTournament($infoTeam1, $infoTeam2, $tournoi, $mailer);
                sendMailToPlayersStartTournament($infoTeam2, $infoTeam1, $tournoi, $mailer);
            }
        }

        $_SESSION['startEmailSent'] = true;
    } */ else {


        if (Tournoi_tM_Controller::StopRound($tournoi) == false) {

            if ($_SESSION['tournamentFinished'] != true) {
                $msgToChangeRound = true;
            } else {
                $msgToChangeRound = false;
                $msgTournamentFinished = true;
            }
            // if ($lastRoundLevel == 5) {
            //     sendMailTournamentEnded($unTournoi, $mailer);
            //     $_SESSION['tournamentFinished'] = true;
            //     $msgToChangeRound = false;
            // }
        } else {
            // sendMailToPlayersEndRound($unTournoi, $mailer);
            header("Location: " . $_SERVER['REQUEST_URI']);
            $msgToChangeRound = false;
        }
    }
}

/*if ($currentDate >= strtotime($tournoi->getDateHeureDemarrage())) {

    $nbTeams = $tournoi->getNbEquipes();
    $nbMatches = $nbTeams / 2;

    $t_controller::CreateRoundForTournament($tournoi, $nbMatches);

    $_SESSION['tournamentStarted'] = true;
} elseif (isset($_SESSION['tournamentStarted']) && $_SESSION['tournamentStarted'] == true) {
}*/



// $tournament = $t_controller->SelectTournament(1);
// $e1 = $e_controller->FindTeam(2);
// $e2 = $e_controller->FindTeam(3);

// sendMailToPlayersStartTournament($e1, $e2, $tournament, $mailer);



if (isset($_SESSION['admin']) && $_SESSION['admin'] == 0) {
    $equipe = $e_controller::FindTeam($_SESSION['idUser']);
}

if ($regiser) {

    if ($t_controller->RegisterTeam($tournoi, $equipe)) {
        $displayRegister = true;
    }
}

if ($unregister) {
    if ($t_controller->UnregisterTeam($tournoi, $equipe)) {
        $displayUnregister = true;
    }
}


if ($setResultTeam1Wins) {

    $firstTeam = $_POST['firstTeam'];
    $secondTeam = $_POST['secondTeam'];

    $winner = $e_controller->FindTeamByTeamname($firstTeam);
    $loser = $e_controller->FindTeamByTeamname($secondTeam);

    $t_controller->SetWinner($winner, $loser);

    echo "<meta http-equiv='refresh' content='0'>";

    $updateResult = true;
}

if ($setResultTeam2Wins) {

    $firstTeam = $_POST['firstTeam'];
    $secondTeam = $_POST['secondTeam'];

    $loser = $e_controller->FindTeamByTeamname($firstTeam);
    $winner = $e_controller->FindTeamByTeamname($secondTeam);

    $t_controller->SetWinner($winner, $loser);

    echo "<meta http-equiv='refresh' content='0'>";

    $updateResult = true;
}



$nomDesEquipes = $e_controller->GetTeamNamesInTournament($tournoi);

?>
<div class="block-heading" style="text-align:center;padding-top: 15px; margin-bottom:5vh;">
    <h2 class="display-2">D??tails du tournoi</h2>
</div>
<?php if (isset($displayRegister) && $displayRegister == true) : ?>
    <div class="col-sm-6 col-lg-5 alert alert-success alert-dismissible fade show" style="margin:auto; margin-bottom:5vh;" role="alert">
        <div style="text-align:center;">
            <strong>F??licitations!</strong>
            <br />
            Vous venez de vous inscrire au tournoi!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>
<?php if (isset($displayUnregister) && $displayUnregister == true) : ?>
    <div class="col-sm-6 col-lg-5 alert alert-warning alert-dismissible fade show" style="margin:auto; margin-bottom:5vh;" role="alert">
        <div style="text-align:center;">
            <strong>Attention!</strong>
            <br />
            Vous venez de vous d??sinscrire de ce tournoi!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>
<?php /*if (isset($updateResult) && $updateResult == true) :*/ ?>
<!-- <div class="col-sm-6 col-lg-5 alert alert-success alert-dismissible fade show" style="margin:auto; margin-bottom:5vh;" role="alert">
        <div style="text-align:center;">
            <strong>R??sultats des matchs</strong>
            <br />
            Vous venez d'apporter une modification au r??sultat d'un match!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div> -->
<?php /*endif;*/ ?>
<?php if (isset($msgToChangeRound) && $msgToChangeRound == true) : ?>
    <div class="col-sm-6 col-lg-5 alert alert-warning alert-dismissible fade show" style="margin:auto; margin-bottom:5vh;" role="alert">
        <div style="text-align:center;">
            <strong>Attention!</strong>
            <br />
            Afin de pouvoir d??buter la ronde suivante, veuillez mettre ?? jour tous les r??sultats de la ronde en cours.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>

<?php if (isset($msgTournamentFinished) && $msgTournamentFinished == true) : ?>
    <div class="col-sm-6 col-lg-5 alert alert-info alert-dismissible fade show" style="margin:auto; margin-bottom:5vh;" role="alert">
        <div style="text-align:center;">
            <strong>Tournoi termin??</strong>
            <br />
            Ce tournoi est termin??, les r??sultats d??finitifs sont affich??s ci-dessous.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>
<div class="row justify-content-center">
    <div class="col-sm-6 col-lg-5" style="padding-right: 0px;padding-left: 0px;">
        <div class="card clean-card text-center">
            <div class="card-body info">
                <div class="row">
                    <div class="col" style="padding-bottom: 6px;">
                        <p class="labels"><strong>Titre</strong></p>
                    </div>
                    <div class="col">
                        <p class="labels"><?= $tournoi->getTitre(); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p class="labels"><strong>Description</strong></p>
                    </div>
                    <div class="col">
                        <p class="labels"><?= $tournoi->getDescription(); ?></p>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col">
                        <p class="labels"><strong>Date/Heure du d??marrage</strong></p>
                    </div>
                    <div class="col">
                        <p class="labels"><?= $displayDateDemarrage; ?></p>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col">
                        <p class="labels"><strong>Nombre d'??quipes</strong></p>
                    </div>
                    <div class="col">
                        <p class="labels"><?= $tournoi->getNbEquipes(); ?></p>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col">
                        <p class="labels"><strong>Date/Heure d??but des inscriptions</strong><br /></p>
                    </div>
                    <div class="col">
                        <p class="labels"><?= $displayDateDebutInscription; ?></p>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col">
                        <p class="labels"><strong>Date/Heure fin des inscriptions</strong><br /></p>
                    </div>
                    <div class="col">
                        <p class="labels"><?= $displayDateFinInscription; ?></p>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col">
                        <p class="labels"><strong>Temps entre les rondes (HH:MM:SS)</strong><br /></p>
                    </div>
                    <div class="col">
                        <p class="labels"><?= $tournoi->getTempsEntreRondes(); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (isset($_SESSION['isLoggedIn']) && $currentDate > strtotime($tournoi->getDateHeureDemarrage())) : ?>

    <div class="block-heading" style="text-align:center; margin-top:10vh; padding-top: 15px; margin-bottom:5vh;">
        <h6 class="display-6">Points (par ronde) de chaque ??quipe:</h6>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="table-responsive" id="tabContainer">
                <table class="table table-hover table-bordered table-striped table tablesorter tournament-list" id="ipi-table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Ronde n??:</th>
                            <?php
                            foreach ($nomDesEquipes as $nomEquipe) {
                                echo "<th class='text-center' name='" . $nomEquipe . "'>" . $nomEquipe . "</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        foreach ($rounds as $allMatchesFromARound) {

                            $level = $allMatchesFromARound->getLevel();

                            echo "<td><b>" . $level . "</b></td>";
                            foreach ($nomDesEquipes as $nomEquipe) {

                                $team = $e_controller->FindTeamByTeamname($nomEquipe);
                                $score = $t_controller->GetIntermediateResultsOfTeam($tournoi, $level, $team);
                                $globalScore = $t_controller->GetGlobalResultsOfTeam($tournoi, $team);

                                $endResult = Equipe_tM_Controller::GetTeamResultsFromTournament($tournoi, $team);

                                // if ($score >= 1) {
                                //     if ($level == 4 && $endResult[1] == 3) {
                                //         $score = "Q";
                                //         echo "<td style='margin:auto;color:green;font-size:1.5em;'><strong>" . $score . "</strong></td>";
                                //     } else {
                                //         echo "<td style='margin:auto;color:green;font-size:1.5em;'><strong>" . $score . "</strong></td>";
                                //     }
                                // } else {
                                //     if ($level >= 4 && $endResult[1] == 0 || $level >= 5 && $endResult[1] <= 2) {
                                //         $score = "DQ";
                                //         echo "<td style='margin:auto;color:red;font-size:1.5em;'><strong>" . $score . "</strong></td>";
                                //     } elseif ($level == 4 && $endResult[1] == 3) {
                                //         $score = "Q";
                                //         echo "<td style='margin:auto;color:green;font-size:1.5em;'><strong>" . $score . "</strong></td>";
                                //     } else {
                                //         echo "<td style='margin:auto;color:red;font-size:1.5em;'><strong>" . $score . "</strong></td>";
                                //     }
                                // }


                                if ($score == 1) {
                                    echo "<td style='margin:auto;color:green;font-size:1.5em;'><strong>" . $score . "</strong></td>";
                                } else {
                                    echo "<td style='margin:auto;color:red;font-size:1.5em;'><strong>" . $score . "</strong></td>";
                                }
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="block-heading" style="text-align:center; margin-top:10vh; padding-top: 15px; margin-bottom:5vh;">
        <h6 class="display-6">R??sultats des rondes:</h6>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="table-responsive" id="tabContainer">
                <table class="table table-hover table-bordered table-striped table tablesorter tournament-list" id="ipi-table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Ronde n??:</th>
                            <th class="text-center">Team 1</th>
                            <th class="text-center">Team 2</th>
                            <th class="text-center">Vainqueur</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        foreach ($arrMatches as $matchInRonde) {

                            $tId = (int)$_GET['id'];

                            $matchInRonde->setTournamentId($tId);
                            $level = $matchInRonde->getLevel();
                            $idPlayers = $matchInRonde->getMatches();


                            foreach ($idPlayers as $player) {
                                $team1 = $player->getIdTeam1();
                                $team2 = $player->getIdTeam2();
                                $winner = $player->getIdWinner();
                            }


                            echo "<tr>";
                            echo "<td style='background-color:#51596a;color:white;font-size:1.25em;'><b>" .  $level . "</b></td>";

                            if ($team1 != $winner && $team2 != $winner) {
                                if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                                    echo "<form method='POST'action=" . $_SERVER['REQUEST_URI'] . ">";
                                    echo "<td>";
                                    echo "<input type='submit' name='setResultTeam1Wins' class='btn btn-warning' role='button' style='margin:auto' value='" . $e_controller->GetTeamName($team1) . "'/>";
                                    echo "<input type='hidden' name='firstTeam' value='" . $e_controller->GetTeamName($team1) . "'/>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<input type='submit' name='setResultTeam2Wins' class='btn btn-warning' role='button' style='margin:auto' value='" . $e_controller->GetTeamName($team2) . "'/>";
                                    echo "<input type='hidden' name='secondTeam' value='" . $e_controller->GetTeamName($team2) . "'/>";
                                    echo "</td>";
                                    echo "</form>";
                                } else {
                                    echo "<td>";
                                    echo "<input type='submit' class='btn btn-warning' role='button' style='margin:auto' value='" . $e_controller->GetTeamName($team1) . "'/>";
                                    echo "<input type='hidden' value='" . $e_controller->GetTeamName($team1) . "'/>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<input type='submit' class='btn btn-warning' role='button' style='margin:auto' value='" . $e_controller->GetTeamName($team2) . "'/>";
                                    echo "<input type='hidden' value='" . $e_controller->GetTeamName($team2) . "'/>";
                                    echo "</td>";
                                }
                            } else {

                                if ($team1 == $winner) {
                                    echo "<td style='margin:auto;background-color:lightgreen;'>" . $e_controller->GetTeamName($team1) . "</td>";
                                } else {
                                    echo "<td style='margin:auto;background-color:#ff726f;'>" . $e_controller->GetTeamName($team1) . "</td>";
                                }

                                if ($team2 == $winner) {
                                    echo "<td style='margin:auto;background-color:lightgreen;'>" . $e_controller->GetTeamName($team2) . "</td>";
                                } else {
                                    echo "<td style='margin:auto;background-color:#ff726f;'>" . $e_controller->GetTeamName($team2) . "</td>";
                                }
                            }

                            if ($e_controller->GetTeamName($winner) == "") {
                                echo "<td><strong>N/A</strong></td>";
                            } else {
                                echo "<td><strong>" . $e_controller->GetTeamName($winner) . "</strong></td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="block-heading" style="text-align:center; margin-top:10vh; padding-top: 15px; margin-bottom:5vh;">
        <h6 class="display-6">Classement des ??quipes: </h6>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="table-responsive" id="tabContainer">
                <table class="table table-hover table-bordered table-striped table tablesorter tournament-list" id="ipi-table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Etat</th>
                            <th class="text-center">Equipe</th>
                            <th class="text-center">Points accumul??s</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        if ($lastRoundLevel == 5 && $_SESSION['tournamentFinished'] == true) {
                            foreach ($teams as $aTeam) {

                                $tabPoints = $e_controller::GetTeamResultsFromTournament($tournoi, $aTeam);
                                $status = null;

                                if ($tabPoints[1] >= 3) {
                                    $status = "QUALIFIED";
                                } elseif ($tabPoints[1] <= 2) {
                                    $status = "DEFEATED";
                                }

                                echo "<tr>";
                                if ($status == "QUALIFIED") {
                                    echo "<td style='margin:auto;background-color:lightgreen;'>" . $status . "</td>";
                                } elseif ($status == "DEFEATED") {
                                    echo "<td style='margin:auto;background-color:#ff726f;'>" . $status . "</td>";
                                } else {
                                    echo "<td>NOT DECIDED</td>";
                                }
                                echo "<td>" . $aTeam->getNomEquipe() . "</td>";
                                echo "<td>" . $tabPoints[1] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            foreach ($teams as $aTeam) {

                                $tabPoints = $e_controller::GetTeamResultsFromTournament($tournoi, $aTeam);
                                $status = null;

                                if ($tabPoints[1] >= 3) {
                                    $status = "QUALIFIED";
                                } elseif ($tabPoints[1] == 0) {
                                    $status = "DEFEATED";
                                }

                                echo "<tr>";
                                if ($status == "QUALIFIED") {
                                    echo "<td style='margin:auto;background-color:lightgreen;'>" . $status . "</td>";
                                } elseif ($status == "DEFEATED") {
                                    echo "<td style='margin:auto;background-color:#ff726f;'>" . $status . "</td>";
                                } else {
                                    echo "<td>NOT DECIDED</td>";
                                }
                                echo "<td>" . $aTeam->getNomEquipe() . "</td>";
                                echo "<td>" . $tabPoints[1] . "</td>";
                                echo "</tr>";
                            }
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php if (isset($_SESSION['admin'])) : ?>

    <?php if ($_SESSION['admin'] == 1) : ?>

    <?php else : ?>

        <?php if ($currentDate >= strtotime($tournoi->getDateHeureDebutInscription()) && $currentDate <= strtotime($tournoi->getDateHeureFinInscription()) && $e_controller->CheckIfTeamIsRegistered($tournoi, $equipe) == false) : ?> <form method="POST" action="#">
                <div id="formdiv">

                    <div class="row" style="padding-top:24px;">
                        <div class="mx-auto" style="text-align:center;">
                            <input class="btn btn-primary btn-lg" style="font-family:Roboto, sans-serif;" name="register" type="submit" value="S'inscrire" />
                        </div>
                    </div>
                </div>
            </form>

        <?php elseif ($e_controller->CheckIfTeamIsRegistered($tournoi, $equipe) && $currentDate <= strtotime($tournoi->getDateHeureFinInscription())) : ?>
            <form method="POST" action="#">
                <div id="formdiv">

                    <div class="row" style="padding-top:24px;">
                        <div class="mx-auto" style="text-align:center;">
                            <input class="btn btn-danger btn-lg" style="font-family:Roboto, sans-serif;" name="unregister" type="submit" value="Se d??sinscrire" />
                        </div>
                    </div>
                </div>
            </form>

        <?php endif; ?>
    <?php endif; ?>

<?php endif; ?>