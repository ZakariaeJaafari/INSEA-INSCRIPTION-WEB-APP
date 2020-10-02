<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
    <link rel="stylesheet" href="style.css">

    <title>Register</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 form-div">
            <form action="signup.php" method="post">
            <h3 class="text-center">S'inscrire</h3>

            <!-- <div class="alert alert-danger">
                <li>NOM Requis</li>

            </div> -->

            <div class="form-group">
               <label for="username">NOM</label> 
               <input type="text" name="username" id="" class="form-control form-control-lg">
            </div>

            <div class="form-group">
               <label for="email">Email</label> 
               <input type="email" name="email" id="" class="form-control form-control-lg">
            </div>

            <div class="form-group">
               <label for="password">Mot de passe</label> 
               <input type="password" name="password" id="" class="form-control form-control-lg">
            </div>

            <div class="form-group">
               <label for="passwordConf">Repeter le mot de passe</label> 
               <input type="password" name="passwordConf" id="" class="form-control form-control-lg">
            </div>

            <div class="form-group">
              <button type="submit" name="signup-btn" class="btn btn-primary btn-block btn-lg">S'inscrire</button>
            </div>

            <p class="text-center"> Deja Inscrit <a href="login.php">S'identifier</a></p>


            
            
            </form>
        
        </div>
    </div>
</div>

    
</body>
</html>