<?php
    require_once 'fonction.php';
    
    if(isset($_GET['cp']))
    {
      deleteprof($_GET['cp']);
      header('location: liste_prof.php?#about');
    }
    if(isset($_POST['ajout']))
    {

     	$email = $_POST['email'];
    	$CP = $_POST['CP'];
    	addprof($email, $CP);
    	header('location: liste_prof.php?#about');
    }
    if(isset($_POST['modifier']))
    {
    	$CP2 = $_POST['CP2'];
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $email2 = $_POST['email2'];
     updateprof($CP2 ,$nom, $prenom, $email2);
      header('location: liste_prof.php?#about');
    }

    ?>