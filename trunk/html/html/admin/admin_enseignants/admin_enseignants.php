<div id="current_admin_page">
	<div id="center_admin_conteneur">
		<div class="floatleft">
			<div>Enseignants :</div> 
			<select id="liste_enseignants" size="20"  onclick="loadEnseignants()">
				<?php  foreach ($listeEnseignants as $selectEnseignant){
					$selected = false;
					if(isset($_SESSION['ENSEIGNANT_SELECTED']) && $_SESSION['ENSEIGNANT_SELECTED'] == $selectEnseignant->idUser){
						$selected = true;
					}
					echo "<option value='$selectEnseignant->idUser' ";
					if($selected){
						echo "selected=selected";
					}  
					echo ">$selectEnseignant->nom $selectEnseignant->prenom</option>";
					}?>
			</select>
			<form action="/myschool/core/controller/admin_enseignants_controller.php" method="post">
				<div id="button_submit_infos">
					<input type="submit" name="showAddEnseignant" value="Ajouter">
				</div>
			</form>
			</div>
		<div class="floatleft">
			<?php  if(isset($showEnseignant) && $showEnseignant){?>
			<form action="/myschool/core/controller/admin_enseignants_controller.php" method="post">
				<input type="hidden" name="idEnseignant"  value="<?php if(isset($_SESSION['ENSEIGNANT_SELECTED'])){echo $_SESSION['ENSEIGNANT_SELECTED'];}?>"/>
				<div id="nom_info">
					<label for="name">Nom : </label>
					<input type="text" name="nom" value="<?php if(isset($nom)){echo $nom;}else{echo $enseignant->nom;}?>"/>
					<?php if(isset($error_nom)){?>
					<div id="error_login">
						<?php echo $error_nom;?>
					</div>
					<?php }?>
				</div>
				<div id="prenom_info">
					<label for="prenom">Prénom : </label>
					<input type="text" name="prenom" value="<?php if(isset($prenom)){echo $prenom;}else{echo $enseignant->prenom;}?>"/>
					<?php if(isset($error_prenom)){?>
					<div id="error_login">
						<?php echo $error_prenom;?>
					</div>
					<?php }?>
				</div>
				<div id="login_info">
					<label for="prenom">Login : </label>
					<input type="text" name="login" value="<?php if(isset($login)){echo $login;}else{echo $enseignant->login;}?>"/>
					<?php if(isset($error_login)){?>
					<div id="error_login">
						<?php echo $error_login;?>
					</div>
					<?php }?>
				</div>
				
				<div id="mdp_info">
					<label for="mdp">Mot de passe : </label>
					<input type="password" name="mdp" value=""/>
					<?php if(isset($error_password)){?>
					<div id="error_login">
						<?php echo $error_password;?>
					</div>
					<?php }?>
				</div>  
				<div id="mdp_bis_info">
					<label for="mdp_bis">Repeter mot de passe : </label>
					<input type="password" name="mdpBis" value=""/>
				</div>
				<div id="button_submit_infos">
					<input type="submit" name="saveEnseignant" value="Sauvegarder" onclick='selectAllClasses()'>
				</div>
				<?php if(isset($enseignant->idUser)){?>
					<div id="button_submit_infos">
						<input type="submit" name="deleteEnseignant" value="Supprimer">
					</div>
					<?php }?>
				<?php if(isset($succes)){
				?>
				<div id="error_login">
						<?php echo $succes;?>
				</div>
				<?php }?>
				 <br/>    
				  <div class="floatleft">    
					  <fieldset>
					 
					    <select name="selectClassefrom[]" id="select-classe-from" multiple size="15">
					      <?php foreach ($listeClasseAndNiveau as $niveau => $listeClasses){
					      	echo "<optgroup label='$niveau'>";
					      	
					      	foreach ($listeClasses as $classe){
								echo "<option value='$classe->idClasse'>$classe->nom</option>";
							}
					      	echo "</optgroup>";
						}?>
					    </select>
					 
					    <a href="JavaScript:void(0);" id="btn-add-classe">Add &raquo;</a>
					    <a href="JavaScript:void(0);" id="btn-remove-classe">&laquo; Remove</a>
					 
					    <select name="selectClasseto[]" id="select-classe-to" multiple size="15">
					      <?php foreach ($listeClasseSelected as $classeSelected){
					      		echo "<option value='$classeSelected->idClasse'>$classeSelected->nom</option>";
								}	?>
					    </select>
					 
					  </fieldset>
				  </div>
			</form>	
			<?php }?>
		</div>
	</div>
</div>