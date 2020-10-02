<?php 
     require "main.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
        <link rel="stylesheet" href="style.css">


        <title>LOGIN</title>
        <style>
            body:not(.frm) { 
    background: url(bg5.jpg) no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    }
        </style>
    </head>
    <body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div login">
                <form action="login.php" class="frm" method="post">
                <h3 class="text-center">S'identifier</h3>

                <?php if (count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo $error ?></li>
                            <?php endforeach ; ?>
                        </div>
                    <?php endif; ?>

                <div class="form-group">
                <label for="username">NOM ou Email</label> 
                <input type="text" autofocus name="username" value="<?php echo $username; ?>" id="" class="form-control form-control-lg">
                </div>

                

                <div class="form-group">
                <label for="password">Mot de passe</label> 
                <input type="password" name="password" id="" class="form-control form-control-lg">
                </div>


                <div class="form-group">
                <button type="submit" name="login-btn" class="btn btn-primary btn-block btn-lg">S'identifier</button>
                </div>
                <p class="text-center">Des problemes?<a href="mailto:dzekroos@gmail.com">Contactez-nous</a></p>
                
                <p class="text-center"> Non Inscrit <a href="../INSC/index.php">S'inscrire</a></p>
                <p class="text-center"><a href="forgot_password.php">Mot de pass oublié? </a></p>


                
                
                </form>
            
            </div>
        </div>
    </div>

        
    </body>
</html>