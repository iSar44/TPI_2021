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
                <table class="table table-striped table tablesorter" id="ipi-table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Nom du tournoi</th>
                            <th class="text-center">Nombre d&#39;equipes</th>
                            <th class="text-center">Date/heure du démarrage</th>
                            <th class="text-center">Statut</th>
                            <th class="text-center">Description</th>
                            <th class="text-center filter-false sorter-false">action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        foreach ($res as $attr) {
                            echo "<tr>";
                            echo "<td>" . $attr->getTitre() . "</td>";
                            echo "<td>" . $attr->getNbEquipes() . "</td>";
                            echo "<td>" . $attr->getDateHeureDemarrage() . "</td>";
                            echo "<td>X</td>";
                            echo "<td>" . $attr->getDescription() . "</td>";
                            echo "<td class='text-center'>";
                            echo "<a class='btn btn-primary' role='button' style='margin: 2px;'><i class='bi bi-eye-fill'></i></a>";
                            echo "<a class='btn btn-success' role='button' style='background: rgb(11,171,56); margin: 2px;'><i class='bi bi-pencil-fill'></i></a>";
                            echo "<a class='btn btn-danger' role='button' style='margin: 2px;'><i class='bi bi-trash-fill'></i></a>";
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