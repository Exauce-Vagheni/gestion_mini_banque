<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Etat d'un compte</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
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
		<h3 class="mt-3">Voir l'état d'un compte</h3>

	<div class="mb-3">
  <label for="compte" class="form-label">Compte à vérifier</label>
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
  <button class="btn btn-primary">Consulter</button>
</div>

	</div>
	</form>
	<div class="container">
		<?php include("recup.php"); ?>
	</div>
</body>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
</body>
</html>