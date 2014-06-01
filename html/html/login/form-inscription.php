<?php /*
  @filename     : form-inscription.php
  @description  : Fragment PHP contenant le code HTML du formulaire "INSCRIPTION"
  @author       : Trésor ILOYI
  @date         : JUIN 2014

	// ---- VARIABLES BLOC CONTACT --------------------- */
?>

  <div id="wrapper-formregister" class="wrap">
    <form id="inscriptionForm" action="/core/controller/inscription_controller.php" method="post">
      
      <div id="error_inscription_general" class="form-error" style="display:none"></div>
      
      <h2 class="form-title">Inscription</h2>
      
      <ul>
        <li>
          <input type="text" name="username" placeholder="Adresse email" value="" />
          <span id="error_inscription_login" class="form-error" style="display:none"></span>
        </li>
        <li>
          <input type="password" name="password" placeholder="Mot de passe" value="" />
          <input type="password" name="password_bis" value="" placeholder="Répeter mot de passe"/>
          <span id="error_inscription_mdp" class="form-error" style="display:none"></span>
        </li>
        <li>
          <input type="text" name="nom" value="" placeholder="Nom" />
          <span id="error_inscription_nom" class="form-error" style="display:none"></span>
        </li>
        <li>
          <input type="text" name="prenom" value="" placeholder="Prénom" />
          <span id="error_inscription_prenom" class="form-error" style="display:none"></span>
        </li>
        <li>
          <input class="buttonForm" type="text" name="code" value="" placeholder="Code classe"/>
          <span id="error_inscription_code" class="form-error"></span>
        </li>
        <li class="user-actions">
          <a href="#dev" onclick="hideInscriptionBox();">connexion</a>
          <button type="button" id="envoyer" onclick="inscription()">S'inscrire</button>
        </li>
      </ul>
    </form>
  </div>
