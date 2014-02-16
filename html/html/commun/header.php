<?php
?>
<div id="header_content">
	<div id="myschool">
		<a href="/myschool/core/controller/tableau_controller.php">
		MySchool
		</a>
	</div>
	<div id="school_name">
		<a href="/myschool/core/controller/tableau_controller.php">
			<?php echo $etablissement->nom;?> - <?php  echo $etablissement->codePostal;?> <?php echo $etablissement ->ville;?>
		</a>
	</div>
	<div id="mail">
		<img alt="" src="/myschool/html/images/icon_mail.png"  class="icon_mail"/>
	</div>
	<div id="user">
		<a href="/myschool/core/controller/admin_infos_controller.php">
			
			<?php if ($utilisateur->avatar!=null){?>
					<img src="/myschool/core/controller/thumb_controller.php?src=<?php echo FileUtils::getUtilisateurAvatar($utilisateur);?>&x=100&y=100&f=0 " class="icon_user">
				<?php }else{?>
					<img src="/myschool/html/images/icon_user.png" class="icon_user">  
				<?php }?>
			<?php echo $utilisateur->prenom; ?> <?php echo $utilisateur->nom?>		
		</a>
	</div>
	<div id="disconnect">
		<a href="/myschool/html/html/login/index.php">deconnection</a>
	</div>
</div>