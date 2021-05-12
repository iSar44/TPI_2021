<?php
$displayDateDemarrage = date("d/m/Y H:i:s", strtotime($tournoi->getDateHeureDemarrage()));
$displayDateDebutInscription = date("d/m/Y H:i:s", strtotime($tournoi->getDateHeureDebutInscription()));
$displayDateFinInscription = date("d/m/Y H:i:s", strtotime($tournoi->getDateHeureFinInscription()));
?>
<div class="block-heading" style="text-align:center;padding-top: 15px; margin-bottom:5vh;">
    <h2 class="display-2">Détails du tournoi</h2>
</div>
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

    <?php if ($u_controller->CheckIfUserIsAdmin($_SESSION['username']) === 1) : ?>

    <?php else : ?>
        <?php if ($currentDate >= strtotime($tournoi->getDateHeureDebutInscription()) && $currentDate <= strtotime($tournoi->getDateHeureFinInscription())) : ?>
            <form method="POST" action="#">
                <div id="formdiv">

                    <div class="row" style="padding-top:24px;">
                        <div class="mx-auto" style="text-align:center;">
                            <input class="btn btn-primary btn-lg" style="font-family:Roboto, sans-serif;" name="creer" type="submit" value="S'inscrire" />
                        </div>
                    </div>
                </div>
            </form>

        <?php else : ?>

        <?php endif; ?>



    <?php endif; ?>

<?php endif; ?>