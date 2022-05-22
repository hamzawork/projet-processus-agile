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
 function deletecours_up($ID)
    {
      $sql = "DELETE FROM cours WHERE cours_id = $ID ";
      return executeSQL($sql);
     }

function addcours_up($cours_up,$file2,$matière_id)
   {
  $sql = "INSERT INTO cours(cours_libellé,cours_chemin,matière_id) VALUES ('$cours_up','$file2','$matière_id')";
  return executeSQL($sql);
}

?>

