

<div class="container py-5">

    <h2 class="mb-4 text-center">Gestion des Modules et des Évaluations</h2>
    <br>
    <div class="card shadow mb-5">
        <div class="card-header bg-info text-white">
                Ajouter un module
        </div>
            <?php if(isset($_GET['success']) && $_GET['success'] == 'yes'):?>
                <span class="alert alert-success text-center">
                    Module ajouté avec succès.
                </span>
            <?php endif?>
            <?php if(isset($_GET['erreur'])):?>
                <span class="alert alert-danger text-center">      
                        Veuillez bien remplir tous les champs du formulaire.
                </span>  
             <?php endif?>
        <div class="card-body">
            <form method="POST" action="traitements/actions.php">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nom Module</label>
                        <input type="text" name="nomModu" class="form-control" required placeholder="EX : Mathématique">
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Code Module</label>
                        <input type="text" name="codeModu" class="form-control" required placeholder="EX : MATH">
                    </div>

                </div>   
                <br>
                <button type="submit" class="btn btn-info" name="ajoutModule">
                    Ajouter Module
                </button>                 
            </form>
        </div>
        <div class="card-footer">
            <a href="?page=moduleEvaluations&btt=ajoutModu#t2" class="btn btn-primary  me-2">Ajouter un module dans une classe</a>
            <a href="?page=moduleEvaluations&btt=ajoutEval#t4" class="btn btn-warning ">Ajouter une évaluation à un étudiant</a>
            <a href="?page=moduleEvaluations&btt=enrgEval#t3" class="btn btn-success me-2">Enregistrer les évaluations d'un étudiant</a>  

        </div>
            
    </div>

    <!-- 1. Ajouter un module à une classe -->

    <?php if(isset($_GET['btt']) && $_GET['btt'] == 'ajoutModu' ):?>

        <div class="card shadow mb-5">
            <div id="t2" class="card-header bg-primary text-white">
                Ajouter un module à une classe
            </div>
            <?php if(isset($_GET['success']) && $_GET['success'] == 'yes'):?>
                <span class="alert alert-success text-center">
                    Module ajouté à la classe avec succès.
                </span>
            <?php endif?>
            <?php if(isset($_GET['erreur'])):?>
                <span class="alert alert-danger text-center">      
                        Veuillez bien remplir tous les champs du formulaire.
                </span>  
             <?php endif?>

            <div class="card-body">

                <form method="POST" action=<?= $action ?>>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Niveau</label>
                            <select class="niveau form-select" name="id_niveau" required>
                                <option value="">-- Choisir un niveau --</option>
                                <?php foreach($niveaux as $n): ?>
                                    <option value="<?= $n['id_niveau'] ?>">
                                        <?= $n['nomNiveau'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>                       
                        </div>

                        <div class="col-md-4 mb-3">
                                <label class="form-label">Classe</label>
                                <select class="classe form-select" name="id_classe" required>
                                    <option value="">-- Choisir une classe --</option>
                                </select>
                        </div>                
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Modules</label>
                        <select class="form-select" name="id_module" required>
                            <option value="">-- Choisir un Module --</option>
                            <?php foreach($modules as $m): ?>
                                <option value="<?= $m['id_module'] ?>">
                                    <?= $m['Nom_modu'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>                       
                    </div>


                    <button type="submit" class="btn btn-primary" name="ajoutModuleClasse">
                        Ajouter Module
                    </button>

                </form>

            </div>
        </div>
    <?php endif?>

    <!-- Ajouter une nouvelle évaluation à un étudiant -->
    <?php if(isset($_GET['btt']) && $_GET['btt'] == 'ajoutEval' ):?>
         
        <div class="card shadow">
            <div id="t4" class="card-header bg-dark text-white">
                Ajouter une nouvelle évaluation à un étudiant
            </div>
                <?php if(isset($_GET['success']) && $_GET['success'] == 'yes'):?>
                    <span class="alert alert-success text-center">
                        Évaluation ajoutée avec succès.
                    </span>
                <?php endif?>
                <?php if(isset($_GET['error'])):?>
                    <span class="alert alert-danger text-center">      
                            Veuillez bien remplir tous les champs du formulaire.
                    </span>
                <?php endif?>
            <div class="card-body">

                <form method="POST" action=<?= $action ?>>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Code de l'évaluation</label>
                        <input type="text" name="code_evalu" class="form-control" readonly placeholder="Générer automatiquement">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Matricule de l'étudiant</label>
                        <input type="text" name="matricule" class="form-control" required placeholder="Ex: L3IAGEcj-26-0000">
                    </div>

                    <div class="row mb-4 mb-3">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Modules</label>
                            <select class="form-select" name="code_modu" required>
                                <option value="">-- Choisir un Module --</option>
                                <?php foreach($modules as $m): ?>
                                    <option value="<?= $m['code_modu'] ?>">
                                        <?= $m['Nom_modu'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>                       
                        </div>                       
                            <div class="col-md-4">
                                <label class="form-label">Type</label>
                                <select name="type_evalu" class="form-select" required>
                                    <option value="Devoir">Devoir</option>
                                    <option value="Examen">Examen</option>
                                    <option value="TP">TP</option>
                                </select>
                            </div>
                    </div>                    


                    <div class="col-md-4 mb-3">
                        <label class="form-label">Date de l'évaluation</label>
                        <input type="date" name="date_evalu" class="form-control" required>
                    </div>
                
                    <button type="submit" class="btn btn-dark" name="ajoutEval">
                        Ajouter Évaluation
                    </button>

                </form>

            </div>
        </div>
    <?php endif?>


    <!--  Gestion des évaluations -->

    <?php if(isset($_GET['btt']) && $_GET['btt'] == 'enrgEval' ):?>
        <div class="card shadow mb-5">
            <div id="t3" class="card-header bg-success text-white">
                Enregistrer / Modifier / Supprimer une Évaluation
            </div>
            <?php if(isset($_GET['success']) && $_GET['success'] == 'yes'):?>
                <span class="alert alert-success text-center">
                    Évaluation enregistrée avec succès.
                </span>
            <?php endif?>

                <?php if(isset($_GET['suppsuccess']) && $_GET['suppsuccess'] == 'yes'):?>
                    <span class="alert alert-success text-center">
                        Évaluation supprimée avec succès.
                    </span>
            <?php endif?>
            <?php if(isset($_GET['error'])):?>
                <span class="alert alert-danger text-center">      
                        Veuillez bien remplir tous les champs du formulaire et vérifier les données saisies.
                </span>
            <?php endif?>

            <div class="card-body">

                <form method="POST" action=<?= $action ?>>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Code de l'évaluation</label>
                        <input type="text" name="code_evalu" class="code_evalu form-control" placeholder="EX: AN-Devo-L1IIAcj-00-0000" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Matricule Étudiant</label>
                            <input type="text" class="matricule form-control" placeholder="Saisir code Evalution" readonly required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Code Module</label>
                            <input type="text"  class="code_modu form-control" placeholder="Saisir code Evalution" readonly required>
                        </div>
                    </div>
                    <?php if(!isset($_GET['supprimerEval'])):?>
                        <div class="col-md-4 mb-3">
                                <label class="form-label">Note</label>
                                <input type="number" step="0.01" name="note" class="form-control" placeholder="Ex: 15.5" required>
                        </div>
                    <?php endif?> 

                    <div class="card-footer">
                        <?php if(!isset($_GET['supprimerEval'])):?>
                            <button type="submit" name="enrgEval" value="ajouter" class="btn btn-success ">
                                Enregistrer
                            </button>

                            <button type="submit" name="modifEval" value="modifier" onclick="return confirm('Modifier cette évaluation ?');" class="btn btn-warning text-white">
                                Modifier
                            </button>
                            <a href="?page=moduleEvaluations&btt=enrgEval&supprimerEval=yes#t3" class="btn btn-danger ms-auto">
                                Supprimer une évaluation ?
                            </a>
                        <?php endif?>    

                        <?php if(isset($_GET['supprimerEval'])):?>
                            <button type="submit" name="suppEval" value="supprimer" onclick="return confirm('Supprimer cette évaluation ?');" class="btn btn-danger">
                                Supprimer
                            </button>
                        <?php endif?>
                    </div>

                </form>

            </div>
        </div>
    <?php endif?>

    

</div>
    