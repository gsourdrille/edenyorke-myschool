
<?php include($_SERVER['DOCUMENT_ROOT']."/myschool/core/controller/new_posts_controller.php")?>
<div id="link_new_post">
	<a href="#dev" onClick="openNewPost()">Nouveau post</a>
</div>
<div id="zone_new_post">
	<div id="step1">
		<div>
			<div style="width:310px; height:140px ;float:left">
				<textarea name="newPostArea" id="newPostArea"></textarea>
			</div>
			<div style="width:180px; float:left; margin-left:10px;height:175px">
				<select multiple id="selectRight">
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
			<input type="button" onClick="submit()" value="Envoyer">
		</div>
	</div>
	<div id="postAddPj">
		<label for="addfile">Ajouter un fichier : </label>
		<input name="postfile[]" type="file" />
		<button id="add_more">+</button>
	</div>
</div>


