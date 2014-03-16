<?php 
@session_start();
include($_SERVER['DOCUMENT_ROOT']."/core/controller/admin_liste_classe_controller.php")?>
<form id="ajoutClasseUserForm" action="/core/controller/admin_infos_controller.php" method="POST">
	<fieldset>
		<legend>Classes Associées</legend>
		<div id="listeClasseUser">
			<select name="selectClasse[]" id="select-classe" multiple size="5">
				<?php foreach ($listeClasse as $classe){
						echo "<option value='$classe->idClasse'>$classe->nom</option>";
						}	?>
		  </select>
		  <div id="deleteClasseZone">
		  	<input type="button" value="supprimer" onclick="deleteClasse();"/>
		  </div>
	  </div>
	  <div id="ajoutClasseZone">
		  <input type="button" value="ajouter" onclick="addClasse();"/>
		  <input type="text" name="code"/>
	  </div>	
	</fieldset>
</form>