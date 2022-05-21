<?php
 require_once 'fonction.php';
 $con = new mysqli('localhost', 'root', '', 'formation');
 $query = $con->query("SELECT * FROM administrateurs ");
if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "members_" . date('Y-m-d') . ".csv";
    $f = fopen('php://memory', 'w');
    $fields = array('CA', 'nom', 'prenom', 'mail', );
    fputcsv($f, $fields, $delimiter);

    while($row = $query->fetch_assoc()){
        $lineData = array($row['administrateur_CA'], $row['administrateur_nom'], $row['administrateur_prenom'], $row['administrateur_mail']);
        fputcsv($f, $lineData, $delimiter);
    }
    fseek($f, 0);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    fpassthru($f);
}
exit;

?>