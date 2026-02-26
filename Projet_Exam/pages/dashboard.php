
<div class="container-fluid px-4">
    <h1 class="mt-4">📋 Dashboard - Etudiants</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="?page=statsCalculs">Statistics</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <br>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1" id="tdt"></i>
                Tableau de Bord de l'institution académique
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Matricule</th>
                            <th>Nom et Prenom</th>
                            <th>Date de naissance</th>
                            <th>Niveau</th>
                            <th>Classe</th>
                            <th>Annee académique</th>
                            <th>Moyenne</th>
                            <th>Statut</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($etudiants as $e):?>
                            <tr>
                                <td><?= $e['matricule'] ?></td>
                                <td><?= $e['NomEtud'] . " " . $e['PrenomEtud'] ?></td>
                                <td><?= date("d/m/Y", strtotime($e['datenaiss'])) ?></td>
                                <td><?= getCodeNiveau(getIdNivClass($e['id_classe'])) ?></td>
                                <td><?= getCodeClasse($e['id_classe']) ?></td>
                                <td><?= $e['anacad'] ?></td>
                                <td><?= getMoyenneEtudiant($e['id_etudiant']) ?></td>
                                <td><span class="badge bg-<?= colorStatut(statutEtudiant($e['id_etudiant'])) ?>"><?= statutEtudiant($e['id_etudiant']) ?></span></td>
                            </tr>
                        <?php endforeach?>

                    </tbody>
                </table>
            </div>
        </div>
</div>
<br>