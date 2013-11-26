<div id="current_admin_page">
	<div id="center_conteneur">
		<div class="floatleft">
			Enseignant : 
			<select id="liste_enseignants" size="6"  onclick="loadEnseignants()">
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
		</div>
		<div class="floatright">
			<form action="/myschool/core/controller/admin_enseignants_controller.php" method="post">
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
				
				<div id="nouveau_mdp_info">
					<label for="nouveau_mdp">Nouveau mot de passe : </label>
					<input type="password" name="nouveau_mdp" value=""/>
				</div>
				<div id="nouveau_mdp_bis_info">
					<label for="nouveau_mdp_bis">Repeter nouveau mot de passe : </label>
					<input type="password" name="nouveau_mdp_bis" value=""/>
					<?php if(isset($error_new_password)){?>
					<div id="error_login">
						<?php echo $error_new_password;?>
					</div>
					<?php }?>
				</div>
				<div id="button_submit_infos">
					<input type="submit" name="saveClasse" value="Sauvegarder">
				</div>
				<?php if(isset($enseignant->idUser)){?>
					<div id="button_submit_infos">
						<input type="submit" name="deleteClasse" value="Supprimer">
					</div>
					<?php }?>
				<?php if(isset($succes)){
				?>
				<div id="error_login">
						<?php echo $succes;?>
				</div>
				<?php }?>
			</form>	
		</div>
	</div>
</div>