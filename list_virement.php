 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Historique</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
		<?php 
		include("nav.php");
	?>
 <table class="table">
  <thead>
    <tr>
      <th scope="col">Envoyeur</th>
      <th scope="col">Receveur</th>
      <th scope="col">Montant</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include("connect.php");
$req=$con->query("SELECT * FROM virements INNER JOIN compteBancaire ON virements.envoyeur=compteBancaire.numero");
while($res=$req->fetch()){
    ?>
<tr>
      <th scope="row"><?php echo $res['titulaire'];?></th>
      <?php 
$req2=$con->prepare("SELECT titulaire FROM compteBancaire WHERE numero=?");
$req2->execute(array($res['receveur']));
while($res2=$req2->fetch()){
?>
 <td><?php echo $res2['titulaire'];?></td>
<?php
}
  ?>
      <td><?php echo $res['montant'];?></td>
    </tr>

    <?php
}
?>
  </tbody>
</table>
                        

</body>
<script type="text/javascript" src=" 	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>