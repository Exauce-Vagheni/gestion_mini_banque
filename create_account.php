<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Depot compte Bancaire</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
  
   <?php 
    include("nav.php");
  ?>
	
	<form method="post" action="" enctype="multipart/form-data">
		<div class="container">
		<h3 class="mt-3">Créer un nouveau compte bancaire</h3>
		<?php include("save_account.php"); ?>
		<div class="mb-3">
  <label for="montant" class="form-label">Numero du compte</label>
  <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="numero" name="numero">
</div>
<div class="mb-3">
  <label for="montant" class="form-label">Titulaire du compte</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="titulaire" name="titulaire">
</div>
<div class="mb-3">
  <label for="montant" class="form-label">Premier solde</label>
  <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="solde" name="first_solde">
</div>
<div class="mb-3">
  <div align="center" id="photo_create"></div>
 <label for="montant" class="form-label">Photo du titulaire</label>        
 <input type="file" class="form-control" id="exampleFormControlInput1" name="photo" accept="image/*" onchange="afficherPhoto(event)">
</div>

<div class="mb-3">
  <button class="btn btn-primary">Créer le compte</button>
</div>

	</div>
	</form>
</body>
<script>
      function afficherPhoto(event) {
      var input = event.target;
      var reader = new FileReader();
      reader.onload = function() {
        var img = document.createElement("img");
        img.src = reader.result;
        img.style.width = "50%";
        var div = document.getElementById("photo_create");
        if (div.hasChildNodes()) {
          div.removeChild(div.firstChild);
        }
        div.appendChild(img);
      };
      reader.readAsDataURL(input.files[0]);
    }
       </script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>