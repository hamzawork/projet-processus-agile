<?php
    require_once 'fonction.php';
    
    if(isset($_GET['ID']))
    {
      deleteadmin($_GET['ID']);
      header('location: liste_admin.php?#about');
    }
    if(isset($_POST['ajout']))
    {

     	$email = $_POST['email'];
    	$CA = $_POST['CA'];
      
    	addadmin($email, $CA);
    	header('location: liste_admin.php?#about');
    }
    if(isset($_POST['modifier']))
    {
      $CA2 = $_POST['CA2'];
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
    	$email2 = $_POST['email2'];
     updateadmin($CA2 ,$nom, $prenom, $email2);
      header('location: liste_admin.php?#about');
    }

    

    ?>