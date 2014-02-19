<div id="left_admin_conteneur">
	<div id="left_admin">
	
	
		<ul>
			<li><a href="/core/controller/admin_infos_controller.php"> Infos personnelles</a></li>
			<?php if($_SESSION['TYPE_UTILISATEUR'] == Type_Utilisateur::DIRECTION){?>
				<li><a href="/core/controller/admin_etablissement_controller.php">Etablissement</a></li>
				<li><a href="/core/controller/admin_niveaux_controller.php">Niveaux & Classes</a></li>
				<li><a href="/core/controller/admin_enseignants_controller.php">Enseignants</a></li>
				<li><a href="/core/controller/admin_eleves_controller.php">Elèves</a></li>
			<?php }?>
		</ul>
	</div>
</div>    