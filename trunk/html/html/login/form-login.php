<?php /*
  @filename     : form-login.php
  @description  : Fragment PHP contenant le code HTML du formulaire de LOGIN
  @author       : Trésor ILOYI
  @date         : JUIN 2014

	// ---- VARIABLES BLOC CONTACT --------------------- */
?>
  <div class="wrap">
    <form id="loginForm" action="/core/controller/login_controller.php" method="post">
      <h2 class="form-title">Connexion</h2>
      <ul>
        <li>
          <input type="text" name="username" placeholder="Adresse email" value="" />
        </li>
        <li>
          <input type="password" name="password" placeholder="Mot de passe" value="" />
        </li>
        <li class="user-actions">
          <span class="rememberme">
            <input type="checkbox" id="remember" name="autologin" />
            <label for="remember">Se souvenir de moi</label>
          </span>

          <button type="button" class="loginButton" onclick="login()">Se connecter</button>         
        </li>
      </ul>
      <span id="error_login_general" class="form-error" style="display:none"></span>
    </form>
    <div class="user-tools">
      <button type="button" onclick="showForgotBox();"><span>Mot de passe oublié ?</span></button>
      <button type="button" onclick="showInscriptionBox();"><span>S'inscrire à LiveSchool</span></button>
    </div>
  </div>

	<div id="demande_inscription" class="demande_inscription_link">
		<a href="#dev" onclick="showDemandeInscriptionBox();" >Inscrire votre établissement</a>
	</div>