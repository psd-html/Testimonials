<?php
class Testimonials extends plxPlugin {

		public function __construct($default_lang) {

			parent::__construct($default_lang);

			$this->setConfigProfil(PROFIL_ADMIN);

			$this->addHook('AdminTopEndHead', 'AdminTopEndHead');

			$this->addHook('Testimonials', 'Testimonials');

		}


		public function AdminTopEndHead() { ?>
			<link rel="stylesheet" href="<?php echo PLX_PLUGINS ?>Testimonials/app/style.css" media="screen"/>
			<?php
		}


		


		public function Testimonials() {

			$nbcommentaire = floor(sizeof($this->aParams)/2); // nombre de commentaires

			$nbcommentaire = $nbcommentaire + 1;

			?><style>.commentaire{font-style: italic;color:#fff}</style><?php
		
			for($i=1; $i<$nbcommentaire; $i++) { // boucle pour afficher les commentaires

				$auteur = $this->getParam('auteur'.$i);
				$commentaire = $this->getParam('commentaire'.$i);
				$projet = $this->getParam('projet'.$i);

				if(!empty($auteur)) { // si le champ auteur et vide 
					echo '<p><spam class="commentaire">'.$commentaire.'</spam><br>Ecrit par:  '.$auteur.'<br>Pour le projet: '.$projet.'</p>';
				}			
			} 
		}			

	
	} // class Testimonials

?>