<?php
require_once "requetes.php";
$index= "http://localhost/php%20project/Projet_Exam/index.php";

//AJOUTER NIVEAU
if(isset($_POST['ajoutniveau'])){
    extract($_POST);

    if(!empty(trim($nom_niveau)) && !empty(trim($code_niveau))){
            if (addNiveau($nom_niveau,$code_niveau)){
            header("Location: $index?page=niveauClasses&btt=ajoutNiv&success=yes#t1");
            exit;
        }
    }
    else{
        header("Location: $index?page=niveauClasses&btt=ajoutNiv&erreur=invalidArguments#t1");
        exit;
    }

}

//AJOUTER CLASSE
if(isset($_POST['ajoutClasse'])){
    extract($_POST);
    if(empty(trim($nom)) || empty(trim($code)) || empty(trim($id_niveau))){
        header("Location: $index?page=niveauClasses&btt=ajoutClass&erreur=invalidArguments#t1");
        exit;
    }
   
    if(addClasse($nom,$code,$id_niveau)){
        header("Location: $index?page=niveauClasses&btt=ajoutClass&success=yes#t1");
        exit;
    }

}  

//INSCRIRE ETUDIANT
if(isset($_POST['inscrire'])){
    extract($_POST);
    if(empty(trim($nom)) || empty(trim($prenom)) || empty(trim($dateNaiss)) || empty(trim($id_classe)) || empty(trim($anacad)) || $anacad < 2000 || $anacad > date("Y")){
        header("Location: $index?page=etudiants&erreur=invalidArguments");
        exit;
    }
    $codeClasse = getCodeClasse($id_classe);
    $code_niveau = getCodeNiveau($id_niveau);
    $matricule = genererMatricule($code_niveau, $codeClasse, $anacad);   
    if(inscrireEtud($nom,$prenom,$matricule,$dateNaiss,$id_classe,$anacad)){
        header("Location: $index?page=etudiants&success=yes");
        exit;
    }
    else{
        header("Location: $index?page=etudiants&success=no");
        exit;
    }
}

//MATRICULE
function genererMatricule($code_niveau, $codeClasse ,$annee)
{
    global $pdo;
    $code_niveau = trim($code_niveau);
    $codeClasse = trim($codeClasse);
    // Extraire les 2 derniers chiffres de l'année
    $anneeShort = substr($annee, -2);

    //recuperer le dernier matricule
    $lastMatricule = LastMatricule();

    if ($lastMatricule && isset($lastMatricule['matricule'])) {
        // Extraire le numéro du matricule existant
        $numero = intval(substr($lastMatricule['matricule'], -4)) + 1;
    } else {
        $numero = 1;
    }

    // Format 4 chiffres (0001, 0002...)
    $numeroFormate = str_pad($numero, 4, "0", STR_PAD_LEFT);
    return $code_niveau . $codeClasse . "cj-" . $anneeShort . "-" . $numeroFormate;
}

//RECUPERER ETUDIANT PAR NIVEAU

if(isset($_POST['afficherEtud'])){
    extract($_POST);

    if(!empty($id_classe)){
        if(getEtudClasse($id_classe)){
            header("Location: $index?page=etudiants&id_classe=$id_classe#affiche");
            exit;
        }
        else{
            header("Location: $index?page=etudiants&affiche_success=no#affiche");
            exit;
        }
    }
    else{    
        header("Location: $index?page=etudiants&affiche_success=vide#affiche");
        exit;
    }
}

//RECUPERER CLASSES PAR NIVEAU JS

if(isset($_GET['id_niveau']) && !empty($_GET['id_niveau'])){

    $id_niveau = intval($_GET['id_niveau']);

    $req = $pdo->prepare("SELECT id_classe, codeClasse FROM classes WHERE id_niveau = ? ORDER BY codeClasse");
    $req->execute([$id_niveau]);

    $classes = $req->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($classes);
}



