<?php require_once "controllerUserData-admin.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>S'inscrire</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="signup-admin.php" method="POST" autocomplete="">
                    <h2 class="text-center">Inscription</h2>
                    <p class="text-center"></p>
                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="text" name="CA" placeholder="Code Administrateur (CA)" required value="<?php echo $CA ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Nom" required value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="prenom" placeholder="Prenom" required value="<?php echo $prenom ?>">
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email um5" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Mot de passe" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signup" value="S'inscrire">
                    </div>
                    <div class="link login-link text-center">vous etes d??ja inscrit? <a href="login-admin.php">Se connecter</a></div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>