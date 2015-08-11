<?php
class Testimonials extends plxPlugin {

		public function __construct($default_lang) {

			parent::__construct($default_lang);

			$this->setConfigProfil(PROFIL_ADMIN);

			$this->addHook('AdminTopEndHead', 'AdminTopEndHead');

			$this->addHook('ThemeEndHead', 'ThemeEndHead');
			$this->addHook('ThemeEndBody', 'ThemeEndBody');

			$this->addHook('Testimonials', 'Testimonials');

		}


		public function ThemeEndHead() { ?>
			<link rel="stylesheet" href="<?php echo PLX_PLUGINS ?>Testimonials/app/owl-carousel/owl.carousel.css">

			<?php
		}



		public function AdminTopEndHead() { ?>
			<link rel="stylesheet" href="<?php echo PLX_PLUGINS ?>Testimonials/app/style.css" media="screen"/>
			<?php
		}


		public function Testimonials() {

			$nbcommentaire = floor(sizeof($this->aParams)/2); // nombre de commentaires

			$nbcommentaire = $nbcommentaire + 1;?>


			<div id="slider" class="owl-carousel ">

			<?php
		
			for($i=1; $i<$nbcommentaire; $i++) { // boucle pour afficher les commentaires

				$auteur = $this->getParam('auteur'.$i);
				$commentaire = $this->getParam('commentaire'.$i);
				$projet = $this->getParam('projet'.$i);

				if(!empty($auteur)) { // si le champ auteur et vide 
					echo '<div><p>'.$commentaire.'</p><p>'.$auteur.', projet : '.$projet.'</p></div>';
				}			
			} ?>

			</div> 

			<?php
		}	

		
		public function ThemeEndBody() { ?>

			<script type="text/javascript">
			/* <![CDATA[ */
			   if(typeof(jQuery) === "undefined") document.write(\'<script  type="text/javascript" src="<?php echo PLX_PLUGINS; ?>Testimonials/app//owl-carousel/jquery-1.9.1.min.js""><\/script>\');
			/* !]]> */
			</script>
			<script src="<?php echo PLX_PLUGINS ?>Testimonials/app//owl-carousel/owl.carousel.min.js"></script>
			

		<script>
			$(document).ready(function() {
 
			  $("#slider").owlCarousel({
			 
			      navigation : false, // Show next and prev buttons
			      slideSpeed : 300,
			      paginationSpeed : 100,
			      singleItem: true,
			      autoPlay: true,
			      transitionStyle : "fade"
			 
			  });
			 
			});
    	</script>
			<?php
		}		

	
	} // class Testimonials

?>