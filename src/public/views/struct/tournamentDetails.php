<p class="display-6">Les détails du tournoi</p>
<br />
<table>
    <tr>
        <?php
        foreach ($selectedTournament as $tournoi) {

            $objProperties = $tournoi->getProperties();

            foreach ($objProperties as $key => $value) {
                echo '<tr>';
                echo '<td>';
                switch ($key) {
                    case 'titre':
                        echo "Titre du tournoi: ";
                        break;
                    case 'description':
                        echo "Description: ";
                        break;
                    case 'dateHeureDemarrage':
                        echo "Date/Heure démarrage du tournoi: ";
                        break;
                    case 'nbEquipes':
                        echo "Nombre d'équipes: ";
                        break;
                    case 'dateHeureDebutInscription':
                        echo "Date/Heure début des inscriptions: ";
                        break;
                    case 'dateHeureFinInscription':
                        echo "Date/Heure fin des inscriptions: ";
                        break;
                    case 'tempsEntreRondes':
                        echo "Temps entre les rondes: ";
                        break;
                }
                echo '</td>';
                echo '<td>';
                if (isset($objProperties[$key])) {
                    echo $objProperties[$key];
                }
                echo '</td>';
                echo '</tr>';
            }
        }
        ?>
    <tr>
</table>