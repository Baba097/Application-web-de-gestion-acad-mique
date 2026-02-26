
<div class="container mt-5">

    <h1 class="mb-4">📊 Statistiques et Calculs</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="?page=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Statistics</li>
    </ol>  
    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card text-center shadow border-0">
                <div class="card-body bg-primary text-white">
                    <h5>Nombre de Niveaux</h5>
                    <h3><?= count($niveaux) ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow border-0">
                <div class="card-body bg-success text-white">
                    <h5>Nombre de Classes</h5>
                    <h3><?= count($classes) ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow border-0">
                <div class="card-body bg-dark text-white">
                    <h5>Nombre d'Étudiants</h5>
                    <h3><?= count($etudiants) ?></h3>
                </div>
            </div>
        </div>

    </div>

    <!-- ETUDIANTS PAR NIVEAU -->
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white">
            Nombre d'étudiants par niveau
        </div>
        <div class="card-body">

            <table class="table table-bordered text-center">
                <thead class="table-info">
                    <tr>
                        <th>Niveau</th>
                        <th>Nombre d'Étudiants</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($niveaux as $n):?>
                        <?php $etudiantsParNiveau = getEtudNiveau($n['id_niveau']); ?>
                            <tr>
                                <td><?= $n['nomNiveau'] ?></td>
                                <td><?= count($etudiantsParNiveau) ?></td>
                            </tr>
                    <?php endforeach?>    
                </tbody>
            </table>

        </div>
    </div>

    <!--  CLASSES PAR NIVEAU  -->
    <div class="card shadow mb-4">
        <div class="card-header bg-warning">
            Nombre de classes par niveau
        </div>
        <div class="card-body">

            <table class="table table-bordered text-center">
                <thead class="table-warning">
                    <tr>
                        <th>Niveau</th>
                        <th>Nombre de Classes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($niveaux as $n):?>
                            <tr>
                                <td><?= $n['nomNiveau'] ?></td>
                                <td><?= count(getClasseLevel($n['id_niveau'])) ?></td>
                            </tr>
                    <?php endforeach?>  
                </tbody>
            </table>

        </div>
    </div>

    <!--  REPARTITION PEDAGOGIQUE  -->
    <div class="card shadow mb-4">
        <div class="card-header bg-danger text-white">
            Répartition des étudiants (Décision)
        </div>
        <div class="card-body">

            <div class="row text-center">

                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5>Admis</h5>
                            <h3><?= nbrEtudAdmis() ?></h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-warning">
                        <div class="card-body">
                            <h5>Ajournés</h5>
                            <h3><?= nbrEtudAjourne() ?></h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h5>Exclus</h5>
                            <h3><?= nbrEtudExclut() ?></h3>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
