
<?php include($_SERVER['DOCUMENT_ROOT']."/core/controller/new_posts_controller.php")?>
<div id="link_new_post">
	<a href="#dev" onClick="openNewPost()">Nouveau post</a>
</div>
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
			<input name="allowComment" type="checkbox" checked />
		</div>
		<div id="postAddPj">
			<label for="addfile">Ajouter un fichier : </label>
			<input name="postfile[]" type="file" />
			<button id="add_more">+</button>
		</div>
	</div>
</form>

