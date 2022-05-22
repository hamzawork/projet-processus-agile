<?php
    require_once 'fonction.php';
    ?>

<?php
if(isset($_POST["submit"])){

$targetDir = "cours/";

$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
	$matière_id = $_POST['matière'] ;
			    $cours = $_POST['cours'];
			    $file = $_FILES['file']['name'];
			    $type = $_FILES['file']['type'];
			    $CheminFichier = "cours/$file";
			    $CheminCible = "cours/$matière_id-$cours.pdf";
		    rename($CheminFichier, $CheminCible);
    $allowTypes = array('pdf');
    if(in_array($fileType, $allowTypes)){
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            $file2 = "../../Professeur/up_cours/".$CheminCible."" ;
            addcours_up($cours ,$file2, $matière_id);
            header('location: up_cours.php?ID='.$matière_id.'#projects');
            $statusMsg = "The file ".$fileName. " has been uploaded.";
             rename($CheminFichier, $CheminCible);

        }
    }
}
}

?>

<?php
    if(isset($_GET['IDc']))
    {

      $matière_id=$_GET['IDm'];
      $fichier = $_GET['ch'];
      deletecours_up($_GET['IDc']);
      if( file_exists ( $fichier)){
       unlink( $fichier ) ;
        }
      header('location: up_cours.php?ID='.$matière_id.'#projects');
    }

    ?>