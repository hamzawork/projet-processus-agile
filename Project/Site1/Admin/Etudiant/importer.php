

<?php
 require_once 'fonction.php';
if(isset($_POST['importSubmit'])){
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvFile);
            while(($line = fgetcsv($csvFile)) !== FALSE){
                $email = $line[0];
                $groupe = $line[2]; ;
                $A = $line[1]*10;
                addetudiant($email, $groupe);
                }
            fclose($csvFile);
            
            $qstring = '?A='.$A.'&status=succ#about';
        }else{
            $qstring = '?A='.$A.'&status=err';
        }
    }else{
        $qstring = '?A='.$A.'&status=invalid_file';
    }
}

header("Location: liste_etudiant.php".$qstring);