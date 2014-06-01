<?php /*
  @filename     : form-forgotpassword.php
  @description  : Fragment PHP contenant le code HTML du formulaire "MOT DE PASSE OUBLIE"
  @author       : Trésor ILOYI
  @date         : JUIN 2014

	// ---- VARIABLES BLOC CONTACT --------------------- */
?>

  <div id="forgotFormDiv" class="wrap">
    <form id="forgotForm" action="/core/controller/forgot_password_controller.php" method="post">
      <h2 class="form-title">Mode de passe oublié</h2>
      <ul>
        <li>
          <input type="text" name="username" placeholder="Adresse email" value="" />  
        </li>
        <li class="user-actions">
          <a href="#dev" onclick="hideForgotBox();">connexion</a>
          <button type="button" id="envoyerDemandePassword" onclick="demandeNouveauMotDePasse()">Envoyer</button>
        </li>

      </ul>
      <span id="error_forgot_general" class="form-error" style="display:none"></span>
    </form>
  </div>
