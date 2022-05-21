<?php
    require_once 'fonction.php';
    
    if(isset($_GET['ID']))
    {
      deleteetudiant($_GET['ID']);
      $A = $_GET['A'];
      header('location: liste_etudiant.php?A='.$A.'#about');
    }
    if(isset($_POST['ajout']))
    {

     	$email = $_POST['email'];
    	$groupe = $_POST['groupe'] ;
      $A = $_POST['niveau']*10;
    	addetudiant($email, $groupe);
    	header('location:liste_etudiant.php?A='.$A.'#about');
    }
    if(isset($_POST['modifier']))
    {
      $CNE = $_POST['CNE2'];
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom']; 
    	$email2 = $_POST['email2'];
    	$groupe2 = $_POST['groupe'] ;
      $A = $_POST['annee2']*10;

      updateetudiant($CNE, $nom, $prenom ,$email2, $groupe2);
      header('location: liste_etudiant.php?A='.$A.'#about');
    }

    ?>