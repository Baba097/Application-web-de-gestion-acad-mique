<?php
include_once "db.php";

//NIVEAU
function addNiveau($nom_niveau,$code_niveau){
    global $pdo;
    $req = "INSERT INTO niveau(code_niveau,nomNiveau) VALUES (?,?)";
    $exe = $pdo->prepare($req);
    return $exe->execute([$code_niveau,$nom_niveau]);
}

function getNiveau(){
    global $pdo;
    $req = "SELECT* FROM niveau ORDER BY id_niveau";
    return $pdo->query($req)->fetchAll();
}

function getNiveauModif($id_niveau){
    global $pdo;
    $req = "SELECT* FROM niveau WHERE id_niveau = $id_niveau";    
    return $pdo->query($req)->fetch();
}

function modifNiveau($id_niveau,$nom_niveau,$code_niveau){
    global $pdo;
    $req = "UPDATE niveau SET code_niveau = ? , nomNiveau =  ? WHERE id_niveau = ?";
    $exe = $pdo->prepare($req);
    return $exe->execute([$nom_niveau,$code_niveau,$id_niveau]);
}

function getCodeNiveau($id_niveau){
    global $pdo;
    $req = "SELECT code_niveau FROM niveau WHERE id_niveau = ?";
    $exe = $pdo->prepare($req);
    $exe->execute([$id_niveau]);
    return $exe->fetchColumn();
}

function getIdNivClass($id_classe){
    global $pdo;
    $req = "SELECT id_niveau FROM classes WHERE id_classe = ?";
    $exe = $pdo->prepare($req);
    $exe->execute([$id_classe]);
    return $exe->fetchColumn();
}
//CLASSE
function addClasse($nom,$code,$id_niveau){
    global $pdo;
    $req = "INSERT INTO classes(nomClasse,codeClasse,id_niveau) VALUES (?,?,?)";
    $exe = $pdo->prepare($req);
    return $exe->execute([$nom,$code,$id_niveau]);
}

function getClasse(){
    global $pdo;
    $req = "SELECT* FROM classes ORDER BY codeClasse";
    return $pdo->query($req)->fetchAll();
}

function getClasseModif($id){
    global $pdo;
    $req = "SELECT* FROM classes WHERE id_classe = $id";
    return $pdo->query($req)->fetch();
}
function modifClasse($nom,$code,$id_niveau){
    global $pdo;
    $req = "UPDATE classes SET nomClasse = ?, codeClasse = ? , id_niveau =  ? WHERE id_niveau = ?";
    $exe = $pdo->prepare($req);
    return $exe->execute([$nom,$code,$id_niveau]);
}

function getClasseLevel($id_niveau){
    global $pdo;
    $req = "SELECT* FROM classes WHERE id_niveau = $id_niveau ORDER BY codeClasse";
    $exe = $pdo->prepare($req);
    $exe->execute();
    return $exe->fetchAll();
}

function getCodeClasse($id_classe){
    global $pdo;
    $req = "SELECT codeClasse FROM classes WHERE id_classe = ?";
    $exe = $pdo->prepare($req);
    $exe->execute([$id_classe]);
    return $exe->fetchColumn();
}




//ETUDIANT
function inscrireEtud($nom,$prenom,$matricule,$dateNaiss,$id_classe,$anacad){
    global $pdo;
    $req = "INSERT INTO etudiants(NomEtud,PrenomEtud,matricule,datenaiss,id_classe,anacad)
            VALUES (?,?,?,?,?,?)";
    $exe = $pdo->prepare($req);
    return $exe->execute([$nom,$prenom,$matricule,$dateNaiss,$id_classe,$anacad]);        
}

function getEtudClasse($id_classe){
    global $pdo;
    $req = "SELECT* FROM etudiants WHERE id_classe = $id_classe ORDER BY NomEtud";
    return $pdo->query($req)->fetchAll();
}


function getIdEtud($matricule){
    global $pdo;
    $req = "SELECT id_etudiant FROM etudiants WHERE matricule = ?";
    $exe = $pdo->prepare($req);
    $exe->execute([$matricule]);
    return $exe->fetchColumn();
}

function getAllEtud(){
    global $pdo;
    $req = "SELECT* FROM etudiants ORDER BY NomEtud";
    return $pdo->query($req)->fetchAll();
}

function getEtudNiveau($id_niveau){
    global $pdo;
    $req = "SELECT* FROM etudiants e JOIN classes c ON e.id_classe = c.id_classe WHERE c.id_niveau = $id_niveau ORDER BY NomEtud";
    return $pdo->query($req)->fetchAll();
}

