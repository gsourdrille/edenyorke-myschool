<div id="forgotFormDiv">
	<form id="forgotForm" action="/core/controller/forgot_password_controller.php" method="post">
		<div class="forgot_text">
			Mode de passe oublié
		</div>
		<div class="formulaireInput">
			<input class="buttonForm" type="text" name="username" value="" placeholder="Adresse email"/>
		</div>
		<div id="error_forgot_general" class="error_formulaire" style="display:none"></div>
		<div class="login_footer">
			<div id="button_login">
				<input id="envoyerDemandePassword" class="loginButton" type="button" onclick="demandeNouveauMotDePasse()"value="Envoyer">
					<div id="error_forgot_general"></div>
			</div>
			<div class="login_tools">
				<div class="inscription_link">
					<a href="#dev" onclick="hideForgotBox();" >connexion</a>
				</div>
			</div>
		</div>
	</form>
</div>
