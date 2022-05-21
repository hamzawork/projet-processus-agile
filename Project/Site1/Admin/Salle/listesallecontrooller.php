<?php
    require_once 'fonction.php';
    
    if(isset($_GET['ID']))
    {
      deletesalle($_GET['ID']);
      header('location: salle.php?#about');
    }
    if(isset($_POST['ajout']))
    {
      $id = $_POST['id'];
     	$salle = $_POST['salle'];
    	addsalle($id ,$salle);
    	header('location: salle.php?#about');
    }
   if(isset($_POST['modifier']))
    {
      $NS = $_POST['NS'];
      $nom = $_POST['nom'];
     updatesalle($NS ,$nom);
      header('location: salle.php?#about');
    }

    ?>