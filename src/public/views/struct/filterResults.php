<div class="card" id="TableSorterCard">
    <div class="card-header py-3">
        <div class="row table-topper align-items-center">
            <div class="filter">
                <h1>Filtrer les résultats</h1>
                <form>
                    <span for="datetime">Du:</span>
                    <input type="datetime-local" />
                    <span for="datetime">Au:</span>
                    <input type="datetime-local" />
                    <select>
                        <option value="title" disabled selected>Statut</option>
                        <option value="inscriptionEnCours">Inscription en cours</option>
                        <option value="tournoiEnCours">Tournoi en cours</option>
                        <option value="tournoiAVenir">Tournoi à venir</option>
                        <option value="tournoiTermine">Tournoi terminé</option>
                    </select>
                    <select>
                        <option value="title" disabled selected>Nombre d&#39;équipes</option>
                        <option value="8">8</option>
                        <option value="16">16</option>
                    </select>
                    <input type="text" placeholder="Recherche libre" />
                    <input class="btn btn-primary" type="submit" value="Rechercher" />
                </form>
            </div>
        </div>
    </div>
</div>