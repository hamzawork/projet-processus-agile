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

function deletesalle($ID)
    {
      $sql = "DELETE FROM salle WHERE salle_numero = $ID ";
      return executeSQL($sql);
     }

function addsalle($id, $salle)
   {
	$sql = "INSERT INTO salle(salle_numero,salle_libellé) VALUES ('$id','$salle')";
	return executeSQL($sql);
}
function updatesalle($NS,$nom)
   {
   	$sql ="UPDATE salle SET salle_numero = '$NS' , salle_libellé = '$nom' WHERE salle_numero = '$NS'";
	return executeSQL($sql);
  }