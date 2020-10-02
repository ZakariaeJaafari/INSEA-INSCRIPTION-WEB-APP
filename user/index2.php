<?php
    
    require "main.php" ;
    $errors = array();
    $username = "" ;
    $email = "";


    //Après clic sur le bouton "Envoyer" envoie de données par post
    if(isset($_POST["Envoyer"])){
    //récupération et protection des données envoyées
    $username = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
    $nom = mysqli_real_escape_string($conn,$_POST["nom"]);
    $prenom = mysqli_real_escape_string($conn,$_POST["prenom"]);
    $matricule = mysqli_real_escape_string($conn,$_POST["matricule"]);
    $sexe = mysqli_real_escape_string($conn,$_POST["sexe"]);
    $date_naissance = mysqli_real_escape_string($conn,$_POST["date_naissance"]);
    $date_insc = mysqli_real_escape_string($conn,$_POST["date_insc"]);
    $cycle = mysqli_real_escape_string($conn,$_POST["cycle"]);
    $filiere = mysqli_real_escape_string($conn,$_POST["filiere"]);
    $niveau = mysqli_real_escape_string($conn,$_POST["niveau"]);
    /*$cin = mysqli_real_escape_string($conn,$_POST["cin"]);
    $photo = mysqli_real_escape_string($conn,$_POST["photo"]);
    $bac = mysqli_real_escape_string($conn, $_POST["bac"]);
    $attestation = mysqli_real_escape_string($conn, $_POST["attestation"]);*/

    /*------------------------------------------------------------------------------------------------------------*/
    if (empty($username)) {
        $errors['nom'] = "Nom Requis";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email n'est pas valide";
    }

    if (empty($email)) {
        $errors['email'] = "Email Requis";
    }

    if (empty($password)) {
        $errors['password'] = "Mot de passe Requis";
    }

    if ($password !== $passwordConf) {
        $errors['nom'] = "Les mdp sont differents";
    }

    $emailQuery = "SELECT * FROM form WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($emailQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    $stmt->close();
    if ($userCount > 0){
        $errors['email'] = "Email Deja Existe";

    }




        /*------------------------------------------------------------------------------------------------------------*/


    $photo_name = $_FILES['photo']['name'];
        $photo_temp_name = $_FILES['photo']['tmp_name'];
        $photo_type = $_FILES['photo']['type'];
        $directory = 'img/';

        if (!is_uploaded_file($photo_temp_name))
        {
            exit("Le fichier est introuvable");
        }
        if (!strstr($photo_type, 'jpg') && !strstr($photo_type, 'jpeg') && !strstr($photo_type, 'pdf') && !strstr($photo_type, 'png') && !strstr($photo_type, 'bmp'))
        {
            exit("Le fichier n'est pas une image");
        }

        if (!move_uploaded_file($photo_temp_name, $directory . $photo_name))
        {
            exit(" Impossible de copier le fichier dans $directory ");
        }

        $Newname = $niveau . "" . $matricule . "" . $filiere . ".jpg";
        rename("img/$photo_name", "img/$Newname");
        
        /*------------------------------------------------------------------------------------------------------------*/

        $cin_name = $_FILES['cin']['name'];
        $cin_temp_name = $_FILES['cin']['tmp_name'];
        $cin_type = $_FILES['cin']['type'];
        $directory = 'img/';

        if (!is_uploaded_file($cin_temp_name))
        {
            exit("Le fichier est introuvable");
        }
        if (!strstr($cin_type, 'jpg') && !strstr($cin_type, 'jpeg') && !strstr($cin_type, 'pdf') && !strstr($cin_type, 'png') && !strstr($cin_type, 'bmp'))
        {
            exit("Le fichier n'est pas une image");
        }

        if (!move_uploaded_file($cin_temp_name, $directory . $cin_name))
        {
            exit(" Impossible de copier le fichier dans $directory ");
        }

        $Newname = $niveau . "" . $matricule . "" . $filiere . ".jpg";
        rename("img/$cin_name", "img/$Newname");
        
        /*------------------------------------------------------------------------------------------------------------*/
        $bac_name = $_FILES['bac']['name'];
        $bac_temp_name = $_FILES['bac']['tmp_name'];
        $bac_type = $_FILES['bac']['type'];
        $directory = 'img/';

        if (!is_uploaded_file($bac_temp_name))
        {
            exit("Le fichier est introuvable");
        }
        if (!strstr($bac_type, 'jpg') && !strstr($bac_type, 'jpeg') && !strstr($bac_type, 'pdf') && !strstr($bac_type, 'png') && !strstr($bac_type, 'bmp'))
        {
            exit("Le fichier n'est pas une image");
        }

        if (!move_uploaded_file($bac_temp_name, $directory . $bac_name))
        {
            exit(" Impossible de copier le fichier dans $directory ");
        }

        $Newname = $niveau . "" . $matricule . "" . $filiere . ".jpg";
        rename("img/$bac_name", "img/$Newname");
        
        /*------------------------------------------------------------------------------------------------------------*/
        $attestation_name = $_FILES['attestation']['name'];
        $attestation_temp_name = $_FILES['attestation']['tmp_name'];
        $attestation_type = $_FILES['attestation']['type'];
        $directory = 'img/';

        if (!is_uploaded_file($attestation_temp_name))
        {
            exit("Le fichier est introuvable");
        }
        if (!strstr($attestation_type, 'jpg') && !strstr($attestation_type, 'jpeg') && !strstr($attestation_type, 'pdf') && !strstr($attestation_type, 'png') && !strstr($attestation_type, 'bmp'))
        {
            exit("Le fichier n'est pas une image");
        }

        if (!move_uploaded_file($attestation_temp_name, $directory . $attestation_name))
        {
            exit(" Impossible de copier le fichier dans $directory ");
        }

        $Newname = $niveau . "" . $matricule . "" . $filiere . ".jpg";
        rename("img/$attestation_name", "img/$Newname");
        
        /*------------------------------------------------------------------------------------------------------------*/
        if (count($errors)=== 0){
            $password = password_hash($password , PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(50));
            $verified = false;
        
            $sql = "INSERT INTO form (nom, prenom, matricule,sexe, date_naissance, date_insc, cycle, filiere, niveau , email , password) VALUES ('{$nom}', '{$prenom}', '{$matricule}','{$sexe}', '{$date_naissance}', '{$date_insc}','{$cycle}', '{$filiere}', '{$niveau}' , '{$email}','{$password}')";
            $stmt = $conn->prepare($sql);
            //$stmt->bind_param('ssisssssssbss',$nom,$prenom,$matricule,$sexe,$date_naissance,$date_insc,$cycle,$filiere,$niveau, $email,$verified,$token,$password);
            
            //exécuter la requête d'insertion
            if ($stmt->execute()) {
                //login user
                $user_id = $conn->insert_id;
                $_SESSION['id'] = $user_id;
                $_SESSION['nom'] = $username;
                $_SESSION['sexe'] = $sexe;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['email'] = $email;
                $_SESSION['verified'] = $verified;
                $_SESSION['matricule'] = $matricule;
				$_SESSION['date_naissance'] = $date_naissance;
				$_SESSION['date_insc'] = $date_insc;
				$_SESSION['cycle'] = $cycle;
				$_SESSION['filiere'] = $filiere;
				$_SESSION['niveau'] = $niveau;
                sendVerificationEmail($email,$token);
                //FLASH MSG
                $_SESSION['message'] = "Identification avec Succes!";
                $_SESSION['alert-class'] = "alert-success";
                header('location: ../user/index2.php');
                exit();





                $message= "L’etudiant a été ajouté  avec succès";
            } else {
                $errors['db_error'] = "DATABASE error : failed to register"; 
                $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            }
        }
    
    //   //exécuter la requête d'insertion
    //   if (mysqli_query($conn, $sql)) {
    //     $message= "L’etudiant a été ajouté  avec succès";
    //   } else {
    //     $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    //   }
    // }

    //les autres pages peuvent envoyer un message dans L’URL. On le  récupère ici pour l'afficher dans l’élément "div.message"
    if(isset($_GET["message"])){
    $message=$_GET["message"];
    }

    function verifyUser(){
        global $token;
        global $conn;
        global  $update_query;
        $sql = "SELECT * FROM form WHERE token='$token' LIMIT 1";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result)>0) {
            $user = mysqli_fetch_assoc($result);
            $update_query = "UPDATE form SET verified=1 WHERE token='$token'";
        }

        if (mysqli_query($conn,$update_query)){
            $_SESSION['id'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['sexe'] = $user['sexe'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = 1;
            $_SESSION['matricule'] = $user['matricule'];
            $_SESSION['date_naissance'] = $user['date_naissance'];
            $_SESSION['date_insc'] = $user['date_insc'];
            $_SESSION['cycle'] = $user['cycle'];
            $_SESSION['filiere'] = $user['filiere'];
            $_SESSION['niveau'] = $user['niveau'];
            //sendVerificationEmail($email,$token);
            //FLASH MSG
            $_SESSION['message'] = "Email confirmééé";
            $_SESSION['alert-class'] = "alert-success";
            header('location: ../user/index2.php');
            exit();


        }
    }

    if (isset($_GET['token'])){
        $token = $_GET['token'];
        verifyUser($token);
    }

    if (isset($_GET['password-token'])){
        $passwordToken = $_GET['password-token'];
        resetPassword($passwordToken);
    }


    // if (isset($_GET['logout'])){
    //     session_destroy();
    //     unset($_SESSION['id']);
    //     unset($_SESSION['email']);
    //     unset($_SESSION['nom']);
    //     unset($_SESSION['verified']);
    //     header('location:login.php');
    //         exit();
    // }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
    <link rel="stylesheet" href="style.css">

    <title>Acceuil</title>
    <style>

        html,body { 
  background: url(bg5.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}


		thead{
		background: #f39c14;

	}
	tbody{
		background: #3498dc;
		color: white;
	}
	td,th{
		width: 100px;
		text-align: center;
		border: 1px solid white;
	}
	.grid{
		width: 100%;
		display: flex;
		align-items: center;
		justify-content: center
	}
	.msgg{
		display: flex;
		
		justify-content: center;
		width: 50%;
	}
	.sticky1 {
		
		top: 3;
		width: 100%;
	}
	label,legend{
		font-size: 1.3rem;
		color: #e2dbdc;
	}
	body,
	html {
		width: 100%;
		height: 100%;
		font-family: 'Montserrat', sans-serif;
		background: url(header2.jpg) no-repeat center center fixed; 

		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	.formx{
		margin: 50px auto 50px;
		padding: 25px 15px 10px 15px;
		border: 1px solid #80ced7;
		border-radius: 5px;
		font-size: 1.1em;
		
	}
	.btn-primary:hover{
		background-color: #ee4b08;
		border-color: #ee4b08;
		border-width: 4px;
		border-radius: 50px;


	}
	input:hover {
		border-color: #ee4b08;
		border-width: 4px;
		border-radius: 50px;

	}

	.f:hover{
		border-color: #ee4b08;
		border-width: 4px;
		
	}
	.container1 {
		/*show heigh: auto*/
		/*height: 50vh;*/ 
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.whity{
		color:#38ED1B;
	}
	


    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 form-div login">
        <?php if(isset($_SESSION['message'])):?>
           <div class="alert <?php echo $_SESSION['alert-class']; ?>">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                    unset($_SESSION['alert-class']);
                ?>
                

           </div>
           <?php endif;?> 

           <?php if($_SESSION['nom']==="admin"): ?>
            <h3>Bienvenue, <?php echo $_SESSION['nom']; ?> </h3>
           <br>
            <pre><strong> NOM :</strong> <?php echo $_SESSION['nom']; ?></pre>
           <pre><strong> PRENOM :</strong> <?php echo $_SESSION['prenom']; ?></pre>
           
           <a href="login.php?logout=1" class="logout">Deconnecter</a>
            
            <?php else: ?>
                <h3>Bienvenue, <?php echo $_SESSION['nom']; ?> </h3>
           <br>
           <pre><strong> MATRICULE :</strong> <?php echo $_SESSION['matricule']; ?></pre>
           <pre><strong> NOM :</strong> <?php echo $_SESSION['nom']; ?></pre>
           <pre><strong> PRENOM :</strong> <?php echo $_SESSION['prenom']; ?></pre>
           <pre><strong> SEXE :</strong> <?php echo $_SESSION['sexe']; ?></pre>
           <pre><strong> EMAIL :</strong> <?php echo $_SESSION['email']; ?></pre>
           <pre><strong> CYCLE :</strong> <?php echo $_SESSION['cycle']; ?></pre>
           <pre><strong> FILIERE :</strong> <?php echo $_SESSION['filiere']; ?></pre>
           <pre><strong> NIVEAU :</strong> <?php echo $_SESSION['niveau']; ?></pre>
           <pre><strong> DATE DE NAISSANCE :</strong> <?php echo $_SESSION['date_naissance']; ?></pre>
           <pre><strong> DATE D'INSCRIPTION :</strong> <?php echo $_SESSION['date_insc']; ?></pre><br>
            <a href="login.php?logout=1" class="logout">Deconnecter</a>

            <?php if(!$_SESSION['verified']):?>
                <div class="alert alert-warning">
                    vous devez verifie votre compte.
                    visitez votre compte et verifiez le message envoye a
                    <strong><?php echo $_SESSION['email']; ?></strong>

                </div>
            <?php endif;?> 
            <?php if($_SESSION['verified']):?>   
                
                <a href="supp_exe.php?matricule=<?php echo $_SESSION['matricule'];?>" onclick="return confirm('Vous voulez vraiment supprimer ce profil definitivement!!!!!!')">Supprimer</a>
               
                
                <button class="btn btn-block btn-lg btn-primary">C'est verifie!</button>
            <?php endif;?>
            <?php endif; ?>

            
        </div>
    </div>
</div>
<?php if($_SESSION['nom']==="admin"): ?>
<div class="grid ">
                <table  cellspacing="0">
                    <thead>
                        <tr>
                            <th>matricule</th>
                            <th>nom</th>
                            <th>prenom</th>
                            <th>date de naissance</th>
                            <th>date d'inscription</th>
                            <th>sexe</th>
                            <th>cycle</th>
                            <th>filiere</th>
                            <th>niveau</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Récupération de la liste des exercices  -->
                        <?php
                        $sql = "SELECT * FROM form";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                        // Parcourir les lignes de résultat

                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr><td> " . $row["matricule"]. "</td><td>" . 
                                $row["nom"]. "</td><td>" . 
                                $row["prenom"]."</td><td>" . 
                                $row["date_naissance"] ."</td><td>" .
                                $row["date_insc"]. "</td><td>" .
                                $row["sexe"]. "</td><td>" .
                                $row["cycle"]. "</td><td>" .
                                $row["filiere"]. "</td><td>" .
                                $row["niveau"] 
                                
                                ."</td><td><a style=\"color:blue;text-align:center;\" href=\"supp_exe.php?matricule=".
                                $row["matricule"]."\" onclick=\"return confirm('Vous voulez vraiment supprimer cet etudiant de la liste')\">Supprimer</a></td></tr>";
                            }
                    // Le lien Modifier envoie vers la page modif_exe.php avec l'id de l'exercice
                    // Le lien Supprimer envoie vers la page supp_exe.php avec l'id de l'exercice 
                    // L'attribut "onclick" fait appel à la fonction confirm() afin de permettre à l'utilisateur de valider l'action de suppression.

                        } 
                        ?>
                    </tbody>
                </table>
	</div>
    <?php endif;?>

    
</body>
</html>