<?php
$displayDateDemarrage = date("d/m/Y H:i:s", strtotime($tournoi->getDateHeureDemarrage()));
$displayDateDebutInscription = date("d/m/Y H:i:s", strtotime($tournoi->getDateHeureDebutInscription()));
$displayDateFinInscription = date("d/m/Y H:i:s", strtotime($tournoi->getDateHeureFinInscription()));

$regiser = filter_input(INPUT_POST, "register");
$unregister = filter_input(INPUT_POST, "unregister");

$e_controller = new Equipe_tM_Controller();
$t_controller = new Tournoi_tM_Controller();


if (!isset($_SESSION['admin'])) {
    $equipe = $e_controller::FindTeam($_SESSION['idUser']);
}

// $results = $t_controller->GetResultsFromTournament($tournoi);
$results = $t_controller->GetTournamentRounds($tournoi);


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



$nomDesEquipes = $e_controller->GetTeamNamesInTournament($tournoi);

?>
<div class="block-heading" style="text-align:center;padding-top: 15px; margin-bottom:5vh;">
    <h2 class="display-2">Détails du tournoi</h2>
</div>
<?php if (isset($displayRegister) && $displayRegister == true) : ?>
    <div class="col-sm-6 col-lg-5 alert alert-success alert-dismissible fade show" style="margin:auto; margin-bottom:5vh;" role="alert">
        <div style="text-align:center;">
            <strong>Félicitations!</strong>
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
            Vous venez de vous désinscrire de ce tournoi!
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
                        <p class="labels"><strong>Date/Heure du démarrage</strong></p>
                    </div>
                    <div class="col">
                        <p class="labels"><?= $displayDateDemarrage; ?></p>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col">
                        <p class="labels"><strong>Nombre d'équipes</strong></p>
                    </div>
                    <div class="col">
                        <p class="labels"><?= $tournoi->getNbEquipes(); ?></p>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col">
                        <p class="labels"><strong>Date/Heure début des inscriptions</strong><br /></p>
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
<?php if (isset($u_controller)) : ?>

    <div class="block-heading" style="text-align:center; margin-top:10vh; padding-top: 15px; margin-bottom:5vh;">
        <h6 class="display-6">Résultats des rondes:</h6>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="table-responsive" id="tabContainer">
                <table class="table table-hover table-bordered table-striped table tablesorter tournament-list" id="ipi-table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Ronde n°:</th>
                            <?php
                            foreach ($nomDesEquipes as $nomEquipe) {
                                echo "<th class='text-center' name='" . $nomEquipe . "'>" . $nomEquipe . "</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        foreach ($results as $allMatchesFromARound) {

                            $level = $allMatchesFromARound->getLevel();

                            echo "<td><b>" . $level . "</b></td>";
                            foreach ($nomDesEquipes as $nomEquipe) {

                                $team = $e_controller->FindTeamByTeamname($nomEquipe);
                                $score = $t_controller->GetIntermediateResultsOfTeam($tournoi, $level, $team);

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

        <?php if ($u_controller->CheckIfUserIsAdmin($_SESSION['username']) === 1) : ?>

        <?php else : ?>
            <?php if ($currentDate >= strtotime($tournoi->getDateHeureDebutInscription()) && $currentDate <= strtotime($tournoi->getDateHeureFinInscription()) && $e_controller->CheckIfTeamIsRegistered($tournoi, $equipe) == false) : ?>
                <form method="POST" action="#">
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
                                <input class="btn btn-danger btn-lg" style="font-family:Roboto, sans-serif;" name="unregister" type="submit" value="Se désinscrire" />
                            </div>
                        </div>
                    </div>
                </form>


            <?php endif; ?>

            <?php if ($currentDate > strtotime($tournoi->getDateHeureFinInscription())) : ?>


            <?php endif; ?>
        <?php endif; ?>

    <?php endif; ?>