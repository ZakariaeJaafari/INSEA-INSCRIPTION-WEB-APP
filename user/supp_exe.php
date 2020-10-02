<?php
include "connexion.php" ;

if(!empty($_GET["matricule"])){
    //Supprimer l'etudiant dont le matricule est envoyé avec l'URL
	$ids = mysqli_real_escape_string($conn,$_GET["matricule"]);
	$sql = "DELETE FROM form WHERE matricule=$ids";
	echo $sql;
	if (mysqli_query($conn, $sql)) {
    	$message= "l'etudiant a été supprimé avec succés";
	} else {
    	$mesasge="Erreur pendant la suppression de l'etudiant: " . mysqli_error($conn);
	}
	//Redirection vers la page exercice.php avec un message résultat de la suppression 
   header("Location:index2.php");

}
else{
	echo "<h1 style='text-align:center;color:red;'>impossible de supprimer<h1>";
}