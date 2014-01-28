<div id="demandeInscriptionFormDiv">
	<form id="demandeInscriptionForm" action="/myschool/core/controller/demande_inscription_controller.php" method="post">
		<div class="connexion_text" style="margin-left:60px">
			Inscription Etablissement
		</div>
		<div class="loginInput">
			<input class="loginForm" type="text" name="nom_etablissement" value="" placeholder="Nom de l'établissement"/>
		</div>
		<div class="loginInput">
			<input class="loginForm" type="text" name="username" value="" placeholder="Adresse email"/>
		</div>
		<div class="loginInput">
			<input class="loginForm" type="password" name="password" value="" placeholder="Mot de passe"/>
		</div>
		<div class="loginInput">
			<input class="loginForm" type="password" name="password_bis" value="" placeholder="Répeter mot de passe"/>
		</div>
		<div class="loginInput">
			<input class="loginForm" type="text" name="nom" value="" placeholder="Nom"/>
		</div>
		<div class="loginInput">
			<input class="loginForm" type="text" name="prenom" value="" placeholder="Prénom"/>
		</div>
		<div class="loginInput">
			<input class="loginForm" type="text" name="numeroTelephone" value="" placeholder="Numero de téléphone"/>
		</div>
		<div class="login_footer">
			<div id="button_login">
				<input id="envoyerDemandeInscription" class="loginButton" type="submit" value="Envoyer">
					<div id="error_demande_inscription"></div>
			</div>
			<div class="login_tools">
				<div class="inscription_link">
					<a href="#dev" onclick="hideDemandeInsciptionBox();" >connexion</a>
				</div>
			</div>
		</div>
	</form>
</div>
