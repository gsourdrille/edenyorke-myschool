<?php
?>
<div id="header_content">
	<div id="myschool">
		MySchool
	</div>
	<div id="school_name">
		<div><?php echo $etablissement->nom;?> - <?php  echo $etablissement->codePostal;?> <?php echo $etablissement ->ville;?></div>
	</div>
	<div id="mail">
		<img alt="" src="/myschool/html/images/icon_mail.png"  class="icon_mail"/>
	</div>
	<div id="user">
		<a href="/myschool/core/controller/admin_infos_controller.php">
			
			<?php if ($utilisateur->avatar!=null){?>
					<img src="<?php echo FileUtils::getUtilisateurAvatar($utilisateur);?>" class="icon_user">
				<?php }else{?>
					<img src="/myschool/html/images/icon_user.png" class="icon_user">  
				<?php }?>
			<?php echo $utilisateur->prenom; ?> <?php echo $utilisateur->nom?>		
		</a>
	</div>
</div>