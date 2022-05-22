<?php
function getconnection()
{
	$con = mysqli_connect('localhost', 'root', '', 'formation');
	return $con;
}


function executeSQL($sql)
{
	$exec = mysqli_query(getconnection(), $sql);
	return $exec;
}

function deleteetudiant($ID)
    {
      $sql = "DELETE FROM etudiants WHERE etudiant_id = $ID ";
      return executeSQL($sql);
     }

function addetudiant($email,$groupe)
   {
	$sql = "INSERT INTO etudiants(etudiant_mail,etudiant_statut,groupe_id) VALUES ('$email','notverified','$groupe')";
	return executeSQL($sql);
}
function updateetudiant($CNE, $nom, $prenom ,$email2, $groupe2)
   {
   	$sql ="UPDATE etudiants SET etudiant_CNE = '$CNE' , etudiant_nom = '$nom' , etudiant_prenom = '$prenom' , etudiant_mail = '$email2', groupe_id = '$groupe2' WHERE etudiant_mail = '$email2'";
	return executeSQL($sql);
  }
?>

