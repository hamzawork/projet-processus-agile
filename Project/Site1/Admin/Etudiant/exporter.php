<?php
 require_once 'fonction.php';
 $con = new mysqli('localhost', 'root', '', 'formation');
 $N = $_GET['A'];
 $query = $con->query("SELECT * FROM etudiants INNER JOIN groupe ON groupe.groupe_id = etudiants.groupe_id INNER JOIN filière ON filière.filière_id = groupe.filière_id WHERE etudiants.groupe_id > '$N' AND etudiants.groupe_id < '$N'+10 ");
if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "etudaint" . date('Y-m-d') . ".csv";

    $f = fopen('php://memory', 'w');
    $fields = array('CNE', 'nom', 'prenom', 'mail', 'niveau' , 'groupe', 'filiere' );
    fputcsv($f, $fields, $delimiter);

    while($row = $query->fetch_assoc()){
        $lineData = array($row['etudiant_CNE'], $row['etudiant_nom'], $row['etudiant_prenom'], $row['etudiant_mail'], $row['niveau_id'] , $row['groupe_libellé'] , $row['filière_libellé'] );
        fputcsv($f, $lineData, $delimiter);
    }
    fseek($f, 0);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    fpassthru($f);
}
exit;

?>