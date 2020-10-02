<?php
	session_start();
	// Connexion à la base de données
	require "connexion.php" ;
	require_once "emailController.php";

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

		$Newname = $niveau . " photo " . $matricule . " ". $nom . " " . $filiere . ".jpg";
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

		$Newname = $niveau . " cin " . $matricule . " ". $nom . " " . $filiere . ".jpg";
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

		$Newname = $niveau . " bac " . $matricule . " ". $nom . " " . $filiere . ".jpg";
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

		$Newname = $niveau . " attestation " . $matricule . " " . $nom . " " . $filiere . ".jpg";
		rename("img/$attestation_name", "img/$Newname");
		
		/*------------------------------------------------------------------------------------------------------------*/
		if (count($errors)=== 0){
			$password = password_hash($password , PASSWORD_DEFAULT);
			$token = bin2hex(random_bytes(50));
			$verified = false;
		
			$sql = "INSERT INTO form (nom, prenom, matricule,sexe, date_naissance, date_insc, cycle, filiere, niveau , email , password, token,verified) VALUES ('{$nom}', '{$prenom}', '{$matricule}','{$sexe}', '{$date_naissance}', '{$date_insc}','{$cycle}', '{$filiere}', '{$niveau}' , '{$email}','{$password}','{$token}','{$verified}')";
			$stmt = $conn->prepare($sql);
			//$stmt->bind_param('ssisssssssbss',$nom,$prenom,$matricule,$sexe,$date_naissance,$date_insc,$cycle,$filiere,$niveau, $email,$verified,$token,$password);
			
			//exécuter la requête d'insertion
			if ($stmt->execute()) {
				//login user
				$user_id = $conn->insert_id;
				$_SESSION['id'] = $user_id;
				$_SESSION['nom'] = $username;
				$_SESSION['prenom'] = $prenom;
				$_SESSION['sexe'] = $sexe;
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
	if (isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['nom']);
		unset($_SESSION['verified']);
		header('location:login.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>INSCRIPTION</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./style.css">
  <style>
		thead{
		background: #f39c12;

	}
	tbody{
		background: #3498db;
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
		color: #e2dbdb;
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
		color:#38ED16;
	}
	

</style>
</head>
<body>
	<nav class="zone blue ">
		<ul class="main-nav">
			<li><a href="acceuil.php">Acceuil</a></li>

			<li class="push"><a href="mailto:dzekroos@gmail.com">Contact</a></li>
		</ul>
	</nav>
	<?php if(isset($message)) { echo "<br><br><br><div class='sticky1 msgg yellow'>".$message."</div>"; } ?>
	
	<br>
	<div class="container1">
		<div >
			<form name="exe" action="index.php" method="post"  enctype="multipart/form-data" class="formx" >
				<?php if (count($errors) > 0): ?>
					<div class="alert alert-danger">
						<?php foreach ($errors as $error): ?>
							<li><?php echo $error ?></li>
						<?php endforeach ; ?>
					</div>
				<?php endif; ?>

				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label for="validationCustom01">Prenom</label>
						<input type="text" autofocus class="form-control" id="validationCustom01" placeholder="PRENOM"  name="prenom" required>

					</div>
					<div class="col-md-4 mb-3">
						<label for="validationCustom02">NOM</label>
						<input type="text" class="form-control" id="validationCustom02" placeholder="NOM" name="nom" value="<?php echo $username; ?>" >

					</div>
					
					<div class="col-md-4 mb-3">
						<label for="validationCustomUsername">Matricule</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroupPrepend">M</span>
							</div>
							<input type="text" class="form-control" id="validationCustomUsername" placeholder="MATRICULE" name="matricule" aria-describedby="inputGroupPrepend" name="auteur" required>
							<div class="invalid-feedback">
								Please choose a username.
							</div>
						</div>
					</div>
					
				</div>

				<div class="form-row">
					<div class="col-md-4 mb-3">
					<label for="email">Email</label> 
               		<input type="email" name="email" id="" value="<?php echo $email; ?>" class="form-control form-control-lg">

					</div>
					<div class="col-md-4 mb-3">
					<label for="password">Mot de passe</label> 
               		<input type="password" name="password" id="" class="form-control form-control-lg">

					</div>
					
					<div class="col-md-4 mb-3">
					<label for="passwordConf">Repeter le mot de passe</label> 
               		<input type="password" name="passwordConf" id="" class="form-control form-control-lg">
					</div>
					
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label for="validationCustom05">Date de naissance</label>
						<input type="date" id="date" class="form-control" name="date_naissance" required placeholder="AAAA/MM/JJ" >

					</div>
					<div class="col-md-4 mb-3">
						<label for="validationCustom05">Date d'inscription</label>
						<input type="date" id="date" class="form-control" name="date_insc" required placeholder="AAAA/MM/JJ">

					</div>
					<div class="col-md-4 mb-3">
						
						<label for="validationCustom03">Sexe</label>
						<select class="custom-select f" id="validationTooltip04" name="sexe" required>
							<option selected disabled value="">Choisir...</option>
							<option>Femme</option>
							<option>Homme</option>
							
						</select>

					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
						<label for="validationCustom03">Cycle</label>
						<select class="custom-select f" id="validationTooltip04" name="cycle" required>
							<option selected disabled value="">Choisir...</option>
							<option>Cycle ingénieurs d’Etat</option>
							<option>Cycle Master</option>
							<option>Cycle Doctorat</option>
						</select>

					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustom04">Filiere</label>
						<select class="custom-select f" id="validationTooltip04" name="filiere" required>
							<option selected disabled value="">Choisir...</option>
							<option>Actuariat-Finance</option>
							<option>Statistique-Economie Appliquée</option>
							<option>Statistique-Démographie</option>
							<option> Recherche Opérationnelle et Aide à la Décision</option>
							<option>Ingénierie des Données et des Logiciels</option>
							<option>Science des Données</option>
						</select>

					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustom05">Niveau</label>
						<select class="custom-select f" id="validationTooltip04" name="niveau" required>
							<option selected disabled value="">Choisir...</option>
							<option>1ere Annee</option>
							<option>2eme Annee</option>
							<option>3eme Annee</option>
						</select>

					</div>
				</div>
				<br>
				<div class="form-row">
					<div class="custom-file col-md-12 mb-12">
						<input type="file" class="custom-file-input f" name="photo" id="customFile" onchange="document.getElementById('uphoto').innerHTML = 'Insérée'"  accept="image/png, image/jpeg, image/bmp">
						
						<label class="custom-file-label f" id="uphoto" for="customFile">Photo</label>
					</div>
				</div>
				
				<div class="form-row">
					
					<div class="custom-file col-md-12 mb-12">
					<input type="file" class="custom-file-input f" name="cin" id="customFile" onchange="document.getElementById('ucin').innerHTML = 'Insérée'"  accept="image/png, image/jpeg, image/bmp">
						<label class="custom-file-label f" id="ucin" for="customFile">Copie de la CIN</label>
					</div>
				</div>	
				<br>
				<div class="form-row">	
					<div class="custom-file col-md-12 mb-12">
					<input type="file" class="custom-file-input f" name="bac" id="customFile" onchange="document.getElementById('ubac').innerHTML = 'Insérée'"  accept="image/png, image/jpeg, image/bmp">
						<label class="custom-file-label f" id="ubac" for="customFile">Copie du Baccalauréat</label>
					</div>
				</div>
					
				<div class="form-row">	
					<div class="custom-file col-md-12 mb-12">
					<input type="file" class="custom-file-input f" name="attestation" id="customFile" onchange="document.getElementById('uattes').innerHTML = 'Insérée'"  accept="image/png, image/jpeg, image/bmp">
						<label class="custom-file-label f" id="uattes" for="customFile">Attestation de réussite (CNC,DEUGS ou Licence)</label>
					</div>

				</div>
				<br>
				<div class="form-row">
					<div class="col-md-6 mb-3">
						<input Type="submit" name="Envoyer" value="Envoyer" class="btn-primary form-control">

					</div>
					<div class="col-md-6 mb-3">
						<input Type="reset" value="Initialiser" class="btn-primary form-control">
					</div>

				</div>
				




				


			</form>
			<p class="text-center "> <strong class="whity"> Deja Inscrit</strong> <a href="../USER/login.php">S'identifier</a></p>

		</div>

<!--
	</div></div>
<br><br><br><br><br><br><br><br><br><br><br>


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
			<tbody>-->
				<!-- Récupération de la liste des exercices  -->
			<!--	<?php
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
						
						."</td><td><a  href=\"supp_exe.php?matricule=".
						$row["matricule"]."\" onclick=\"return confirm('Vous voulez vraiment supprimer cet exercice')\">Supprimer</a></td></tr>";
					}
              // Le lien Modifier envoie vers la page modif_exe.php avec l'id de l'exercice
              // Le lien Supprimer envoie vers la page supp_exe.php avec l'id de l'exercice 
            // L'attribut "onclick" fait appel à la fonction confirm() afin de permettre à l'utilisateur de valider l'action de suppression.

				} 
				?>
			</tbody>
		</table>
	</div>-->

</body>
</html>