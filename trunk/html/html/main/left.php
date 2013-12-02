<div id="left_conteneur">
	<div class="left_post">
		<div id="logo_ecole">
			<?php if ($etablissement->imagePrincipale!=null){?>
				<img src="<?php echo Constants::PATH_IMAGE_ETABLISSEMENT."/".$etablissement->idEtablissement."/".$etablissement->imagePrincipale;?>" class="icon_school" >
			<?php }else{?>
				<img src="/myschool/html/images/defaut_image_etablissement.jpeg" class="icon_school" >
			<?php }?>
		</div>
		<div id="infos_ecole">
			<p><?php echo $etablissement->adresse;?><br><?php  echo $etablissement->codePostal;?> <?php echo $etablissement ->ville;?><br>
			<?php if(isset($etablissement->telephone1)){ ?>Tel: <?php echo $etablissement->telephone1;}?>
			<?php if(isset($etablissement->telephone2)){ ?><br>Tel: <?php echo $etablissement->telephone2;}?>
			<?php if(isset($etablissement->fax)){ ?><br>Fax: <?php echo $etablissement->fax;}?></p>
		</div>
	</div>
	<div class="left_post" style="height:300px;">
		<div id="agenda_title">
			<div id="logo_agenda">
					<img alt="" src="/myschool/html/images/calendar-icon.png"  class="icon_calendar"/>
			</div>
			<div id="agenda_title_text">Agenda</div>
		</div>
		<div id="agenda_content">
			<ul>
				<li>10 Octobre : Portes ouvertes</li>
				<li>24 Octobre : Devoirs de Math&eacute;matiques</li>
			</ul>
		</div>
	</div>
</div>