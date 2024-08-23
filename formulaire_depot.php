<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Depot compte Bancaire</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
	<?php 
		include("nav.php");
	?>
	<form method="post" action="">
		
		<div class="container">
		<h3 class="mt-3">Effectuer un dépôt dans un compte bancaire</h3>
		<?php include("save_depot.php"); ?>
	<div class="mb-3">
  <label for="compte" class="form-label">Selectionner Compte bancaire</label>
  <select class="form-select" name="compte">
  	<?php 
 		$con=new PDO("mysql:host=localhost;dbname=bdd_banque",'root','');
  		$req=$con->query("SELECT * FROM compteBancaire");
  		while($res=$req->fetch()){
  			?>
  			<option value=<?php echo $res['numero'];?>><?php echo $res['numero'].": ".$res['titulaire'];?></option>
  				<?php
  		}
  	?>
  </select>
</div>
		<div class="mb-3">
  <label for="montant" class="form-label">Montant à deposer</label>
  <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="montant" name="montant">
</div>

<div class="mb-3">
  <button class="btn btn-primary">Effectuer</button>
</div>

	</div>
	</form>
	
</body>
<script type="text/javascript" src=" 	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>