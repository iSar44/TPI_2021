<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

$u_controller = new Utilisateur_tM_Controller();

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-6">
            <br />
            <h3 class="text-dark mb-4">Liste des tournois :</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive" id="tabContainer">
                <table class="table table-hover table-bordered table-striped table tablesorter tournament-list" id="ipi-table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Titre du tournoi</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Nombre d&#39;equipes</th>
                            <th class="text-center">Date/heure du démarrage</th>
                            <th class="text-center">Statut</th>
                            <th class="text-center filter-false sorter-false">action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        foreach ($allTournaments as $aTournament) {

                            $bInclude = true;

                            $lastRoundLevel = 0;
                            $rounds = $t_manager->GetTournamentRounds($aTournament);
                            $nbTeamsSignedUp = count($t_manager->GetTournamentTeams($aTournament));

                            if (!empty($rounds)) {
                                $lastRound = end($rounds);
                                $lastRoundLevel = $lastRound->getLevel();
                            }

                            if (isset($currentFilter)) {

                                if ($currentFilter->dateStart == null && $currentFilter->dateStop == null && $currentFilter->nbEquipe == 0 && $currentFilter->tournamentStatus == 0) {
                                    $bInclude = true;
                                } else {
                                    // On filtre par nb equipes
                                    if ($currentFilter->nbEquipe != -1 && $currentFilter->nbEquipe != $aTournament->getNbEquipes())
                                        $bInclude = false;

                                    // On filtre par date du début du tournoi
                                    if (!empty($currentFilter->dateStart) && !empty($currentFilter->dateStop)) {

                                        if (strtotime($aTournament->getDateHeureDemarrage()) <= strtotime($currentFilter->dateStart) || strtotime($aTournament->getDateHeureDemarrage()) >= strtotime($currentFilter->dateStop)) {
                                            $bInclude = false;
                                        }
                                    } else {

                                        if (!empty($currentFilter->dateStart)) {

                                            $tStart = strtotime($aTournament->getDateHeureDemarrage());
                                            $dateFilter = strtotime($currentFilter->dateStart);

                                            if (strtotime($aTournament->getDateHeureDemarrage()) <= strtotime($currentFilter->dateStart)) {
                                                $bInclude = false;
                                            }
                                        }

                                        if (!empty($currentFilter->dateStop)) {

                                            if (strtotime($aTournament->getDateHeureDemarrage()) >= strtotime($currentFilter->dateStop)) {
                                                $bInclude = false;
                                            }
                                        }
                                    }


                                    // On filtre par status du tournoi
                                    if ($currentFilter->tournamentStatus != -1) {
                                        switch ($currentFilter->tournamentStatus) {
                                            case 1: // Inscription en cours

                                                #region Deprecated
                                                // if ((strtotime($aTournament->getDateHeureDebutInscription()) >= time()) && (strtotime($aTournament->getDateHeureFinInscription()) < time())) {
                                                //     $bInclude = true;
                                                // }
                                                // $con = strtotime($aTournament->getDateHeureDebutInscription()) <= time() && strtotime($aTournament->getDateHeureFinInscription()) > time();
                                                #endregion

                                                if (!(strtotime($aTournament->getDateHeureDebutInscription()) <= time() && strtotime($aTournament->getDateHeureFinInscription()) > time())) {
                                                    $bInclude = false;
                                                }
                                                break;
                                            case 2: // Tournois en cours

                                                #region Deprecated
                                                // if (strtotime($aTournament->getDateHeureDemarrage()) >= time()) {
                                                //     if ($aTournament->getNbEquipes() == 8 && $lastRoundLevel == 4)
                                                //         $bInclude = false;
                                                //     else
                                                //     if ($aTournament->getNbEquipes() == 16 && $lastRoundLevel == 5)
                                                //         $bInclude = false;
                                                // } else
                                                //     $bInclude = false;
                                                #endregion

                                                if ($aTournament->getNbEquipes() == 8) {
                                                    if (!(strtotime($aTournament->getDateHeureDemarrage()) <= time() && isset($lastRoundLevel) && $lastRoundLevel != 4)) {
                                                        $bInclude = false;
                                                    }
                                                } else {
                                                    if (!(strtotime($aTournament->getDateHeureDemarrage()) <= time() && isset($lastRoundLevel) && $lastRoundLevel != 5)) {
                                                        $bInclude = false;
                                                    }
                                                }


                                                break;
                                            case 3: // A venir

                                                #region Deprecated
                                                // $test = strtotime($aTournament->getDateHeureDemarrage()) > time(); && strtotime($aTournament->getDateHeureDebutInscription() >= time());

                                                // $t3 = strtotime($aTournament->getDateHeureDebutInscription()) >= time();

                                                // if (!(strtotime($aTournament->getDateHeureDemarrage()) <= time())) {
                                                //     $bInclude = false;
                                                // }
                                                #endregion

                                                if (!(strtotime($aTournament->getDateHeureDemarrage()) > time() && strtotime($aTournament->getDateHeureDebutInscription()) >= time())) {
                                                    $bInclude = false;
                                                }
                                                break;
                                            case 4: // Terminé

                                                #region Deprecated
                                                // $test = strtotime($aTournament->getDateHeureDemarrage()) <= time() && isset($lastRoundLevel) && $lastRoundLevel == 5;

                                                // if (strtotime($aTournament->getDateHeureDemarrage()) <= time()) {
                                                //     if (!isset($lastRoundLevel) && $lastRoundLevel != 5) {
                                                //         $bInclude = false;
                                                //     }
                                                // } else {
                                                //     $bInclude = false;
                                                // }
                                                #endregion

                                                if (!(strtotime($aTournament->getDateHeureDemarrage()) <= time() && isset($lastRoundLevel) && $lastRoundLevel == 5)) {
                                                    $bInclude = false;
                                                }
                                                break;
                                        }
                                    }
                                }
                            }
                            if ($bInclude == false)
                                continue;

                            if (isset($lastRoundLevel) && $lastRoundLevel == 5) {
                                $statut = "<td><h5>Tournoi terminé</h5></td>";
                            } else {

                                if (strtotime($aTournament->getDateHeureDemarrage()) < $currentDate) {
                                    $statut = "<td><h5>Tournoi en cours</h5></td>";
                                } else {
                                    if (strtotime($aTournament->getDateHeureDebutInscription()) <= $currentDate && strtotime($aTournament->getDateHeureFinInscription()) >= $currentDate) {
                                        $statut = "<td><h5>Inscriptions en cours</h5></td>";
                                    } elseif ($nbTeamsSignedUp == $aTournament->getNbEquipes()) {
                                        $statut = "<td><h5>Inscriptions fermées</h5></td>";
                                    } else {
                                        $statut = "<td><h5>A venir</h5></td>";
                                    }
                                }
                                // $statut = (strtotime($aTournament->getDateHeureDemarrage()) < $currentDate) ? "<td><h5>En cours</h5></td>" :  "<td><h5>A venir</h5></td>";
                            }

                            $displayDate = date("d/m/Y H:i:s", strtotime($aTournament->getDateHeureDemarrage()));
                            echo "<tr>";
                            echo "<td><h5>" . $aTournament->getTitre() . "</h5></td>";
                            echo "<td><h5>" . $aTournament->getDescription() . "</h5></td>";
                            echo "<td><h5>" . $aTournament->getNbEquipes() . "</h5></td>";
                            echo "<td><h5>" . $displayDate . "</h5></td>";
                            echo $statut;
                            echo "<td class='text-center'>";

                            if (isset($_SESSION['username'])) {
                                if ($u_controller->CheckIfUserIsAdmin($_SESSION['username']) === 1) {
                                    echo "<a href='./?action=getDetails&id=" . $aTournament->getId() . "' class='btn btn-primary' role='button' style='margin: 2px;'><i class='bi bi-eye-fill'></i></a>";
                                } else {
                                    echo "<a href='./?action=getDetails&id=" . $aTournament->getId() . "' class='btn btn-primary' role='button' style='margin: 2px;'><i class='bi bi-eye-fill'></i></a>";
                                }
                            } else {
                                echo "<a href='./?action=login' class='btn btn-primary' role='button' style='margin: 2px;'><i class='bi bi-eye-fill'></i></a>";
                            }

                            if (strtotime($aTournament->getDateHeureDebutInscription()) > $currentDate && isset($u_controller) && $u_controller->CheckIfUserIsAdmin($_SESSION['username']) === 1) {
                                echo "<a href='./?action=edit&id=" . $aTournament->getId() . "' class='btn btn-success' role='button' style='background: rgb(11,171,56); margin: 2px;'><i class='bi bi-pencil-fill'></i></a>";
                                echo "<a href='./?action=delete&id=" . $aTournament->getId() . "' class='btn btn-danger' role='button' style='margin: 2px;'><i class='bi bi-trash-fill'></i></a>";
                            }

                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>