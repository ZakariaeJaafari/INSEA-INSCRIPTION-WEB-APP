<?php
include "connexion.php" ;

//Après appel de la page on a récupéré l'id de l'exercice en question
if(isset($_GET["matricule"])){
	//protection de données
	$idm = mysqli_real_escape_string($conn,$_GET["matricule"]);
	$sql = "SELECT * FROM form WHERE matricule=$idm";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
    	// Récupérer des informations de l'exercice en question qui seront par la suite afficher dans le formulaire en bas
        $row = mysqli_fetch_assoc($result);
        $id=$row["id"];
        $titre=$row["titre"];
        $auteur=$row["auteur"];
        $date=$row["date_creation"];
    }  
    else{
        	//Si erreur envoie de message à la page exercice.php
            $message="L'exercice est introuvable";
        	header("Loation:exercice.php?message=$message");
        }
    }
    // Après clic sur le bouton modifier on récupère les données envoyées par la méthode post
 if(count($_POST)>3) {
	$titre = mysqli_real_escape_string($conn,$_POST["titre"]);
	$auteur = mysqli_real_escape_string($conn, $_POST["auteur"]);
	$date = mysqli_real_escape_string($conn, $_POST["date"]);
	$id=mysqli_real_escape_string($conn, $_POST["id"]);
	$sql = "update  exercice set titre='{$titre}' , auteur='{$auteur}', date_creation='{$date}'
     WHERE id=$id";
    //executer le requete de l'update et redirection vers la page exercice.php
	if (mysqli_query($conn, $sql)) {
    	$message= "L'exercice a été mis à jour avec succes";
	} else {
    	$message = "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	header("Location:exercice.php?message=$message");
}

        ?>
		      
<!--  Afficher le formulaire rempli par les données de l'exercice récupéré en haut.-->
        <form name="exe" action="modif_exe.php" method="post">
      		<fieldset>
      			<legend>Modifier un exercice</legend>
      			<input type="hidden" id="id" name="id" value="<?php if(isset($id)) { echo $id; } ?>"><br/>
      			<label for="titre">Titre de l'exercice</label>
      			<input type="text" id="titre" name="titre" required value="<?php if(isset($titre)) { echo $titre; } ?>"><br/>
      			<label for="auteur">Auteur de l'exercice</label>
      			<input type="text" id="auteur" name="auteur" required value="<?php if(isset($auteur)) { echo $auteur; } ?>"><br/>
      			<label for="date">Date creation</label>
      			<input type="date" id="date" name="date" required value="<?php if(isset($date)) { echo $date; } ?>"><br/>
      			<input Type="submit" value="Modifier">
      		</fieldset>
      </form>





