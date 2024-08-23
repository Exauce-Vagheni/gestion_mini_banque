<?php 
	
	
	Class CompteBancaire{
		public $numero;
		public $titulaire;
		public $solde;
		public $photo;

		public function __construct($lenumero,$letitulaire,$lesolde,$size,$tmp_name,$name){
			$con=new PDO("mysql:host=localhost;dbname=bdd_banque",'root','');
			$this->numero=$lenumero;
			$this->titulaire=$letitulaire;
			$this->solde=$lesolde;

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
			$req->execute(array($this->numero,$this->titulaire,$this->solde,$name));

			$req=$con->prepare("INSERT INTO compteEpargne VALUES(?,?,?)");
			$req->execute(array($this->numero,0,0));
			echo "<p class='alert alert-success'>"."Compte créer avec succès"."</p>";

        }
    }
}
			
		}

		public function Augmenter($montant){
			$con=new PDO("mysql:host=localhost;dbname=bdd_banque",'root','');
			$req=$con->prepare("SELECT solde FROM compteBancaire WHERE numero=?");
			$req->execute(array($this->numero));
			while($res=$req->fetch()){
				$req2=$con->prepare("UPDATE compteBancaire SET solde=solde+? WHERE numero=?");
				$req2->execute(array($montant,$this->numero));
			}
			
		}

		public function Diminuer($montant){
			$con=new PDO("mysql:host=localhost;dbname=bdd_banque",'root','');
			$req=$con->prepare("SELECT solde FROM compteBancaire WHERE numero=?");
			$req->execute(array($this->numero));
			while($res=$req->fetch()){
				$req2=$con->prepare("UPDATE compteBancaire SET solde=solde-? WHERE numero=?");
				$req2->execute(array($montant,$this->numero));
			}
			
		}

		public function Solder(){
			$con=new PDO("mysql:host=localhost;dbname=bdd_banque",'root','');
				$req=$con->prepare("UPDATE compteBancaire SET solde=0 WHERE numero=?");
				$req->execute(array($this->numero));
			}

		public function Decrire(){
			$con=new PDO("mysql:host=localhost;dbname=bdd_banque",'root','');
			$req=$con->prepare("SELECT * FROM compteBancaire INNER JOIN compteEpargne ON compteBancaire.numero=compteEpargne.numero WHERE compteBancaire.numero=?");
			$req->execute(array($this->numero));
			while($res=$req->fetch()){
				?>
				<div class="card" style="width: 18rem;">
  <img src="photo/<?php echo $res['photo']; ?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Code du compte: <?php echo $res['numero']; ?></h5>
    <p class="card-text">Plus d'informations sur le compte</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Titulaire: <?php echo $res['titulaire']; ?></li>
    <li class="list-group-item">Solde du compte: <?php echo $res['solde']; ?></li>
    <li class="list-group-item">Epargne: <?php echo $res['soldeEpargne']; ?></li>
    <li class="list-group-item">Intérêts sur épargne: <?php echo $res['interets']; ?></li>
  </ul>
</div>
				<?php
			}
		}

		public function virer($compte1,$compte2,$montant){
			$con=new PDO("mysql:host=localhost;dbname=bdd_banque",'root','');
			$req=$con->prepare("SELECT solde FROM compteBancaire WHERE numero=?");
			$req->execute(array($compte1));
			while($res=$req->fetch()){
				if($res['solde']>=$montant){
					$req=$con->prepare("UPDATE compteBancaire SET solde=solde-:solde WHERE numero=:numero");
					$req->execute(array('solde'=>$montant,'numero'=>$compte1));

					$req=$con->prepare("UPDATE compteBancaire SET solde=solde+:solde WHERE numero=:numero");
					$req->execute(array('solde'=>$montant,'numero'=>$compte2));

					$req=$con->prepare("INSERT INTO virements VALUES(?,?,?)");
					$req->execute(array($compte1,$compte2,$montant));

				}else{
					echo "Solde du compte: ".$compte1." est insuffisant pour ce virement";
				}
			}
		}	
		}

		Class compteEpargne{
			public $compte;
			public $soldeEpargne;

			public function DepotEpargne($compte,$montant){
				$this->compte=$compte;
				$this->soldeEpargne=$montant;
				$con=new PDO("mysql:host=localhost;dbname=bdd_banque",'root','');
				$req=$con->prepare("UPDATE compteEpargne SET soldeEpargne=soldeEpargne+:montant,interets=(soldeEpargne*0.035) WHERE numero=:numero");
				$req->execute(array('montant'=>$this->soldeEpargne,'numero'=>$this->compte));
			}

			}

?>