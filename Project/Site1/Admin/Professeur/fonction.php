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

function deleteprof($cp)
    {
      $sql = "DELETE FROM professeurs WHERE professeur_cp = $cp ";
      return executeSQL($sql);
     }

function addprof($email,$CP)
   {
	$sql = "INSERT INTO professeurs(professeur_cp, professeur_mail,professeur_statut) VALUES ('$CP','$email','notverified')";
	return executeSQL($sql);
}
function updateprof($CP2 ,$nom, $prenom, $email2)
   {
   $sql ="UPDATE professeurs SET professeur_cp = '$CP2' , professeur_nom = '$nom' , professeur_prenom = '$prenom' , professeur_mail = '$email2'  WHERE professeur_mail = '$email2'";
  return executeSQL($sql);
  }
?>

