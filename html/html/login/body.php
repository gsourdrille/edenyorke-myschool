
	<div id="main_conteneur">
		<?php if (isset($validInscription)){
			if ($validInscription){?>
				<div id="succes_valid_message" class="valid_message" >Inscription validée</div>
			<?php }else{?>
				<div id="error_valid_message" class="valid_message" >Inscription non valide</div>
		<?php }
			}?>	
		<div id="login_conteneur">
			<?php include("login.php"); ?>
		</div>
		<div id="register_conteneur">
			<?php include("inscription.php"); ?>
		</div>
		<div id="inscription_succes">
			<div class="connexion_text">
				Félicitation !
			</div>
		</div>
	</div> 

