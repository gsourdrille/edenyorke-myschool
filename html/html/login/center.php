	<form action="/myschool/core/controller/login_controller.php" method="post">
		<div id="connexion_text">
			Connexion
		</div>
		<div id="user_login">
			<input class="loginForm" type="text" name="username" value="<?php if(isset($username)){echo $username;}?>" placeholder="Identifiant"/>
		</div>
		<div id="pass_login">
			<input class="loginForm" type="password" name="password" value="<?php if(isset($password)){echo $password;}?>" placeholder="Mot de passe"/>
		</div>
		<div class="login_footer">
			<div id="button_login">
				<input class="loginButton" type="submit" value="Connexion">
			</div>
			<div class="login_tools">
				<div id="remember_me">
					Se souvenir de moi <input type="checkbox">
				</div>
				<div class="inscription_link">
					<a href="" >inscription</a>
				</div>
			</div>
		</div>
		<?php if(isset($error)){?>
		<div id="error_login">
			<?php echo $error;?>
		</div>
		<?php }?>
	</form>
