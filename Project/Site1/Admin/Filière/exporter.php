<?php
 require_once 'fonction.php';
 $con = new mysqli('localhost', 'root', '', 'formation');
 $query = $con->query("SELECT * FROM filière ");
if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "members_" . date('Y-m-d') . ".csv";

    $f = fopen('php://memory', 'w');
    $fields = array('Numero', 'filiere' );
    fputcsv($f, $fields, $delimiter);

    while($row = $query->fetch_assoc()){
        $lineData = array($row['filière_id'], $row['filière_libellé']);
        fputcsv($f, $lineData, $delimiter);
    }
    fseek($f, 0);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    fpassthru($f);
}
exit;

?>