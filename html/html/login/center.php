<div id="center_conteneur">
	<form action="/myschool/core/controller/login_controller.php" method="post">
		<div id="user_login">
			<label for="username">Identifiant : </label>
			<input type="text" name="username" value="<?php if(isset($username)){echo $username;}?>"/>
		</div>
		<div id="pass_login">
			<label for="password">Mot de passe : </label>
			<input type="password" name="password" value="<?php if(isset($password)){echo $password;}?>"/>
		</div>
		<div id="button_login">
			<input type="submit" value="Connexion">
		</div>
		<div id="remember_me">
			Se souvenir de moi <input type="checkbox">
		</div>
		<?php if(isset($error)){?>
		<div id="error_login">
			<?php echo $error;?>
		</div>
		<?php }?>
	</form>
	
</div>