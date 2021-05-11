<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-6">
            <br />
            <h3 class="text-dark mb-4">Tournois en cours ou à venir :</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive" id="tabContainer">
                <table class="table table-hover table-bordered table-striped table tablesorter" id="ipi-table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Nom du tournoi</th>
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
                            $statut = (strtotime($aTournament->getDateHeureDemarrage()) < $currentDate) ? "<td><h5>En cours</h5></td>" :  "<td><h5>A venir</h5></td>";
                            $displayDate = date("d/m/Y H:i:s", strtotime($aTournament->getDateHeureDemarrage()));
                            echo "<tr>";
                            echo "<td><h5>" . $aTournament->getTitre() . "</h5></td>";
                            echo "<td><h5>" . $aTournament->getDescription() . "</h5></td>";
                            echo "<td><h5>" . $aTournament->getNbEquipes() . "</h5></td>";
                            echo "<td><h5>" . $displayDate . "</h5></td>";
                            echo $statut;
                            echo "<td class='text-center'>";
                            echo "<a class='btn btn-primary' role='button' style='margin: 2px;'><i class='bi bi-eye-fill'></i></a>";
                            if (strtotime($aTournament->getDateHeureDebutInscription()) > $currentDate && isset($_SESSION['isLoggedIn'])) {
                                echo "<a class='btn btn-success' role='button' style='background: rgb(11,171,56); margin: 2px;' href='./?action=edit&id=" . $aTournament->getId() . "'><i class='bi bi-pencil-fill'></i></a>";
                                echo "<a class='btn btn-danger' role='button' style='margin: 2px;' href='./?action=delete&id=" . $aTournament->getId() . "'><i class='bi bi-trash-fill'></i></a>";
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