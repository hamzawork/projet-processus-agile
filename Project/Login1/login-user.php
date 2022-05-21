<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authentification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="login-user.php" method="POST" autocomplete="">
                    <h2 class="text-center"> <img  src="image/etude.png" alt="form"> Etudiant</h2>
                       
                   
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
                        <input class="form-control" type="email" name="email" placeholder="email um5" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
                    </div>
                    <div class="link forget-pass text-left"><a href="forgot-password.php">Mot de passe oublié?</a></div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Se connecter">
                    </div>
                    <div class="link login-link text-center"> <a href="signup-user.php">S'inscrire</a></div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>