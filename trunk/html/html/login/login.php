	<form action="/myschool/core/controller/login_controller.php" method="post">
		<div class="connexion_text">
			Connexion
		</div>
		<div class="loginInput">
			<input class="loginForm" type="text" name="username" value="<?php if(isset($username)){echo $username;}?>" placeholder="Adresse email"/>
		</div>
		<div class="loginInput">
			<input class="loginForm" type="password" name="password" value="<?php if(isset($password)){echo $password;}?>" placeholder="Mot de passe"/>
		</div>
		<div class="login_footer">
			<div id="button_login">
				<input class="loginButton" type="submit" value="Connexion">
				<?php if(isset($error)){?>
					<div id="error_login">
				<?php echo $error;?>
					</div>
				<?php }?>
			</div>
			<div class="login_tools">
				<div id="remember_me">
					Se souvenir de moi <input type="checkbox">
				</div>
				<div class="inscription_link">
					<a href="#dev" onclick="showInsciptionBox();" >inscription</a>
				</div>
			</div>
		</div>
		
	</form>
	<div id="demande_inscription" class="demande_inscription_link" >
		<a href="#dev" onclick="showDemandeInsciptionBox();" >Inscrire votre établissement</a>
	</div>