<?php 
	
	
	Class CompteBancaire{
		public $numero;
		public $titulaire;
		public $solde;

		public function __construct($lenumero,$letitulaire,$lesolde){
			$this->numero=$lenumero;
			$this->titulaire=$letitulaire;
			$this->solde=$lesolde;
			
		}

		public function Augmenter($montant){
			$this->solde=$this->solde+$montant;
			return $this->solde;
		}

		public function Diminuer($montant){
			$this->solde=$this->solde-$montant;	
			return $this->solde;	
		}

		public function Solder(){
			$this->solde=$this->solde-$this->solde;
			return $this->solde;
			}

		public function Decrire(){
			echo '
  <div class="card-body">
    <h5 class="card-title">Code du compte bancaire: '.$this->numero.'</h5>
    <p class="card-text">Plus d\'informations sur le compte  Bancaire</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Titulaire: '.$this->titulaire.'</li>
    <li class="list-group-item">Solde du compte: '.$this->solde.'</li>
  </ul>
</div>';
		}

		public function virer($montant){
			$this->solde=$this->solde-$montant;
			return $this->solde;
			}

		}	
		
		Class compteEpargne extends CompteBancaire {
			public $interets;

			 public function __construct($lenumero,$letitulaire,$lesolde){
			 			$this->numero=$lenumero;
						$this->titulaire=$letitulaire;
						$this->solde=$lesolde;
						$this->interets=$this->solde*0.035;
			 }
			public function depot_epargne($montant){
			$this->solde=$this->solde+$montant;
			return $this->solde;
			}

			 public function decrire_epargne(){
			 		echo '<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Compte Epargne</h5>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Titulaire: '.$this->titulaire.'</li>
    <li class="list-group-item">Solde du compte: '.$this->solde.'</li>
    <li class="list-group-item">Interets: '.$this->interets.'</li>
  </ul>
</div>';
			 }
			
			}

?>