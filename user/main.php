<?php
    session_start();
    // Connexion à la base de données
    require "connexion.php" ;
    require_once "emailController.php";

    $errors = array();
    $username = "" ;
    $email = "";
    error_reporting(0);
    ini_set('display_errors', 0);


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

                //FLASH MSG
                $_SESSION['message'] = "Identification avec Succes!";
                $_SESSION['alert-class'] = "alert-success";
                header('location: ../user/index2.php');
                exit();





                $message= "L’etudiant a été ajouté  avec succès";
            } else {
                $errors['db_error'] = "DATABASE error : failed to register"; 
                //$message = "Error: " . $sql . "<br>" . mysqli_error($conn);
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
    // if(isset($_GET["message"])){
    // $message=$_GET["message"];
    // }

    //login

    if(isset($_POST["login-btn"])){
        //récupération et protection des données envoyées
        $username = $_POST['username'];
        
        $password = $_POST['password'];
        
    
        /*------------------------------------------------------------------------------------------------------------*/
        if (empty($username)) {
            $errors['nom'] = "Nom Requis";
        }
    
    
        if (empty($password)) {
            $errors['password'] = "Mot de passe Requis";
        }

        if (count($errors)=== 0){

            if ($username === "admin" && $password=== "admin"){
                
                $_SESSION['nom'] = "admin";
                
                $_SESSION['prenom'] = "admin";
                $_SESSION['verified'] = 1;
                $_SESSION['message'] = "Identification avec Succes!";
                $_SESSION['alert-class'] = "alert-success";
                header('location: ../user/index2.php');
                exit();


            } 
            else{
            $sql = "SELECT * FROM form WHERE email=? OR nom=? LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $username , $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if (password_verify($password , $user['password'])) {
                //gooood
                //login user
                
                $_SESSION['id'] = $user['id'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['sexe'] = $user['sexe'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['verified'] = $user['verified'];
                $_SESSION['matricule'] = $user['matricule'];
                $_SESSION['date_naissance'] = $user['date_naissance'];
                $_SESSION['date_insc'] = $user['date_insc'];
                $_SESSION['cycle'] = $user['cycle'];
                $_SESSION['filiere'] = $user['filiere'];
                $_SESSION['niveau'] = $user['niveau'];
                //sendVerificationEmail($email,$token);
                //FLASH MSG
                $_SESSION['message'] = "Identification avec Succes!";
                $_SESSION['alert-class'] = "alert-success";
                header('location: ../user/index2.php');
                exit();

            }
            else {
                $errors['login_fail'] = "Informations erronnes";

            }
    }}


        error_reporting(0);
        ini_set('display_errors', 0);
    
        
    }

    if(isset($_GET["message"])){
        $message=$_GET["message"];
        }
    
        if (isset($_GET['logout'])){
            session_destroy();
            unset($_SESSION['id']);
            unset($_SESSION['email']);
            unset($_SESSION['nom']);
            unset($_SESSION['verified']);
            header('location:login.php');
            exit();
        }

        if(isset($_POST["forgot_password"])){

            $email = $_POST["email"];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email n'est pas valide";
            }
        
            if (empty($email)) {
                $errors['email'] = "Email Requis";
            }

            if(count($errors)==0){
                $sql = "SELECT * FROM form WHERE email='$email' LIMIT 1";
                $result= mysqli_query($conn,$sql);
                $user = mysqli_fetch_assoc($result);
                $token = $user['token'];
                sendPasswordResetLink($email,$token);
                header('location: password_message.php');
                exit(0);
            }


        }

        if(isset($_POST['reset-password-btn'])){
            $password = $_POST['password'];
            $passwordConf = $_POST['passwordConf']; 
            if (empty($password) || empty($passwordConf)) {
                $errors['password'] = "Mot de passe Requis";
            }
        
            if ($password !== $passwordConf) {
                $errors['nom'] = "Les mdp sont differents";
            }

            $password = password_hash($password, PASSWORD_DEFAULT);
            $email = $_SESSION['email'];

            if(count($errors)==0){

                $sql = "UPDATE form SET password='$password' WHERE email='$email'";
                $result = mysqli_query($conn, $sql);
                if ($result){
                    header('location: login.php');
                    exit(0);
                }


            }

        }


        function resetPassword($token){

            global $conn;
            $sql = "SELECT * FROM form WHERE token='$token' LIMIT 1";
            $result= mysqli_query($conn,$sql);
            $user = mysqli_fetch_assoc($result);
            $_SESSION['email'] = $user['email'];
            header('location: reset_password.php');
                exit(0);



        }
        


?>