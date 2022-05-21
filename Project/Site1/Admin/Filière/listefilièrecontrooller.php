<?php
    require_once 'fonction.php';
    
    if(isset($_GET['ID']))
    {
      deletefilière($_GET['ID']);
      header('location: filière.php?#about');
    }
    if(isset($_POST['ajout']))
    {
      $id = $_POST['id'];
     	$filière = $_POST['filière'];
    	addfilière($id ,$filière);
    	header('location: filière.php?#about');
    }
   if(isset($_POST['modifier']))
    {
      $NF = $_POST['NF'];
      $nom = $_POST['nom'];
     updatefilière($NF ,$nom);
      header('location: filière.php?#about');
    }
    ?>