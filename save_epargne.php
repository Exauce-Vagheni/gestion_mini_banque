<?php
	include("classes.php");
	include("connect.php");
	if(isset($_POST['compte']) AND isset($_POST['epargne'])){

	if(isset($_POST['compte']) AND isset($_POST['epargne'])){
		$req=$con->prepare("SELECT * FROM compteEpargne WHERE numero=?");
		$req->execute(array($_POST['compte']));
		while($res=$req->fetch()){
			$compte=new compteEpargne($res['numero'],$res['titulaire'],$res['soldeEpargne']);
			$new_solde=$compte->Augmenter($_POST['epargne']);

			$req=$con->prepare("UPDATE compteEpargne SET soldeEpargne=?,interets=soldeEpargne*0.035 WHERE numero=?");
			$req->execute(array($new_solde,$_POST['compte']));
		}
		echo "<p class='alert alert-success'>"."Dépôt de l'épargne effectué avec succès"."</p>";

	}
	
	}
	
	?>