<?php
	include("connect.php");
	include("classes.php");
	if(isset($_POST['compte1']) AND isset($_POST['compte2']) AND isset($_POST['virement']) AND ($_POST['compte1']!=$_POST['compte2'])){
		$req=$con->prepare("SELECT * FROM compteBancaire WHERE numero=?");
		$req->execute(array($_POST['compte1']));
		while($res=$req->fetch()){
			$compte=new compteBancaire($res['numero'],$res['titulaire'],$res['solde']);
			$new_solde=$compte->Virer($_POST['virement']);
			if ($res['solde']!=0 AND $res['solde']>=$_POST['virement']) {
				$req=$con->prepare("UPDATE compteBancaire SET solde=? WHERE numero=?");
			$req->execute(array($new_solde,$_POST['compte1']));

			$req=$con->prepare("UPDATE compteBancaire SET solde=solde+:montant WHERE numero=:numero");
			$req->execute(array('montant'=>$_POST['virement'],'numero'=>$_POST['compte2']));

			$req=$con->prepare("INSERT INTO virements VALUES(?,?,?)");
			$req->execute(array($_POST['compte1'],$_POST['compte2'],$_POST['virement']));

			echo "<p class='alert alert-success'>"."Virement effectué avec succès"."</p>";

			}else{
				echo "<p class='alert alert-danger'>"."Solde insuffisant pour virement"."</p>";

			}
			
		}
		
	}
	
	?>