if(isset($_GET['code_evalu']) && !empty($_GET['code_evalu'])){

    $code = htmlspecialchars($_GET['code_evalu']);

    $result = getMatriuleIdModu($code);

    header('Content-Type: application/json');

    echo json_encode($result ?: []);
}


//AJOUTER MODULE et MODULE A UNE CLASSE
if(isset($_POST['ajoutModule'])){
    extract($_POST);
    if(empty(trim($nomModu)) || empty(trim($codeModu))){
        header("Location: $index?page=moduleEvaluations&erreur=invalidArguments");
        exit;
    }
    $codeModu = strtoupper($codeModu);
    if(addModu($nomModu,$codeModu)){
        header("Location: $index?page=moduleEvaluations&success=yes");
        exit;
    }
    else{
        header("Location: $index?page=moduleEvaluations&success=no");
        exit;
    }
}

if(isset($_POST['ajoutModuleClasse'])){
    extract($_POST);
    if(addModuClasse($id_module,$id_classe)){
        header("Location: $index?page=moduleEvaluations&btt=ajoutModu&success=yes#t2");
        exit;
    }
    else{
        header("Location: $index?page=moduleEvaluations&btt=ajoutModu&success=no#t2");
        exit;
    }
}

//EVALUATIONS
    
if(isset($_POST['enrgEval'])){
    extract($_POST);

    if(empty(trim($code_evalu)) || empty(trim($note))){
        header("Location: $index?page=moduleEvaluations&btt=enrgEval&error=caseVide#t3");
        exit;
    }
    $id_evalu = getIdEvalu(trim($code_evalu));
    if(empty($id_evalu) || $note < 0 || $note > 20){
        header("Location: $index?page=moduleEvaluations&btt=enrgEval&error=invalidArguments#t3");
        exit;
    }    
    else{
        if(enrgEval($id_evalu,$note)){
            header("Location: $index?page=moduleEvaluations&btt=enrgEval&success=yes#t3");
            exit;
        }
        else{
            header("Location: $index?page=moduleEvaluations&btt=enrgEval&success=no#t3");
            exit;
        }
    }
}

if(isset($_POST['modifEval'])){
    extract($_POST);
    
    if(empty(trim($code_evalu)) || empty(trim($note))){
        header("Location: $index?page=moduleEvaluations&btt=enrgEval&error=caseVide#t3");
        exit;
    }
    $id_evalu = getIdEvalu(trim($code_evalu));
    if(empty($id_evalu) || $note < 0 || $note > 20){
        header("Location: $index?page=moduleEvaluations&btt=enrgEval&error=invalidArguments#t3");
        exit;
    }    
    else{
        if(modifEval($id_evalu,$note)){
            header("Location: $index?page=moduleEvaluations&btt=enrgEval&success=yes#t3");
            exit;
        }
        else{
            header("Location: $index?page=moduleEvaluations&btt=enrgEval&success=no#t3");
            exit;
        }        
    }
}

if(isset($_POST['suppEval'])){
    extract($_POST);
     if(empty(trim($code_evalu))){
        header("Location: $index?page=moduleEvaluations&btt=enrgEval&error=caseVide#t3");
        exit;
    }
    $id_evalu = getIdEvalu(trim($code_evalu));
    if(empty($id_evalu)){
        header("Location: $index?page=moduleEvaluations&btt=enrgEval&error=invalidArguments#t3");
        exit;
    }
    if(suppEval($id_evalu)){
        header("Location: $index?page=moduleEvaluations&btt=enrgEval&suppsuccess=yes#t3");
        exit;
    }
    else{
        header("Location: $index?page=moduleEvaluations&btt=enrgEval&success=no#t3");
        exit;
    }
}

