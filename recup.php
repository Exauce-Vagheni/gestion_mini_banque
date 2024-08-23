<?php 
include("classes.php");
include("connect.php");

if(isset($_POST['compte'])){

		$req=$con->prepare("SELECT * FROM compteBancaire WHERE numero=?");
		$req->execute(array($_POST['compte']));
		while($res=$req->fetch()){
			echo'<div class="card" style="width: 18rem;">
  <img src="photo/'.$res['photo'].'" class="card-img-top" alt="..." style="width:150px;">';
			$compte=new compteBancaire($res['numero'],$res['titulaire'],$res['solde']);
			$compte->Decrire();
		}

	$req1=$con->prepare("SELECT * FROM compteEpargne WHERE numero=?");
		$req1->execute(array($_POST['compte']));
		while($res=$req1->fetch()){
			echo'<div class="card" style="width: 18rem;">';
			$compte=new compteEpargne($res['numero'],$res['titulaire'],$res['soldeEpargne']);
			$compte->decrire_epargne();
		}
		
	}




?>