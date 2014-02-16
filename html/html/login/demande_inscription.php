<div id="demandeInscriptionFormDiv">
	<form id="demandeInscriptionForm" action="/myschool/core/controller/demande_inscription_controller.php" method="post">
		<div class="connexion_text" style="margin-left:60px">
			Inscription Etablissement
		</div>
		<div class="loginInput">
			<input class="buttonForm" type="text" name="nom_etablissement" value="" placeholder="Nom de l'établissement"/>
		</div>
		<div id="error_demande_nom_etablissement" class="error_formulaire" style="display:none"></div>
		<div class="loginInput">
			<input class="buttonForm" type="text" name="username" value="" placeholder="Adresse email"/>
		</div>
		<div id="error_demande_login" class="error_formulaire" style="display:none"></div>
		<div class="loginInput">
			<input class="buttonForm" type="password" name="password" value="" placeholder="Mot de passe"/>
		</div>
		<div id="error_demande_mdp" class="error_formulaire" style="display:none"></div>
		<div class="loginInput">
			<input class="buttonForm" type="password" name="password_bis" value="" placeholder="Répeter mot de passe"/>
		</div>
		<div class="loginInput">
			<input class="buttonForm" type="text" name="nom" value="" placeholder="Nom"/>
		</div>
		<div id="error_demande_nom" class="error_formulaire" style="display:none"></div>
		<div class="loginInput">
			<input class="buttonForm" type="text" name="prenom" value="" placeholder="Prénom"/>
		</div>
		<div id="error_demande_prenom" class="error_formulaire" style="display:none"></div>
		<div class="loginInput">
			<input class="buttonForm" type="text" name="numeroTelephone" value="" placeholder="Numero de téléphone"/>
		</div>
		<div id="error_demande_tel" class="error_formulaire" style="display:none"></div>
		<div class="login_footer">
			<div id="button_login">
				<input id="envoyerDemandeInscription" class="loginButton" type="button" onclick="demandeInscription()" value="Envoyer">
			</div>
			<div class="login_tools">
				<div class="inscription_link">
					<a href="#dev" onclick="hideDemandeInsciptionBox();" >connexion</a>
				</div>
			</div>
		</div>
		<div id="error_demande_generale" class="error_formulaire" style="display:none"></div>
	</form>
</div>
