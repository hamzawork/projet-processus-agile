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

function deleteadmin($ID)
    {
      $sql = "DELETE FROM administrateurs WHERE administrateur_id = $ID ";
      return executeSQL($sql);
     }

function addadmin($email,$CA)
   {
	$sql = "INSERT INTO administrateurs(administrateur_mail,administrateur_statut,administrateur_CA) VALUES ('$email','notverified','$CA')";
	return executeSQL($sql);
}
function updateadmin($CA2 ,$nom, $prenom, $email2)
   {
   	$sql ="UPDATE administrateurs SET administrateur_CA = '$CA2' , administrateur_nom = '$nom' , administrateur_prenom = '$prenom' , administrateur_mail = '$email2'  WHERE administrateur_mail = '$email2'";
	return executeSQL($sql);
  }


?>

