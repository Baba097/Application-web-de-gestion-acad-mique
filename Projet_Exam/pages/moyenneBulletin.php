<div class="container mt-5">

    <h1 class="text-center mb-4">
        Calculs et Analyses Pédagogiques
    </h1>
   <br>
    <!-- MOYENNE ETUDIANT -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            Calculer la moyenne d’un étudiant
        </div>
        <div class="card-body">

            <form method="POST" action=<?= $action ?>>
               
                <div class="col-md-6 mb-3">
                    <label class="form-label">Matricule de l'étudiant</label>
                    <input type="text" name="matEtuMoy" class="form-control" required>

                </div>

                <div class="col-md-3 d-flex">
                    <button type="submit" class="btn btn-success w-100" name="calculMoyenne">
                        Calculer
                    </button>
                </div>
                
            </form>

            
            <div class="alert alert-info mt-3">
                <strong>Moyenne :</strong> <?= isset($_GET['matEtuMoy']) ? getMoyenneEtudiant($_GET['matEtuMoy']) : "Aucune moyenne calculée" ?>
                <br>
                <small class="text-muted">* Les TP sont exclus du calcul</small>
            </div>

        </div>
    </div>

    <!-- MOYENNE GENERALE CLASSE-->
    <div id="m2"class="card shadow mb-4">
        <div class="card-header bg-dark text-white">
            Calculer la moyenne générale d’une classe
        </div>
        <div class="card-body">

            <form method="POST" action=<?= $action ?>>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <select class="niveau form-select" required>
                            <option value="">-- Choisir un niveau --</option>
                            <?php foreach($niveaux as $n): ?>
                                <option value="<?= $n['id_niveau'] ?>">
                                    <?= $n['nomNiveau'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>                       
                    </div>

                    <div class="col-md-4 mb-3">
                            <select class="classe form-select" name="id_classe" required>
                                <option value="">-- Choisir une classe --</option>
                            </select>
                    </div>  
                    
                </div>
                <br>
                <div class="col-md-3 d-flex ">
                    <button type="submit" class="btn btn-dark w-100" name="calculMoyenneClasse">
                        Calculer
                    </button>
                </div>
            
            </form>

            <!-- RESULTAT STATIQUE -->
            <div class="alert alert-secondary mt-3">
                <strong>Moyenne Générale :</strong> <?= isset($_GET['id_classe']) ? getMoyenneClasse($_GET['id_classe']) : "Aucune moyenne calculée" ?>
            </div>

        </div>
    </div>

    <!-- GENERER BULLETIN  -->
    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white">
            Générer le bulletin d’un étudiant
        </div>
        <div class="card-body">

            <form method="POST" action="<?="http://localhost/php%20project/Projet_Exam/traitements/genererBulletin.php"?>" target="_blank">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Matricule de l'étudiant</label>
                        <input type="text" name="matricule_etudiant" class="form-control" required>
                    </div>

                    <div class="col-md-3 d-flex ">
                        
                        <button type="submit" class="btn btn-success w-100">
                            Générer PDF
                        </button>
                    </div>
                
            </form>

            <div class="mt-3 text-muted">
                Le bulletin sera généré en format PDF FPDF .
            </div>

        </div>
    </div>

</div>

