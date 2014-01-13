	<form action="/myschool/core/controller/inscription_controller.php" method="post">
		<div id="connexion_text">
			Inscription
		</div>
		<div class="loginInput">
			<input class="loginForm" type="text" name="username" value="<?php if(isset($username)){echo $username;}?>" placeholder="Adresse email"/>
		</div>
		<div class="loginInput">
			<input class="loginForm" type="password" name="password" value="<?php if(isset($password)){echo $password;}?>" placeholder="Mot de passe"/>
		</div>
		<div class="loginInput">
			<input class="loginForm" type="password" name="password_bis" value="<?php if(isset($password_bis)){echo $password_bis;}?>" placeholder="Répeter mot de passe"/>
		</div>
		<div class="loginInput">
			<input class="loginForm" type="text" name="nom" value="<?php if(isset($nom)){echo $nom;}?>" placeholder="Nom"/>
		</div>
		<div class="loginInput">
			<input class="loginForm" type="text" name="prenom" value="<?php if(isset($prenom)){echo $prenom;}?>" placeholder="Prénom"/>
		</div>
		<div class="loginInput">
			<input class="loginForm" type="text" name="code" value="<?php if(isset($code)){echo $code;}?>" placeholder="Code classe"/>
		</div>
		<div class="login_footer">
			<div id="button_login">
				<input class="loginButton" type="submit" value="Envoyer">
			</div>
			<div class="login_tools">
				<div class="inscription_link">
					<a href="#dev" onclick="hideInsciptionBox();" >connexion</a>
				</div>
			</div>
		</div>
	</form>
