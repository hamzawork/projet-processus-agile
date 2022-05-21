<?php 
session_start();
require "connection.php";
$email = "";
$CP= "";
$name = "";
$prenom = "";
$errors = array();

//if user signup button
if(isset($_POST['signup'])){
    $CP = mysqli_real_escape_string($con, $_POST['CP']);
    $prenom = mysqli_real_escape_string($con, $_POST['prenom']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password !== $cpassword){
        $errors['password'] = "Mot de passe incorrect" ; 
    }
    $email_check = "SELECT * FROM professeurs WHERE professeur_mail = '$email' AND professeur_statut = 'verified'  ";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
         
            $errors['email'] = "le mail que vous avez entrer est dèja inscrit!";
    }
    $email_check = "SELECT * FROM professeurs WHERE professeur_mail = '$email' AND professeur_statut = 'notverified'  ";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){

        if(count($errors) === 0){
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $code = rand(999999, 111111);
            $status = "notverified";
            $insert_data = "UPDATE professeurs SET professeur_password = '$encpass' , professeur_code ='$code',professeur_CP='$CP',professeur_nom='$name',professeur_prenom='$prenom'   WHERE professeur_mail = '$email' ";
            $data_check = mysqli_query($con, $insert_data);
            if($data_check){
                $subject = "Email Verification Code";
                $message = "Your verification code is $code";
                $sender = "From: daassdibouzz@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "on a envoyer un mot de passe de vérification à - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    header('location: prof-otp.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Erreur d'envoyer le code";
                }
            }else{
                $errors['db-error'] = "Erreur d'envoyer à la bdd";
            }
        }
    }

}
    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM professeurs WHERE professeur_code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['professeur_code'];
            $email = $fetch_data['professeur_mail'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE professeurs SET professeur_code = $code, professeur_statut = '$status' WHERE professeur_code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: ..\Site1\Professeur\Acceuil\P_home.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "vous avez entrer un code erroné";
        }
    }

    //if user click login button
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_email = "SELECT * FROM professeurs WHERE professeur_mail = '$email'";
        $res = mysqli_query($con, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['professeur_password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                $status = $fetch['professeur_statut'];
                if($status == 'verified'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                    header('location: ..\Site1\Professeur\Acceuil\P_home.php');
                }else{
                    $info = "vous devez vérifier votre mail- $email";
                    $_SESSION['info'] = $info;
                    header('location: prof-otp.php');
                }
            }else{
                $errors['email'] = "mail ou mot de passe incorrect!!!";
            }
        }else{
            $errors['email'] = "ce mail n'existe pas ";
        }
    }

    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM professeurs WHERE professeur_mail='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE professeurs SET professeur_code = $code WHERE professeur_mail = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Récupération du mot de passe";
                $message = "Votre mot de passe est : $code";
                $sender = "From: daassdibouzz@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "on a envoyer un mot de passe de vérification à - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code-prof.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "Cette adresse n'existe pas";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM professeurs WHERE professeur_code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['professeur_mail'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password-prof.php');
            exit();
        }else{
            $errors['otp-error'] = "vous avez entrer un code erroné";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Mot de passe insuffisant";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE professeurs SET professeur_code = $code, professeur_password = '$encpass' WHERE professeur_mail = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "votre mot de passe est récupérer . vous pouvez vous connecter maintenant";
                $_SESSION['info'] = $info;
                header('Location: password-changed-prof.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login-prof.php');
    }
?>