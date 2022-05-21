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

function deletefilière($ID)
    {
      $sql = "DELETE FROM filière WHERE filière_id = $ID ";
      return executeSQL($sql);
     }

function addfilière($id, $filière)
   {
	$sql = "INSERT INTO filière(filière_id,filière_libellé) VALUES ('$id','$filière')";
	return executeSQL($sql);
}
function updatefilière($NF,$nom)
   {
   	$sql ="UPDATE filière SET filière_id = '$NF' , filière_libellé = '$nom' WHERE filière_id = '$NF'";
	return executeSQL($sql);
  }