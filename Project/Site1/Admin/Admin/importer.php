

<?php
 require_once 'fonction.php';
if(isset($_POST['importSubmit'])){
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                        fgetcsv($csvFile);
                        while(($line = fgetcsv($csvFile)) !== FALSE){
                                $CA  = $line[0];
                                $admin_mail = $line[1];
                                addadmin($admin_mail, $CA);
                                }
                        fclose($csvFile);
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}
header("Location: liste_admin.php".$qstring."#about");