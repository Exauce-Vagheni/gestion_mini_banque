<?php
	include("connect.php");
	include("classes.php");
	if(isset($_POST['compte']) AND isset($_POST['montant'])){
		$req=$con->prepare("SELECT * FROM compteBancaire WHERE numero=?");
		$req->execute(array($_POST['compte']));
		while($res=$req->fetch()){
			$compte=new compteBancaire($res['numero'],$res['titulaire'],$res['solde']);
			$new_solde=$compte->Diminuer($_POST['montant']);

			$req=$con->prepare("UPDATE compteBancaire SET solde=? WHERE numero=?");
			$req->execute(array($new_solde,$_POST['compte']));
		}
		echo "<p class='alert alert-success'>"."Retrait effectué avec succès"."</p>";

	}
	
	?>