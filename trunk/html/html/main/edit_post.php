<form id="postForm" action="/myschool/core/controller/create_post_controller.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="idPost" value="<?php echo $post->idPost;?>"/>
	<input type="hidden" name="action" value="EDIT"/>
	<div id="zone_edit_post">
		<div id="step1">
			<div>
				<div style="width:310px; height:140px ;float:left">
					<textarea name="editPostArea" id="editPostArea<?php echo $post->idPost;?>"><?php echo $post->contenu;?></textarea>
				</div>
				<div style="width:180px; float:left; margin-left:10px;height:175px">
					<select multiple id="selectRight<?php echo $post->idPost;?>" name=listPostDestinaires[]>
						<?php 
						echo "<option value='ALL'";
						if(PostUtils::isInAssociation($post->associations, TypePost::ETABLISSEMENT, $_SESSION['ETABLISSEMENT_ID'])){
							echo " selected ";
						};
						echo ">Etablissement</option>";
							
						foreach ($listeDroitsPost as $idNiveau => $listeClasses){
							$niveau = null;
							foreach ($listeNiveaux as $tmpNiveau){
								if($tmpNiveau->idNiveau == $idNiveau){
									$niveau = $tmpNiveau;
								}
							}
						
					      	echo "<optgroup label='$niveau->nom'>";
					      	echo "<option value='NIVEAU_$niveau->idNiveau'";
							if(PostUtils::isInAssociation($post->associations, TypePost::NIVEAU, $niveau->idNiveau)){
							echo " selected ";
							};				      	
					      	echo ">Tous</option>";
					      	
					      	foreach ($listeClasses as $classe){
								echo "<option value='CLASSE_$classe->idClasse'";
								if(PostUtils::isInAssociation($post->associations, TypePost::CLASSE, $classe->idClasse)){
									echo " selected ";
								};
								echo ">$classe->nom</option>";
							}
					      	echo "</optgroup>";
						}?>
					</select>
				</div>
			</div>
			<div style="float:right; margin-right:10px">
				<input type="button" onClick="closeNewPost()" value="Annuler">
				<a href="#" id="envoyer">Envoyer</a>
			</div>
		</div>
		<div id="postAddPj">
			<label for="addfile">Ajouter un fichier : </label>
			<input name="postfile[]" type="file" />
			<button id="add_more">+</button>
		</div>
	</div>
</form>

