<div id="forgotFormDiv">
	<form id="forgotForm" action="/myschool/core/controller/forgot_password_controller.php" method="post">
		<div class="forgot_text">
			Mode de passe oublié
		</div>
		<div class="loginInput">
			<input class="loginForm" type="text" name="username" value="<?php if(isset($username)){echo $username;}?>" placeholder="Adresse email"/>
		</div>
		<div class="login_footer">
			<div id="button_login">
				<input id="envoyerDemandePassword" class="loginButton" type="submit" value="Envoyer">
					<div id="error_forgot"></div>
			</div>
			<div class="login_tools">
				<div class="inscription_link">
					<a href="#dev" onclick="hideForgotBox();" >connexion</a>
				</div>
			</div>
		</div>
	</form>
</div>
