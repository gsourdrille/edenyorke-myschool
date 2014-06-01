<?php /*
  @filename     : form-inscriptionecole.php
  @description  : Fragment PHP contenant le code HTML du formulaire
  @author       : Trésor ILOYI
  @date         : JUIN 2014

	// ---- VARIABLES BLOC CONTACT --------------------- */
?>

  <div id="demandeInscriptionFormDiv" class="wrap">
    <form id="demandeInscriptionForm" action="/core/controller/demande_inscription_controller.php" method="post">
      <h2 class="form-title">Inscription Etablissement</h2>
      <ul>
        <li>
          <input type="text" name="nom_etablissement" placeholder="Nom de l'établissement" value="" />
          <span id="error_demande_nom_etablissement" class="form-error" style="display:none"></span>
        </li>
        <li>
          <input type="text" name="username" placeholder="Adresse email" value="" />
          <span id="error_demande_login" class="form-error" style="display:none"></span>
        </li>
        <li>
          <input type="password" name="password" placeholder="Mot de passe" value="" />
          <input type="password" name="password_bis" placeholder="Répeter mot de passe" value="" />
          <span id="error_demande_mdp" class="form-error" style="display:none"></span>
        </li>
        <li>
          <input type="text" name="nom" placeholder="Nom" value="" />
          <span id="error_demande_nom" class="form-error" style="display:none"></span>
        </li>
        <li>
          <input type="text" name="prenom" placeholder="Prénom" value="" />
          <span id="error_demande_prenom" class="form-error" style="display:none"></span>
        </li>
        <li>
          <input type="text" name="numeroTelephone" placeholder="Numero de téléphone" value="" />
          <span id="error_demande_tel" class="form-error" style="display:none"></span>
        </li>
        <li class="user-actions">
          <a href="#dev" onclick="hideDemandeInscriptionBox();" >connexion</a>
          <button type="button" id="envoyerDemandeInscription" onclick="demandeInscription()">Inscrire l'établissement</button>
        </li>
      </ul>
      <span id="error_demande_generale" class="form-error" style="display:none"></span>
    </form>
  </div>
