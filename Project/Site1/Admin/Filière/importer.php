
<?php
 require_once 'fonction.php';
if(isset($_POST['importSubmit'])){
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                        while(($line = fgetcsv($csvFile)) !== FALSE){
                                $id  = $line[0];
                                $filière = $line[1];
                                addfilière($id , $filière);
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
header("Location: salle.php".$qstring."#about");