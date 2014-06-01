
	<div id="main" class="access">
		<?php if (isset($validInscription)){
			if ($validInscription){?>
				<div id="succes_valid_message" class="valid_message" >Inscription validée</div>
			<?php }else{?>
				<div id="error_valid_message" class="valid_message" >Inscription non valide</div>
		<?php }
			}?>
    
		<div id="area-login" class="form-wrapper">
			<?php include("form-login.php"); ?>
		</div>
    
    <div id="area-forgot" class="form-wrapper">
			<?php include("form-forgotpassword.php"); ?>
		</div>
    
    <div id="area-forgotsuccess" class="form-wrapper">
				<?php include("success-forgotpassword.php"); ?>
		</div>
    
    <div id="area-register" class="form-wrapper">
			<?php include("form-inscription.php"); ?>
		</div>
    
    <div id="area-registersuccess" class="form-wrapper">
			<?php include("success-inscription.php");?>
		</div>
  
    <div id="area-registerschool" class="form-wrapper">
			<?php include("form-inscriptionecole.php");?>
		</div>
    
    <div id="area-registerschoolsuccess" class="form-wrapper">
			<?php include("success-inscriptionecole.php")?>
		</div>
	</div> 

