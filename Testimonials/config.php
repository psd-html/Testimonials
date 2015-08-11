<?php 

if(!defined('PLX_ROOT')) exit;

# Control du token du formulaire
plxToken::validateFormToken($_POST);

# nombre de commentaires existants
$nbcommentaire = floor(sizeof($plxPlugin->getParams())/2);

if(!empty($_POST)) {

	if (!empty($_POST['auteur-new']) AND !empty($_POST['commentaire-new']) AND !empty($_POST['projet-new']))  {

        # création d'un nouveau commentaire
        $newcommentaire = $nbcommentaire + 1;

		$plxPlugin->setParam('auteur'.$newcommentaire, plxUtils::strCheck($_POST['auteur-new']), 'cdata');
		$plxPlugin->setParam('commentaire'.$newcommentaire, plxUtils::strCheck($_POST['commentaire-new']), 'cdata');
		$plxPlugin->setParam('projet'.$newcommentaire, plxUtils::strCheck($_POST['projet-new']), 'string');

        $plxPlugin->saveParams();
        
	}else{
        
        # Mise à jour des commentaires existants
        for($i=1; $i<=$nbcommentaire; $i++) {
            if($_POST['delete'.$i] != "1" AND !empty($_POST['auteur'.$i]) AND !empty($_POST['commentaire'.$i]) AND !empty($_POST['projet'.$i])){ // si on ne supprime pas et que les commentaires ne sont pas vide
                
                #mise a jour du auteur et commentaire
                $plxPlugin->setParam('auteur'.$i, plxUtils::strCheck($_POST['auteur'.$i]), 'cdata');
                $plxPlugin->setParam('commentaire'.$i, plxUtils::strCheck($_POST['commentaire'.$i]), 'cdata');
                $plxPlugin->setParam('projet'.$i, plxUtils::strCheck($_POST['projet'.$i]), 'string');
                $plxPlugin->saveParams();
            
            }elseif($_POST['delete'.$i] == "1"){
                $plxPlugin->setParam('auteur'.$i, '', '');
                $plxPlugin->setParam('commentaire'.$i, '', '');
                $plxPlugin->setParam('projet'.$i, '', '');
                $plxPlugin->saveParams();
            }
        }
    }
}

# mise à jour du nombre de commentaires existants
	$nbcommentaire = floor(sizeof($plxPlugin->getParams())/2);
?>

<!-- navigation sur la page configuration du plugin -->
<nav id="tabby-1" class="tabby-tabs" data-for="example-tab-content">
	<ul>
		<li><a data-target="tab1" class="active" href="#">Les témoignages</a></li>
		<li><a data-target="tab2" href="#">Ajouter un témoignage</a></li>
		<li><a data-target="tab3" href="#">Information</a></li>
	</ul>
</nav>

<!-- contenu de la page configuration -->
<div class="tabby-content" id="example-tab-content">


<!-- page pour afficher les témoignages -->
<div data-tab="tab1">

    <h2><?php echo $plxPlugin->getInfo("description") ?></h2>

    <div class="formulaire">
        <!-- commentaires déja créés -->
        <form action="parametres_plugin.php?p=Testimonials" method="post">
            <fieldset>
                <table class="full-width">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Auteur</th>
                            <th>Commentaire</th>
                            <th>Projet</th>
                            <th class="checkbox">Effacer</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php for($i=1; $i<=$nbcommentaire; $i++) {?>
                        <?php $auteur = $plxPlugin->getParam(auteur.$i);
                        if(!empty($auteur)) { ?>
                        
                        <tr class="line-<?php echo $i%2 ?>">
                            <td class="id">
                                <?php echo $i; ?>
                            </td>
                            
                            <td class="auteur">
                                <input type="text"  name="auteur<?php echo $i; ?>" value="<?php echo $plxPlugin->getParam(auteur.$i) ?>" />
                            </td>
                            
                            <td class="temoignage">
                                <textarea rows="2"   name="commentaire<?php echo $i; ?>"><? echo $plxPlugin->getParam(commentaire.$i); ?></textarea>
                            </td>
                            
                            <td class="projet">
                                <input type="text" class="projet" name="projet<?php echo $i; ?>" value="<?php echo $plxPlugin->getParam(projet.$i) ?>" />
                            </td>
                            
                            <td class="checkbox">
                                <input type="checkbox" name="delete<?php echo $i; ?>" value="1">
                            </td>
                        </tr>
                            <?php }; ?>
                                <?php }; ?>
                    </tbody>

                </table>
            </fieldset>

                    <p class="in-action-bar">
                        <?php echo plxToken::getTokenPostMethod() ?>
                        <input class="bt" type="submit" name="submit" value="Mettre à jour" />
                    </p>
        </form>
    </div>

</div><!-- de la premiere page -->

<!-- page pour créer un témoignage -->
<div data-tab="tab2">

<h2>Ajouter un nouveau témoignage</h2>

<div class="new">

    <form action="parametres_plugin.php?p=Testimonials" method="post">
        <p>
            <label for="auteur">Nom de l'auteur:</label>
             <input type="text" name="auteur-new" value="" />
        </p>
        
        <p>
            <label for="commentaire">Le témoignage de l'auteur:</label>
            <textarea rows="8"   name="commentaire-new" value=""></textarea>
        </p>
        
        <p>
            <label for="projet">Le projet:</label>
            <input type="text" name="projet-new" value="" />
        </p>                                                                  
                       
        <p class="in-action-bar">
            <?php echo plxToken::getTokenPostMethod() ?>
            <input class="bt" type="submit" name="submit" value="Sauvegarder" />
        </p>

    </form>
</div>

</div><!-- fin de la page 2 -->

<div data-tab="tab3">
    <h2>information</h2>
    <p>Pour afficher le plugin, il suffit de placer sur code dans votre template</p>
    <br>
    <code>&lt;?php eval($plxShow->callHook('Testimonials')); ?&gt;</code>
    <br>
    <p>Si vous avez des questions, merci de me contacter sur mon site: <a href="http://libertea.fr">http://libertea.fr</a></p>
</div>


</div>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?php echo PLX_PLUGINS ?>Testimonials/app/jquery.tabby.js"></script>
<script>
    $(document).ready(function(){
        $('#tabby-1').tabby();
    });
</script>
