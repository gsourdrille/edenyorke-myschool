<?php
@include_once ($_SERVER['DOCUMENT_ROOT']."/core/utils/FileUtils.php");
?>
<div id="header_content">
	<div id="liveschool">
		<a href="/core/controller/tableau_controller.php">
		LiveSchool
		</a>
	</div>
	<div id="school_name">
		<?php if($listeEtablissement->count()>1){
			?>
			<select name=etablissementSelected onchange="changeEtablissement(this.options[this.selectedIndex].value)" >
			<?php foreach ($listeEtablissement as $etablissementToSelect){
				$selected = false;
				if(isset($_SESSION['ETABLISSEMENT_ID']) && $_SESSION['ETABLISSEMENT_ID'] == $etablissementToSelect->idEtablissement){
					$selected = true;
				}
				echo "<option value='$etablissementToSelect->idEtablissement' ";
				if($selected){
				echo "selected=selected";
					}
					echo ">";
					echo $etablissementToSelect->fullname();
					echo "</option>";
			}?>
			</select>
			<?php 
		}else if ($etablissement != null) {?>
		
		<a href="/core/controller/tableau_controller.php">
			<?php echo $etablissement->fullName();?>
		</a>
		<?php }?>
	</div>
	<div id="mail">
		<img alt="" src="/html/images/icon_mail.png"  class="icon_mail"/>
	</div>
	<div id="user">
		<a href="/core/controller/admin_infos_controller.php">
			
			<?php if ($utilisateur->avatar!=null){?>
					<img src="/core/controller/thumb_controller.php?src=<?php echo FileUtils::getUtilisateurAvatar($utilisateur);?>&f=0 " class="icon_user">
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