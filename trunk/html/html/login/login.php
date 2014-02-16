	<form id="loginForm" action="/myschool/core/controller/login_controller.php" method="post">
		<div class="connexion_text">
			Connexion
		</div>
		<div class="formulaireInput">
			<input class="buttonForm" type="text" name="username" value="" placeholder="Adresse email"/>
		</div>
		<div class="formulaireInput">
			<input class="buttonForm" type="password" name="password" value="" placeholder="Mot de passe"/>
		</div>
		<div id="error_login_general" class="error_formulaire" style="display:none"></div>
		<div class="login_footer">
			<div id="button_login">
				<input class="loginButton" value="Connexion" type="button" onclick="login()">
				<div class="forgot_link">
					<a href="#dev" onclick="showForgotBox();" >mot de passe oublié</a>
				</div>
			</div>
			
			<div class="login_tools">
				<div id="remember_me">
					Se souvenir de moi <input type="checkbox">
				</div>
				<div class="inscription_link">
					<a href="#dev" onclick="showInscriptionBox();" >inscription</a>
				</div>
			</div>
		</div>
		
	</form>
	<div id="demande_inscription" class="demande_inscription_link" >
		<a href="#dev" onclick="showDemandeInscriptionBox();" >Inscrire votre établissement</a>
	</div>