function getEtudClasseNiveau($id_etudiant){
    global $pdo;
    $req = " SELECT e.NomEtud, e.PrenomEtud, c.nomClasse
    FROM etudiants e
    JOIN classes c ON e.id_classe = c.id_classe
    WHERE e.id_etudiant =  ?";
    $exe = $pdo->prepare($req);
    $exe->execute([$id_etudiant]);
    return $exe->fetch(PDO::FETCH_ASSOC);
}

function getIdEtudEvalu($code_evalu){
    global $pdo;
    $req = "SELECT id_etudiant FROM evaluations WHERE code_evalu = ?";
    $exe = $pdo->prepare($req);
    $exe->execute([$code_evalu]);
    return $exe->fetchColumn();
}

//MODULE
function addModu($nomModu,$codeModu){
    global $pdo;
    $req = "INSERT INTO modules(code_modu,Nom_modu) VALUES (?,?)";
    $exe = $pdo->prepare($req);
    return $exe->execute([$codeModu,$nomModu]);
}

function getModu(){
    global $pdo;
    $req = "SELECT* FROM modules ORDER BY code_modu";
    return $pdo->query($req)->fetchAll();
}

function addModuClasse($id_module,$id_classe){
    global $pdo;
    $req = "INSERT INTO classe_module(id_module,id_classe) VALUES (?,?)";
    $exe = $pdo->prepare($req);
    return $exe->execute([$id_module,$id_classe]);
}

function getIdModu($code_module){
    global $pdo;
    $req = "SELECT id_module FROM modules WHERE code_modu = ?";
    $exe = $pdo->prepare($req);
    $exe->execute([$code_module]);
    return $exe->fetchColumn();
}

//EVALUATION
function enrgEval($id_evalu,$note){
    global $pdo;
    $req = "INSERT INTO note(id_evalu,note_etud) VALUES (?,?)";
    $exe = $pdo->prepare($req);
    return $exe->execute([$id_evalu,$note]);
}

function modifEval($id_evalu,$note){
    global $pdo;
    $req = "UPDATE note SET note_etud = ? WHERE id_evalu = ?";
    $exe = $pdo->prepare($req);
    return $exe->execute([$note,$id_evalu]);
}

function suppEval($id_evalu){
    global $pdo;
    $req = "DELETE FROM note WHERE id_evalu= ?";
    $exe = $pdo->prepare($req);
    return $exe->execute([$id_evalu]);
}

function addEval($code_evalu,$id_etudiant,$id_module,$type_evalu,$dateEvalu){
    global $pdo;
    $req = "INSERT INTO evaluations(code_evalu,id_etudiant,id_module,type_evalu,dateEvalu) VALUES (?,?,?,?,?)";
    $exe = $pdo->prepare($req);
    return $exe->execute([$code_evalu,$id_etudiant,$id_module,$type_evalu,$dateEvalu]);
}

function getIdEvalu($code_evalu){
    global $pdo;
    $req = "SELECT id_evalu FROM evaluations WHERE code_evalu = ?";
    $exe = $pdo->prepare($req);
    $exe->execute([$code_evalu]);
    return $exe->fetchColumn();
}
function getCodeEvalu($matricule){
    global $pdo;
    $req = "SELECT code_evalu 
            FROM evaluations ev
            JOIN etudiants e ON ev.id_etudiant = e.id_etudiant
            WHERE e.matricule = ?";
    $exe = $pdo->prepare($req);
    $exe->execute([$matricule]);
    return $exe->fetchColumn();
}

//MATRICULE
function LastMatricule(){
    global $pdo;
    $req = "SELECT matricule FROM etudiants Order by id_etudiant DESC LIMIT 1";
    return $pdo->query($req)->fetch();
}   

