<?php 
include("connect.php");
if (isset($_POST['numero']) AND isset($_POST['titulaire']) AND isset($_POST['first_solde']) AND  isset($_FILES['photo'])) {
	$size=$_FILES['photo']['size'];
	$tmp_name=$_FILES['photo']['tmp_name'];
	$name=$_FILES['photo']['name'];

			 if($size<=100000000){
            $infofichier=pathinfo($name);
            $ext_upload="";
            if(isset($infofichier['extension'])){
            	$ext_upload=$infofichier['extension'];
            }
            
            $ext_auto=array('png','jpg','jpeg');
        if(in_array($ext_upload,$ext_auto)){
        if(move_uploaded_file($tmp_name,'photo/'.basename($name))){
         $req=$con->prepare("INSERT INTO compteBancaire VALUES(?,?,?,?)");
			$req->execute(array($_POST['numero'],$_POST['titulaire'],$_POST['first_solde'],$name));

			$req=$con->prepare("INSERT INTO compteEpargne VALUES(?,?,?,?)");
			$req->execute(array($_POST['numero'],0,0,$_POST['titulaire']));
			echo "<p class='alert alert-success'>"."Compte créer avec succès"."</p>";

        }
    }
}

}else{
	echo "Veuillez entrer toutes les informations";
}


?>