if(isset($_POST['ajoutEval'])){
    extract($_POST);
    $id_etudiant = !empty(getIdEtud($matricule)) ? getIdEtud($matricule) : 0;
    $id_module = !empty(getIdModu($code_modu)) ? getIdModu($code_modu) : 0;
    $code_evalu = ($code_modu)."-".substr($type_evalu,0,4)."-".($matricule);
    if($id_etudiant == 0 || $id_module == 0){
        header("Location: $index?page=moduleEvaluations&btt=ajoutEval&error=invalidArguments#t4");
        exit;
    }
    else{
        if(addEval($code_evalu,$id_etudiant,$id_module,$type_evalu,$date_evalu)){
            header("Location: $index?page=moduleEvaluations&btt=ajoutEval&success=yes#t4");
            exit;
        }
        else{
            header("Location: $index?page=moduleEvaluations&btt=ajoutEval&success=no#t4");
            exit;
        }
    }
}

//MEILLEUR ETUDIANT 
if(isset($_POST['bestEtudClass'])){
    extract($_POST);
    if(empty(trim($id_classe))){
        header("Location: $index?page=etudiants&btt=bec&idBestEtudClass=$id_classe#af2");
        exit;
    }
    else{
        header("Location: $index?page=etudiants&btt=bec&erreur=Casevide#af2");
        exit;
    }
}

if(isset($_POST['bestEtudNiveau'])){
    extract($_POST);
    if(!empty($id_niveau)){
        header("Location: $index?page=etudiants&btt=ben&idBestEtudNiveau=$id_niveau#af3");
        exit;
    }
    else{
        header("Location: $index?page=etudiants&btt=ben&erreur=Casevide#af3");
        exit;
    }
}

//FONCTION POUR AFFICHER LES ETUDIANTS AU DESSUS DE LA MOYENNE DE LEUR CLASSE

function EtudSupMoyClasse($classes,$etudiantClasse){
    $etud = [];
    foreach($classes as $c){
        foreach($etudiantClasse as $e){
            if($c['id_classe'] == $e['id_classe'] && getMoyenneEtudiant($e['id_etudiant']) > getMoyenneClasse($c['id_classe'])){
                $etud[] = $e;
            }
        }
    }
    return $etud;
}

//AFFICHER
if(isset($_POST['afficherSupMoy'])){
    extract($_POST);
    if(!empty($id_classe)){
        header("Location: $index?page=etudiants&btt=bemc&id_classe=$id_classe#af4");
        exit;
    }
    else{
        header("Location: $index?page=etudiants&btt=bemc&erreur=Casevide#af4");
        exit;
    }
}

//FONCTION STATUT ETUDIANT
function statutEtudiant($id_etudiant){
    $moyenne = getMoyenneEtudiant($id_etudiant) ?: -1;
    if($moyenne >= 10){
        return "Admis";
    }
    else if($moyenne >= 5 && $moyenne < 10){
        return "Ajournés";
    }
    else if($moyenne < 5 && $moyenne >= 0){
        return "Excluts";
    }
    else{
        return "Statut inconnu";
    }
}

function colorStatut($statut){
    if($statut == "Admis"){
        return "success";
    }
    else if($statut == "Ajournés"){
        return "warning";
    }
    else if($statut == "Excluts"){
        return "danger";
    }
    else{
        return "secondary";
    }
}

//Bulletin
if(isset($_POST['calculMoyenne'])){
    extract($_POST);
    if(empty(trim($matEtuMoy))){
        header("Location: $index?page=moyenneBulletin&error=caseVide");
        exit;
    }
    $id_etudiant = getIdEtud(trim($matEtuMoy));
    if(empty($id_etudiant)){
        header("Location: $index?page=moyenneBulletin&error=invalidMatricule");
        exit;
    }
    else{
        header("Location: $index?page=moyenneBulletin&matEtuMoy=$id_etudiant");
        exit;
    }
}

if(isset($_POST['calculMoyenneClasse'])){
    extract($_POST);
    if(empty(trim($id_classe))){
        header("Location: $index?page=moyenneBulletin&error=caseVide#m2");
        exit;
    }
    $id_classe = intval($id_classe);
    if(empty(getCodeClasse($id_classe))){
        header("Location: $index?page=moyenneBulletin&error=invalidClass#m2");
        exit;
    }
    else{
        header("Location: $index?page=moyenneBulletin&id_classe=$id_classe#m2");
        exit;
    }
}
?>