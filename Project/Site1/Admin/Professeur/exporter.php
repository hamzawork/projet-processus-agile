<?php
 require_once 'fonction.php';
 $con = new mysqli('localhost', 'root', '', 'formation');
 $query = $con->query("SELECT * FROM professeurs ");
if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "members_" . date('Y-m-d') . ".csv";
    $f = fopen('php://memory', 'w');
    $fields = array('CP', 'nom', 'prenom', 'mail');
    fputcsv($f, $fields, $delimiter);
    while($row = $query->fetch_assoc()){
        $lineData = array($row['professeur_cp'], $row['professeur_nom'], $row['professeur_prenom'], $row['professeur_mail']);
        fputcsv($f, $lineData, $delimiter);
    }
    fseek($f, 0);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    fpassthru($f);
}
exit;

?>