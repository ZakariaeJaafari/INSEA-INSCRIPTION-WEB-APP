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


        <title>Recupperer mdp</title>
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
                <form action="reset_password.php" class="frm" method="post">
                <h3 class="text-center">Recupperer le Mot de passe</h3>

                <?php if (count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo $error ?></li>
                            <?php endforeach ; ?>
                        </div>
                    <?php endif; ?>

            

                <div class="form-group">
                <label for="password">Mot de passe</label> 
                <input type="password" name="password" id="" class="form-control form-control-lg">
                </div>

                <div class="form-group">
                <label for="password">Confirmer le Mot de passe</label> 
                <input type="password" name="passwordConf" id="" class="form-control form-control-lg">
                </div>


                <div class="form-group">
                <button type="submit" name="reset-password-btn" class="btn btn-primary btn-block btn-lg">Recupperer</button>
                </div>
               


                
                
                </form>
            
            </div>
        </div>
    </div>

        
    </body>
</html>