<?php 
session_start();
require "connection.php";
$email = "";
$CA= "";
$name = "";
$prenom = "";
$errors = array();

//if user signup button
if(isset($_POST['signup'])){
    $CA = mysqli_real_escape_string($con, $_POST['CA']);
    $prenom = mysqli_real_escape_string($con, $_POST['prenom']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password !== $cpassword){
        $errors['password'] = "Mot de passe incorrect" ; 
    }
    $email_check = "SELECT * FROM administrateurs WHERE administrateur_mail = '$email' AND administrateur_statut = 'verified'  ";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
         
            $errors['email'] = "le mail que vous avez entrer est dèja inscrit!";
    }
    $email_check = "SELECT * FROM administrateurs WHERE administrateur_mail = '$email' AND administrateur_statut = 'notverified'  ";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){

        if(count($errors) === 0){
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $code = rand(999999, 111111);
            $status = "notverified";
            $insert_data = "UPDATE administrateurs SET administrateur_password = '$encpass' , administrateur_code ='$code',administrateur_CA='$CA',administrateur_nom='$name',administrateur_prenom='$prenom'   WHERE administrateur_mail = '$email' ";
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
                    header('location: admin-otp.php');
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
   
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM administrateurs WHERE administrateur_code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['administrateur_code'];
            $email = $fetch_data['administrateur_mail'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE administrateurs SET administrateur_code = $code, administrateur_statut = '$status' WHERE administrateur_code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: ..\Site1\Admin\Acceuil\A_home.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "vous avez entrer un code erroné";
        }
    }

  
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_email = "SELECT * FROM administrateurs WHERE administrateur_mail = '$email'";
        $res = mysqli_query($con, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['administrateur_password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                $status = $fetch['administrateur_statut'];
                if($status == 'verified'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                    header('location: ..\Site1\Admin\Acceuil\A_home.php');
                }else{
                    $info = "vous devez vérifier votre mail- $email";
                    $_SESSION['info'] = $info;
                    header('location: admin-otp.php');
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
        $check_email = "SELECT * FROM administrateurs WHERE administrateur_mail='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE administrateurs SET administrateur_code = $code WHERE administrateur_mail = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Récupération du mot de passe";
                $message = "Votre mot de passe est : $code";
                $sender = "From: daassdibouzz@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "on a envoyer un mot de passe de vérification à - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code-admin.php');
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
        $check_code = "SELECT * FROM administrateurs WHERE administrateur_code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['administrateur_mail'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password-admin.php');
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
            $update_pass = "UPDATE administrateurs SET administrateur_code = $code, administrateur_password = '$encpass' WHERE administrateur_mail = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "votre mot de passe est récupérer . vous pouvez vous connecter maintenant";
                $_SESSION['info'] = $info;
                header('Location: password-changed-admin.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login-admin.php');
    }
?>