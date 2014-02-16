<div id="inscriptionFormDiv">
	<form id="inscriptionForm" action="/myschool/core/controller/inscription_controller.php" method="post">
		<div class="connexion_text">
			Inscription
		</div>
		<div class="formulaireInput">
			<input class="buttonForm" type="text" name="username" value="" placeholder="Adresse email"/>
		</div>
		<div id="error_inscription_login" class="error_formulaire" style="display:none"></div>
		<div class="formulaireInput">
			<input class="buttonForm" type="password" name="password" value="" placeholder="Mot de passe"/>
		</div>
		<div id="error_inscription_mdp" class="error_formulaire" style="display:none"></div>
		<div class="formulaireInput">
			<input class="buttonForm" type="password" name="password_bis" value="" placeholder="Répeter mot de passe"/>
		</div>
		<div class="formulaireInput">
			<input class="buttonForm" type="text" name="nom" value="" placeholder="Nom"/>
		</div>
		<div id="error_inscription_nom" class="error_formulaire" style="display:none"></div>
		<div class="formulaireInput">
			<input class="buttonForm" type="text" name="prenom" value="" placeholder="Prénom"/>
		</div>
		<div id="error_inscription_prenom" class="error_formulaire" style="display:none"></div>
		<div class="formulaireInput">
			<input class="buttonForm" type="text" name="code" value="" placeholder="Code classe"/>
		</div>
		<div id="error_inscription_code" class="error_formulaire"></div>
		<div class="login_footer">
			<div id="button_login">
				<input id="envoyer" type="button" class="loginButton" onclick="inscription()" value="Envoyer">
			</div>
			<div id="error_inscription_general" class="error_formulaire" style="display:none"></div>
			<div class="login_tools">
				<div class="inscription_link">
					<a href="#dev" onclick="hideInscriptionBox();" >connexion</a>
				</div>
			</div>
		</div>
	</form>
</div>
