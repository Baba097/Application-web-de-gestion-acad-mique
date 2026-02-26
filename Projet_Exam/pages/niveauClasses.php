<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Gestions des niveaux et des classes</h1>
    <br>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="?page=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="?page=statsCalculs">Statistiques</a></li>
    </ol>    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Listes des classes par niveaux
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover text-center" style="table-layout: fixed; width:100%;">
                <thead>
                    <tr class="text-white ">
                        <th scope="col" class="bg-dark" style="width:250px;">Niveaux</th>
                        <th scope="col" colspan="<?= count($classes) ?>" class="bg-dark w-auto">Classes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($niveaux as $n):?>
                        <tr>
                            <th scope="row" class="bg-secondary text-white">
                                <div class="d-flex align-items-center ms-2"> 
                                    <?= $n['nomNiveau'] ?>
                                    <?php if(empty(getClasseLevel($n['id_niveau']))) :?>
                                        <span class="badge bg-danger ms-2" >Aucune classe</span>
                                    <?php endif?>
                                </div>
                            </th>
                            <?php foreach($classes as $c):?>
                                <?php if($c['id_niveau'] == $n['id_niveau']) :?>
                                    <td title="<?= $c['nomClasse'] ?>"><?= $c['codeClasse'] ?></td>
                                <?php endif?>    
                            <?php endforeach?>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
            <a href="?page=niveauClasses&btt=ajoutNiv#t1" class="btn btn-primary  me-2">Ajouter un niveau</a>
            <a href="?page=niveauClasses&btt=ajoutClass#t1" class="btn btn-warning ">Ajouter une classe</a>
        </div>
    </div>
</div>     

<!-- ==== FORMULAIRE NIVEAUX AJOUT / MODIFICATION ==== -->
<p id="t1"></p>
<?php if(isset($_GET['btt']) && $_GET['btt'] == 'ajoutNiv' ):?>
    <br>
    <br>
    <h2 class="text-center">Formulaire Niveau</h2>
    <br>
    <div class="card mb-4 col-md-6 offset-3">
        <div class="card-header bg-primary text-white">
            Ajouter un niveau
        </div>

        <?php if(isset($_GET['success']) && $_GET['success'] == 'yes'):?>
            <span class="alert alert-success text-center">
                Niveau ajouté avec succès.
            </span>
        <?php endif?>
        <?php if(isset($_GET['erreur'])):?>
            <span class="alert alert-danger text-center">      
                    Veuillez bien remplir tous les champs du formulaire.
            </span>  
         <?php endif?>      

        <div class="card-body">
            <form method="POST" action=<?= $action ?>>
                
                <input type="hidden" class="form-control" name="id_niveau" >

                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom_niveau" rows="1" >
                </div>

                <div class="mb-3">
                    <label class="form-label">Code</label>
                    <input type="text" class="form-control" name="code_niveau" required >
                </div>

                <button type="submit" class="btn btn-success" name="ajoutniveau">
                    Ajouter le Niveau
                </button>

            </form>

        </div>
    </div>
<?php endif?>    


<!-- ==== FORMULAIRE CLASSE AJOUT / MODIFICATION ==== -->
    
    <?php if(isset($_GET['btt']) && $_GET['btt'] == 'ajoutClass' ):?>
        <br>
        <br>
        <h2 class="text-center">Formulaire Classe</h2>
        <br>
        <div class="card mb-4 col-md-6 offset-3">
            
            <div class="card-header bg-warning text-white">
               Ajouter une classe
            </div>
                <?php if(isset($_GET['success']) && $_GET['success'] == 'yes'):?>
                    <span class="alert alert-success text-center">            
                            Classe ajoutée avec succès.
                        </span> 
                <?php endif?>

            <?php if(isset($_GET['erreur'])):?>
                <span class="alert alert-danger text-center">            
                        Veuillez bien remplir tous les champs du formulaire.
                    </span> 
             <?php endif?>
            <div class="card-body">
                <form method="POST" action=<?= $action ?>>

                    <input type="hidden" name="id" >

                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" required >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Code</label>
                        <input type="text" class="form-control" name="code" required >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Niveau</label>
                        <select class="form-select" name="id_niveau">
                            <?php foreach($niveaux as $niveau):?>
                                <option value="<?= $niveau['id_niveau'] ?>"><?= $niveau['nomNiveau'] ?></option>
                            <?php endforeach?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success" name="ajoutClasse">
                       Ajouter la classe
                    </button>

                </form>
            </div>
        </div>
    <?php endif?>





