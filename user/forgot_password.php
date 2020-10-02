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


        <title>PASSWORD FORGOTTEN</title>
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
                <form action="forgot_password.php" class="frm" method="post">
                <h3 class="text-center">Récupérer Le Mot de passe</h3>
                <p>
                 SVP ! Ecrivez votre adresse email pour recuperer votre mot de passe.
                </p>

                <?php if (count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo $error ?></li>
                            <?php endforeach ; ?>
                        </div>
                    <?php endif; ?>

                <div class="form-group">
                <!-- <label for="username">Email</label>  -->
                <input type="email" autofocus name="email"  id="" class="form-control form-control-lg">
                </div>


                <div class="form-group">
                <button type="submit" name="forgot_password" class="btn btn-danger btn-block btn-lg">Récupérer</button>
                </div>
                <p class="text-center">Des problemes?<a href="mailto:dzekroos@gmail.com">Contactez-nous</a></p>
                
            


                
                
                </form>
            
            </div>
        </div>
    </div>

        
    </body>
</html>