function recupMatricule($id_etudiant){
    global $pdo;
    $req = "SELECT matricule FROM etudiants WHERE id_etudiant = ?";
    $exe = $pdo->prepare($req);
    $exe->execute([$id_etudiant]);
    return $exe->fetchColumn();
}
//JOINTURE EVALUATION
function getMatriuleIdModu($code_evalu){
    global $pdo;
    $req = $pdo->prepare("
        SELECT 
            e.code_evalu,
            et.matricule,
            m.code_modu
        FROM evaluations e
        JOIN etudiants et ON e.id_etudiant = et.id_etudiant
        JOIN modules m ON e.id_module = m.id_module
        WHERE e.code_evalu = ?
    ");

    $req->execute([$code_evalu]);

    return $req->fetch(PDO::FETCH_ASSOC);
}
//MOYENNE
function getMoyenneEtudiant($id_etudiant){
    global $pdo;
    $req = $pdo->prepare("
        SELECT AVG(n.note_etud) as moyenne
        FROM note n
        JOIN evaluations e ON n.id_evalu = e.id_evalu
        WHERE e.id_etudiant = ? AND type_evalu != 'TP'
    ");
    $req->execute([$id_etudiant]);
    return $req->fetchColumn();
}

function getMoyenneClasse($id_classe){
    global $pdo;
    $req = $pdo->prepare("
        SELECT AVG(n.note_etud) as moyenne
        FROM note n
        JOIN evaluations e ON n.id_evalu = e.id_evalu
        JOIN etudiants et ON e.id_etudiant = et.id_etudiant
        WHERE et.id_classe = ? AND e.type_evalu != 'TP'
    ");
    $req->execute([$id_classe]);
    return $req->fetchColumn();
}

//MEILLEUR ETUDIANT
function MeilleurEtudClasse($id_classe){
    global $pdo;
    $req = $pdo->prepare("
        SELECT et.NomEtud, et.PrenomEtud, AVG(n.note_etud) as moyenne
        FROM etudiants et
        JOIN evaluations e ON et.id_etudiant = e.id_etudiant
        JOIN note n ON e.id_evalu = n.id_evalu
        WHERE et.id_classe = ? AND e.type_evalu != 'TP'
        GROUP BY et.id_etudiant
        ORDER BY moyenne DESC
        LIMIT 1
    ");
    $req->execute([$id_classe]);
    return $req->fetch(PDO::FETCH_ASSOC);
}

function MeilleurEtudNiveau($id_niveau){
    global $pdo;
    $req = $pdo->prepare("
        SELECT et.NomEtud, et.PrenomEtud,c.nomClasse, AVG(n.note_etud) as moyenne
        FROM etudiants et
        JOIN evaluations e ON et.id_etudiant = e.id_etudiant
        JOIN note n ON e.id_evalu = n.id_evalu
        JOIN classes c ON et.id_classe = c.id_classe
        WHERE c.id_niveau = ? AND e.type_evalu != 'TP'
        GROUP BY et.id_etudiant
        ORDER BY moyenne DESC
        LIMIT 1
    ");
    $req->execute([$id_niveau]);
    return $req->fetch(PDO::FETCH_ASSOC);
}

//STATUT ETUDIANT
function nbrEtudAdmis(){
    global $pdo;
    $req = $pdo->prepare("
    SELECT COUNT(*) AS nb_admis
    FROM (
    SELECT et.id_etudiant
    FROM etudiants et
    JOIN evaluations e ON et.id_etudiant = e.id_etudiant
    JOIN note n ON e.id_evalu = n.id_evalu
    WHERE e.type_evalu != 'TP'
    GROUP BY et.id_etudiant
    HAVING AVG(n.note_etud) >= 10
    ) AS admis;

    ");
    $req->execute();
    return $req->fetchColumn();
}

function nbrEtudAjourne(){
    global $pdo;
    $req = $pdo->prepare("
    SELECT COUNT(*) AS nb_ajournes
    FROM (
    SELECT et.id_etudiant
    FROM etudiants et
    JOIN evaluations e ON et.id_etudiant = e.id_etudiant
    JOIN note n ON e.id_evalu = n.id_evalu
    WHERE e.type_evalu IN ('Devoir','Examen')
    GROUP BY et.id_etudiant
    HAVING AVG(n.note_etud) >= 5 
       AND AVG(n.note_etud) < 10
    ) AS ajournes;
    ");
    $req->execute();
    return $req->fetchColumn();
}

function nbrEtudExclut(){
    global $pdo;
    $req = $pdo->prepare("
    SELECT COUNT(*) AS nb_exclus
    FROM (
    SELECT et.id_etudiant
    FROM etudiants et
    JOIN evaluations e ON et.id_etudiant = e.id_etudiant
    JOIN note n ON e.id_evalu = n.id_evalu
    WHERE e.type_evalu IN ('Devoir','Examen')
    GROUP BY et.id_etudiant
    HAVING AVG(n.note_etud) < 5
    ) AS exclus;
    ");
    $req->execute();
    return $req->fetchColumn();
}
//NOTE
function getNoteEtudiant($id_etudiant){
    global $pdo;
    $req = $pdo->prepare("
	SELECT m.Nom_modu, ev.type_evalu, n.note_etud
    FROM evaluations ev
    JOIN modules m ON ev.id_module = m.id_module
    JOIN note n ON ev.id_evalu = n.id_evalu
    WHERE ev.id_etudiant = ?
    AND ev.type_evalu IN ('Devoir','Examen')
    ORDER BY m.Nom_modu
    ");
    $req->execute([$id_etudiant]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
}
?>