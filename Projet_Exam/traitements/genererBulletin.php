<?php
require_once __DIR__ . '/../publics/fpdf/fpdf.php';
require_once "requetes.php";

if (isset($_POST['matricule_etudiant'])) {
    if (empty(trim($_POST['matricule_etudiant']))) {
        die("Le champ matricule est vide.");
    }

$matricule = $_POST['matricule_etudiant'];

/*RECUPERER INFOS ETUDIANT */


$id_etudiant = getIdEtud($matricule);

$etudiant = getEtudClasseNiveau($id_etudiant);

if (!$etudiant) {
    die("Étudiant introuvable.");
}

/* RECUPERER NOTES  */
$code_evalu = getCodeEvalu($matricule);

$notes = getNoteEtudiant($id_etudiant);

/*CALCUL MOYENNE */


$moyenne = getMoyenneEtudiant($id_etudiant);
$moyenne = number_format($moyenne, 2);

/* GENERATION PDF */

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

/* Titre */
$pdf->Cell(0,10,'BULLETIN DE NOTES',0,1,'C');
$pdf->Ln(5);

/* Infos étudiant */
$pdf->SetFont('Arial','',12);
$pdf->Cell(100,8,'Matricule : '.$matricule,0,1);
$pdf->Cell(100,8,'Nom : '.$etudiant['NomEtud'].' '.$etudiant['PrenomEtud'],0,1);
$pdf->Cell(100,8,'Classe : '.$etudiant['nomClasse'],0,1);
$pdf->Ln(10);

/* Tableau des notes */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(60,8,'Module',1);
$pdf->Cell(40,8,'Type',1);
$pdf->Cell(30,8,'Note',1);
$pdf->Ln();

$pdf->SetFont('Arial','',12);

foreach ($notes as $note) {
    $pdf->Cell(60,8,$note['Nom_modu'],1);
    $pdf->Cell(40,8,$note['type_evalu'],1);
    $pdf->Cell(30,8,$note['note_etud'],1);
    $pdf->Ln();
}

$pdf->Ln(10);

/* Moyenne */
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'Moyenne Generale : '.$moyenne,0,1);

/* Decision */
$pdf->SetFont('Arial','B',12);

if ($moyenne >= 10) {
    $decision = "ADMIS";
} elseif ($moyenne >= 5) {
    $decision = "AJOURNE";
} else {
    $decision = "EXCLU";
}

$pdf->Cell(0,10,'Decision : '.$decision,0,1);

/* Sortie PDF */
$pdf->Output("I", "Bulletin_".$matricule.".pdf");
}
?>