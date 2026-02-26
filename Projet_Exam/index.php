<?php
$dossierpublic = "http://localhost/php%20project/Projet_Exam/publics";
$action = "http://localhost/php%20project/Projet_Exam/traitements/actions.php";

include_once "includes/header.php";
include_once "includes/navbar.php";
include_once "includes/sidebar.php";
require_once "traitements/requetes.php";
require_once "traitements/actions.php";
require_once "traitements/genererBulletin.php";


$niveaux = getNiveau();

$classes = getClasse();

$etudiantsNiveau = isset($_GET['id_classe']) ? getEtudClasse($_GET['id_classe']) : [];
$etudiants = getAllEtud();
$etudSupMoyClass = EtudSupMoyClasse($classes,$etudiants);

$modules = getModu();

$bestEtudClasse = isset($_GET['idBestEtudClass']) ? MeilleurEtudClasse($_GET['idBestEtudClass']) : null;
$bestEtudNiveau = isset($_GET['idBestEtudNiveau']) ? MeilleurEtudNiveau($_GET['idBestEtudNiveau']) : null;


$page = isset($_GET['page']) ? $_GET['page'] : "acceuil";
if (file_exists("pages/$page.php")){
    include_once "pages/$page.php";
}
else{
    include_once 'pages/error404.php';
}

include_once "includes/footer.php";
?>