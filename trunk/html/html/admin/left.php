<?php include_once ($_SERVER['DOCUMENT_ROOT']."/core/bean/TypeUtilisateur.php");?>
<div id="left_admin_conteneur">
	<div id="left_admin">
	
	
		<ul>
			<li><a href="/moncompte"> Infos personnelles</a></li>
			<?php if($_SESSION['TYPE_UTILISATEUR'] == TypeUtilisateur::DIRECTION){?>
				<li><a href="/etablissement">Etablissement</a></li>
				<li><a href="/classes">Niveaux & Classes</a></li>
				<li><a href="/enseignants">Enseignants</a></li>
				<li><a href="/eleves">Elèves</a></li>
			<?php }?>
		</ul>
	</div>
</div>    