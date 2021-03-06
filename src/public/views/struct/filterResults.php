<?php

/**
 * @author Iliya Saroukhanian <iliya.srkhn@eduge.ch>
 * @copyright 2021 Iliya Saroukhanian
 * @version 1.0.0
 */

// function SortResults($duDate = "", $auDate = "", $leStatut = "", $nombreEquipes = "")
// {
//     if (isset($duDate)) {

//         $query = Database::prepare("SELECT `TITRE`, `DESCRIPTION` `NB_EQUIPES`, `DATE_HEURE_DEMARRAGE` FROM TOURNOIS WHERE DATE_HEURE_DEMARRAGE = :DATE_HEURE_DEMARRAGE");

//         $query->bindParam(':DATE_HEURE_DEMARRAGE', $duDate);
//         $query->setFetchMode(PDO::FETCH_ASSOC);

//         try {
//             $results = array();

//             $query->execute();

//             while ($rowInDb = $query->fetch()) {

//                 $tournoi = new Tournoi_tM();

//                 $tournoi->setTitre($rowInDb['TITRE']);
//                 $tournoi->setDescription($rowInDb['DESCRIPTION']);
//                 $tournoi->setNbEquipes($rowInDb['NB_EQUIPES']);
//                 $tournoi->setDateHeureDemarrage($rowInDb['DATE_HEURE_DEMARRAGE']);

//                 array_push($results, $tournoi);

//                 return $results;
//             }
//         } catch (PDOException $e) {
//             return $e->getMessage();
//         }
//     }
// }



// $filterSearch = filter_input(INPUT_POST, 'filterSearch');
// $dateStart = filter_input(INPUT_POST, 'dateStart', FILTER_SANITIZE_STRING);
// $dateStop = filter_input(INPUT_POST, 'dateStop', FILTER_SANITIZE_STRING);
// $tournamentStatus = filter_input(INPUT_POST, 'tournamentStatus', FILTER_SANITIZE_STRING);
// $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);

// if ($filterSearch) {

//     if (isset($dateStart)) {
//         $deDate = date('Y-m-d H:i:s', strtotime($dateStart));
//     }

//     if (isset($dateStop)) {
//         $aDate = date('Y-m-d H:i:s', strtotime($dateStop));
//     }

//     if (isset($tournamentStatus)) {
//         $statut = $tournamentStatus;
//     }

//     if (isset($quantity)) {
//         $nbEquipes = $quantity;
//     }


//     SortResults($deDate);
// }



?>

<div class="card" id="TableSorterCard">
    <div class="card-header py-3">
        <div class="row table-topper align-items-center">
            <div class="filter">
                <h1>Filtrer les tournois</h1>
                <form method="POST" action="#">
                    <span for="datetime">Du:</span>
                    <input type="datetime-local" name="dateStart" value="<?= (isset($currentFilter->dateStart) && !empty($currentFilter->dateStart)) ? $currentFilter->dateStart : "" ?>" />
                    <span for="datetime">Au:</span>
                    <input type="datetime-local" name="dateStop" value="<?= (isset($currentFilter->dateStop) && !empty($currentFilter->dateStop)) ? $currentFilter->dateStop : "" ?>" />
                    <select name="tournamentStatus">
                        <option value="-1" selected>Tous</option>
                        <option value="1">Inscription en cours</option>
                        <option value="2">Tournoi en cours</option>
                        <option value="3">Tournoi ?? venir</option>
                        <option value="4">Tournoi termin??</option>
                    </select>
                    <select name="quantity">
                        <option value="-1" selected>Tous</option>
                        <option value="8">8 ??quipes</option>
                        <option value="16">16 ??quipes</option>
                    </select>
                    <!-- <input type="text" placeholder="Recherche libre" /> -->
                    <br />
                    <input class="btn btn-primary" type="submit" name="filterSearch" value="Rechercher" />
                </form>
                <input type="search" id="myInput" onkeyup="SearchFilter()" data-table="tournament-list" style="margin:auto;" class="md-textarea form-control search-input" placeholder="Rechercher des mots-cl??s" />
            </div>
        </div>
    </div>
</div>