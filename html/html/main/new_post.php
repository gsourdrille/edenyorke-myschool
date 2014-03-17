
<?php include($_SERVER['DOCUMENT_ROOT']."/core/controller/new_posts_controller.php")?>
<?php if($_SESSION['TYPE_UTILISATEUR']== TypeUtilisateur::DIRECTION || $_SESSION['TYPE_UTILISATEUR']== TypeUtilisateur::ENSEIGNANT){?>
	<div id="link_new_post">
		<a href="#dev" onClick="openNewPost()">Nouveau post</a>
	</div>
<?php }?>
<form id="postForm" action="/core/controller/create_post_controller.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="action" value="CREATE"/>
	<div id="zone_new_post">
		<div id="step1">
			<div>
				<div style="width:310px; height:140px ;float:left">
					<textarea name="newPostArea" id="newPostArea"></textarea>
				</div>
				<div style="width:180px; float:left; margin-left:10px;height:175px">
					<select multiple id="selectRight" name=listPostDestinaires[]>
						<option value="ALL">Etablissement</option>
						<?php 
							foreach ($listeDroitsPost as $idNiveau => $listeClasses){
								$niveau = null;
								foreach ($listeNiveaux as $tmpNiveau){
									if($tmpNiveau->idNiveau == $idNiveau){
										$niveau = $tmpNiveau;
									}
								}
							
						      	echo "<optgroup label='$niveau->nom'>";
						      	echo "<option value='NIVEAU_$niveau->idNiveau'>Tous</option>";
						      	foreach ($listeClasses as $classe){
									echo "<option value='CLASSE_$classe->idClasse'>$classe->nom</option>";
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
		<div id="enableComment">
			<label for="allowComment">Ouvert aux commentaires : </label>
			<input id="allowCommentNew" name="allowComment" type="checkbox" checked />
			<label for="onlyEnseignant">Seulement aux enseignants : </label>
			<input id="onlyEnseignantNew" name="onlyEnseignant" type="checkbox"  />
		</div>
			
		<div id="postAddPj">
			<div id="listeFilePreview"></div>
			<label for="uploadInput">Ajouter un fichier : </label>
			<div id="upload_file" >Charger</div>
			<div id="postFileId"></div>
		</div>
		<div id="post_error" class="error_general"></div>
	</div>
</form>

