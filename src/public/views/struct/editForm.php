<?php

$submit = filter_input(INPUT_POST, 'creer');

$titreTournoi = filter_input(INPUT_POST, 'titreTournoi', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$dateHeureDemarrage = filter_input(INPUT_POST, 'dateHeureDemarrageTournoi');
$nbEquipes = filter_input(INPUT_POST, 'nbEquipes', FILTER_SANITIZE_NUMBER_INT);
$dateHeureDebutInscription = filter_input(INPUT_POST, 'dateHeureDebutInscription');
$dateHeureFinInscription = filter_input(INPUT_POST, 'dateHeureFinInscription');
$tempsEntreRondes = filter_input(INPUT_POST, 'tempsEntreRondes');


if ($submit) {

    if ($dateHeureDemarrage > $dateHeureFinInscription && $dateHeureFinInscription > $dateHeureDebutInscription) {

        $leTournoi = new Tournoi_tM($titreTournoi, $description, $dateHeureDemarrage, $nbEquipes, $dateHeureDebutInscription, $dateHeureFinInscription, $tempsEntreRondes);
        $t_controller->EditTournament($leTournoi, $_GET['id']);
        $noError = true;
        unset($_GET['id']);

        header('Location: ./');
    } else {

        $error = true;
    }
}

?>

<form method="POST" action="#">
    <div class="form-group mb-3" style="margin:auto; max-width: 60vw;">
        <?php if (isset($error) && $error == true) : ?>
            <div style="max-width: 60vw;" class="alert alert-danger alert-dismissible fade show" role="alert">
                <div style="text-align:center;">
                    <strong>Erreur!</strong>
                    <br />
                    Vérifier bien que le tournoi débute après la fin des inscriptions!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php elseif (isset($noError) && $noError == true) : ?>
            <div style="max-width: 60vw;" class="alert alert-success alert-dismissible fade show" role="alert">
                <div style="text-align:center;">
                    <strong>Tournoi modifié!</strong>
                    <br />
                    Les modifications concernant le tournoi sont appliquées!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>
        <?php foreach ($selectedTournament as $tournoi) {  ?>
            <div id="formdiv">
                <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                    <div class="col-md-8 offset-md-1">
                        <p style="font-family:Roboto, sans-serif;font-size:24px;">
                            <strong>Titre du tournoi: </strong>
                        </p>
                    </div>
                    <div class="col-md-10 offset-md-1">
                        <input type="text" value='<?= $tournoi->getTitre(); ?>' class="form-control" style="margin-left:0px;font-family:Roboto, sans-serif;" name="titreTournoi" placeholder="Titre" required />
                    </div>
                </div>
                <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                    <div class="col-md-8 offset-md-1">
                        <p style="font-family:Roboto, sans-serif;font-size:24px;">
                            <strong>Description: </strong>
                        </p>
                    </div>
                    <div class="col-md-10 offset-md-1">
                        <textarea class="form-control" style="font-family:Roboto, sans-serif;" name="description" placeholder="Description" required><?= $tournoi->getDescription(); ?></textarea>
                    </div>
                </div>
                <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                    <div class="col-md-8 offset-md-1">
                        <p style="font-family:Roboto, sans-serif;font-size:24px;">
                            <strong>Date/Heure du démarrage: </strong>
                        </p>
                    </div>
                    <div class="col-md-10 offset-md-1">
                        <input class="form-control" value='<?= date("Y-m-d\TH:i:s", strtotime($tournoi->getDateHeureDemarrage())); ?>' style="font-family:Roboto, sans-serif;" name="dateHeureDemarrageTournoi" type="datetime-local" required />
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
                            <option value="title" disabled>Nombre d&#39;équipes</option>
                            <option value='<?= $tournoi->getNbEquipes(); ?>' selected><?= $tournoi->getNbEquipes(); ?></option>
                            <?php if ($tournoi->getNbEquipes() == 16) : ?>
                                <option value="8">8</option>
                            <?php else : ?>
                                <option value="16">16</option>
                            <?php endif; ?>
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
                        <input class="form-control" value='<?= date("Y-m-d\TH:i:s", strtotime($tournoi->getDateHeureDebutInscription())); ?>' style="font-family:Roboto, sans-serif;" name="dateHeureDebutInscription" type="datetime-local" required />
                    </div>
                </div>
                <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                    <div class="col-md-8 offset-md-1">
                        <p style="font-family:Roboto, sans-serif;font-size:24px;">
                            <strong>Date/Heure fin inscriptions: </strong>
                        </p>
                    </div>
                    <div class="col-md-10 offset-md-1">
                        <input class="form-control" value='<?= date("Y-m-d\TH:i:s", strtotime($tournoi->getDateHeureFinInscription())); ?>' style="font-family:Roboto, sans-serif;" name="dateHeureFinInscription" type="datetime-local" required />
                    </div>
                </div>
                <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                    <div class="col-md-8 offset-md-1">
                        <p style="font-family:Roboto, sans-serif;font-size:24px;">
                            <strong>
                                Temps entre les rondes: (optionnel)
                                <h6>Format: HH:MM</h6>
                            </strong>
                        </p>
                    </div>
                    <div class="col-md-10 offset-md-1">
                        <input type="time" value='<?= $tournoi->getTempsEntreRondes(); ?>' class="form-control" style="margin-left:0px;font-family:Roboto, sans-serif;" name="tempsEntreRondes" />
                    </div>
                </div>
                <div class="row" style="padding-top:24px;">
                    <div class="mx-auto" style="text-align:center;">
                        <input class="btn btn-warning btn-lg" style="font-family:Roboto, sans-serif;" name="creer" type="submit" value="Modifier le tournoi" />
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</form>