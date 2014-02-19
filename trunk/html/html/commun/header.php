<?php
?>
<div id="header_content">
	<div id="liveschool">
		<a href="/core/controller/tableau_controller.php">
		LiveSchool
		</a>
	</div>
	<div id="school_name">
		<a href="/core/controller/tableau_controller.php">
			<?php echo $etablissement->nom;?> - <?php  echo $etablissement->codePostal;?> <?php echo $etablissement ->ville;?>
		</a>
	</div>
	<div id="mail">
		<img alt="" src="/html/images/icon_mail.png"  class="icon_mail"/>
	</div>
	<div id="user">
		<a href="/core/controller/admin_infos_controller.php">
			
			<?php if ($utilisateur->avatar!=null){?>
					<img src="/core/controller/thumb_controller.php?src=<?php echo FileUtils::getUtilisateurAvatar($utilisateur);?>&x=100&y=100&f=0 " class="icon_user">
				<?php }else{?>
					<img src="/html/images/icon_user.png" class="icon_user">  
				<?php }?>
			<?php echo $utilisateur->prenom; ?> <?php echo $utilisateur->nom?>		
		</a>
	</div>
	<div id="disconnect">
		<a href="/html/html/login/index.php">deconnection</a>
	</div>
</div>