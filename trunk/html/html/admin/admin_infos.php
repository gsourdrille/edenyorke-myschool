
<form action="/myschool/core/controller/admin_infos_controller.php" method="post">
		<input type="hidden" name="action" value="updateInfos"/>
		<div id="nom_info">
			<label for="name">Nom : </label>
			<input type="text" name="nom" value="<?php if(isset($nom)){echo $nom;}else{echo $utilisateur->nom;}?>"/>
			<?php if(isset($error_nom)){?>
			<div id="error_login">
				<?php echo $error_nom;?>
			</div>
			<?php }?>
		</div>
		<div id="prenom_info">
			<label for="prenom">Prénom : </label>
			<input type="text" name="prenom" value="<?php if(isset($prenom)){echo $prenom;}else{echo $utilisateur->prenom;}?>"/>
			<?php if(isset($error_prenom)){?>
			<div id="error_login">
				<?php echo $error_prenom;?>
			</div>
			<?php }?>
		</div>
		<div id="login_info">
			<label for="prenom">Login : </label>
			<input type="text" name="login" value="<?php if(isset($login)){echo $login;}else{echo $utilisateur->login;}?>"/>
			<?php if(isset($error_login)){?>
			<div id="error_login">
				<?php echo $error_login;?>
			</div>
			<?php }?>
		</div>
		
		<div id="ancien_mdp_info">
			<label for="ancien_mdp">Ancien mot de passe : </label>
			<input type="password" name="ancien_mdp" value=""/>
			<?php if(isset($error_password)){?>
			<div id="error_login">
				<?php echo $error_password;?>
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
			<input type="submit" value="Sauvegarder">
		</div>
		<?php if(isset($error)){?>
		<div id="error_login">
			<?php echo $error;?>
		</div>
		<?php }?>
	</form>