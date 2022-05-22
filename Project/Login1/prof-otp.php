<?php require_once "controllerUserData-prof.php"; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login-prof.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code de verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="prof-otp.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Code de verification</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="number" name="otp" placeholder="Entrer le code de vérification" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check" value="Envoyer">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>