<?php

$submit = filter_input(INPUT_POST, 'creer');

$titreTournoi = filter_input(INPUT_POST, 'titreTournoi', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$dateHeureDemarrage = filter_input(INPUT_POST, 'dateHeureDemarrageTournoi');
$nbEquipes = filter_input(INPUT_POST, 'nbEquipes', FILTER_SANITIZE_NUMBER_INT);
$dateHeureDebutInscription = filter_input(INPUT_POST, 'dateHeureDebutInscription');
$dateHeureFinInscription = filter_input(INPUT_POST, 'dateHeureFinInscription');
$tempsEntreRondes = filter_input(INPUT_POST, 'tempsEntreRondes');

$t_controller = new Tournoi_tM_Controller();





if ($submit) {

    // if (isset($titreTournoi)) {
    //     continue;
    // }

    // if (isset($description)) {
    //     continue;
    // }

    // if (isset($dateHeureDemarrage)) {
    //     continue;
    // }

    // if (isset($nbEquipes)) {
    //     continue;
    // }

    // if (isset($dateHeureDebutInscription)) {
    //     continue;
    // }

    // if (isset($dateHeureFinInscription)) {
    //     continue;
    // }

    $newTournoi = new Tournoi_tM($titreTournoi, $description, $dateHeureDemarrage, $nbEquipes, $dateHeureDebutInscription, $dateHeureFinInscription, $tempsEntreRondes);

    $t_controller->CreateTournament($newTournoi);
}


?>





<form method="POST" action="#">
    <div class="form-group mb-3" style="margin:auto; max-width: 60vw;">
        <div id="formdiv">
            <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                <div class="col-md-8 offset-md-1">
                    <p style="font-family:Roboto, sans-serif;font-size:24px;">
                        <strong>Titre du tournoi: </strong>
                    </p>
                </div>
                <div class="col-md-10 offset-md-1">
                    <input type="text" class="form-control" style="margin-left:0px;font-family:Roboto, sans-serif;" name="titreTournoi" placeholder="Titre" required />
                </div>
            </div>
            <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                <div class="col-md-8 offset-md-1">
                    <p style="font-family:Roboto, sans-serif;font-size:24px;">
                        <strong>Description: </strong>
                    </p>
                </div>
                <div class="col-md-10 offset-md-1">
                    <textarea class="form-control" style="font-family:Roboto, sans-serif;" name="description" placeholder="Description" required></textarea>
                </div>
            </div>
            <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                <div class="col-md-8 offset-md-1">
                    <p style="font-family:Roboto, sans-serif;font-size:24px;">
                        <strong>Date/Heure du démarrage: </strong>
                    </p>
                </div>
                <div class="col-md-10 offset-md-1">
                    <input class="form-control" style="font-family:Roboto, sans-serif;" name="dateHeureDemarrageTournoi" type="datetime-local" required />
                </div>
            </div>
            <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px">
                <div class="col-md-8 offset-md-1">
                    <p style="font-family:Roboto, sans-serif;font-size:24px;">
                        <strong>Nombre d'équipes: </strong>
                    </p>
                </div>
                <div class="col-md-10 offset-md-1">
                    <select class="form-select" style="font-family:Roboto, sans-serif;" name="nbEquipes" required>
                        <option value="title" disabled selected>Nombre d&#39;équipes</option>
                        <option value="8">8</option>
                        <option value="16">16</option>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                <div class="col-md-8 offset-md-1">
                    <p style="font-family:Roboto, sans-serif;font-size:24px;">
                        <strong>Date/Heure début inscriptions: </strong>
                    </p>
                </div>
                <div class="col-md-10 offset-md-1">
                    <input class="form-control" style="font-family:Roboto, sans-serif;" name="dateHeureDebutInscription" type="datetime-local" required />
                </div>
            </div>
            <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                <div class="col-md-8 offset-md-1">
                    <p style="font-family:Roboto, sans-serif;font-size:24px;">
                        <strong>Date/Heure fin inscriptions: </strong>
                    </p>
                </div>
                <div class="col-md-10 offset-md-1">
                    <input class="form-control" style="font-family:Roboto, sans-serif;" name="dateHeureFinInscription" type="datetime-local" required />
                </div>
            </div>
            <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                <div class="col-md-8 offset-md-1">
                    <p style="font-family:Roboto, sans-serif;font-size:24px;">
                        <strong>Temps entre les rondes: (optionnel)</strong>
                    </p>
                </div>
                <div class="col-md-10 offset-md-1">
                    <input type="time" class="form-control" style="margin-left:0px;font-family:Roboto, sans-serif;" name="tempsEntreRondes" />
                </div>
            </div>
            <div class="row" style="display:flex;flex-direction:row;padding-top:24px;">
                <!-- <div class="col-12 col-md-4 offset-md-5"> -->
                <div class="w-50 mx-auto" style="margin:auto;">
                    <input class="btn btn-warning btn-lg" style="margin-left:10%; font-family:Roboto, sans-serif;" type="reset" value="Remettre à zéro" />
                    <input class="btn btn-success btn-lg" style="margin-left:10%; font-family:Roboto, sans-serif;" name="creer" type="submit" value="Créer" />
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</form>