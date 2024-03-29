<div id="current_admin_page">
	<div id="center_conteneur">
		<form action="/etablissement" method="post" enctype="multipart/form-data">
			
			<input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
			
			<div id="nom_info">
				<label for="name">Nom : </label>
				<input type="text" name="nom" value="<?php if(isset($nom)){echo $nom;}else{echo $etablissement->nom;}?>"/>
				<?php if(isset($error_nom)){?>
				<div id="error_login">
					<?php echo $error_nom;?>
				</div>
				<?php }?>
			</div>
			<div id="prenom_info">
				<label for="adresse">Adresse : </label>
				<input type="text" name="adresse" value="<?php if(isset($adresse)){echo $adresse;}else{echo $etablissement->adresse;}?>"/>
				<?php if(isset($error_adresse)){?>
				<div id="error_login">
					<?php echo $error_adresse;?>
				</div>
				<?php }?>
			</div>
			<div id="cp_info">
				<label for="codepostal">Code Postal : </label>
				<input type="text" name="codepostal" value="<?php if(isset($codepostal)){echo $codepostal;}else{echo $etablissement->codePostal;}?>"/>
				<?php if(isset($error_codepostal)){?>
				<div id="error_login">
					<?php echo $error_codepostal;?>
				</div>
				<?php }?>
			</div>
			<div id="ville_info">
				<label for="ville">Ville : </label>
				<input type="text" name="ville" value="<?php if(isset($ville)){echo $ville;}else{echo $etablissement->ville;}?>"/>
				<?php if(isset($error_ville)){?>
				<div id="error_login">
					<?php echo $error_ville;?>
				</div>
				<?php }?>
			</div>
			<div id="tel1_info">
				<label for="telephone1">Téléphone 1 : </label>
				<input type="text" name="telephone1" value="<?php if(isset($telephone1)){echo $telephone1;}else{echo $etablissement->telephone1;}?>"/>
				<?php if(isset($error_telephone1)){?>
				<div id="error_login">
					<?php echo $error_telephone1;?>
				</div>
				<?php }?>
			</div>
			<div id="tel2_info">
				<label for="telephone2">Téléphone 2 : </label>
				<input type="text" name="telephone2" value="<?php if(isset($telephone2)){echo $telephone2;}else{echo $etablissement->telephone2;}?>"/>
			</div>
			<div id="fax_info">
				<label for="fax">Fax : </label>
				<input type="text" name="fax" value="<?php if(isset($fax)){echo $fax;}else{echo $etablissement->fax;}?>"/>
			</div>
			
			
			<div id="admin_image" style="display: block">
				<?php if ($etablissement->imagePrincipale!=null){?>
					<img id="etablissement_image_principale" src="/core/controller/thumb_controller.php?src=<?php echo FileUtils::getEtablissementImagePrincipale($etablissement);?>&f=0" width="100px" height="100px">
				<?php }else{?>
					<img id="etablissement_image_principale" src="/html/images/defaut_image_etablissement.jpeg" width="100px" height="100px">
				<?php }?>
					<input type="button" value="Changer" onclick="showUploadImagePrincipaleButton()">
					<input type="button" value="Supprimer" onclick="deleteImagePrincipale()">
					<div id="error_upload_principale" class="error_general"></div>
			</div>
			<input id="etablissementImagePrincipaleId" type="hidden" name="etablissementImagePrincipale" />
			<div id="upload_image" style="display: none">
				<label for="imagePrincipale">Image de l'établissement : </label>
				<div id="etablissement_principale_upload" >Charger l'image</div>
				<input type="button" value="Annuler" onclick="hideUploadButton()">
			</div>
			
			
			<div id="admin_image_fond" style="display: block">
				<?php if ($etablissement->imageFond!=null){?>
					<img id="etablissement_image_fond" src="/core/controller/thumb_controller.php?src=<?php echo FileUtils::getEtablissementImageFond($etablissement);?>&f=0" width="100px">
					 
				<?php }else{?>
					<img id="etablissement_image_fond" src="/html/images/defaut_image_etablissement.jpeg" width="100px" height="100px">
				<?php }?>
					<input type="button" value="Changer" onclick="showUploadImageFondButton()">
					<input type="button" value="Supprimer" onclick="deleteImageFond()">
					<div id="error_upload_fond" class="error_general"></div>
			</div>
			<input id="etablissementImageFondId" type="hidden" name="etablissementImageFond" />
			<div id="upload_image_fond" style="display: none">
				<label for="imageFond">Image de fond de l'établissement : </label>
				<div id="etablissement_fond_upload" >Charger l'image</div>
				<input type="button" value="Annuler" onclick="hideUploadImageFondButton()">
			</div>
			<div id="button_submit_infos">
				<input type="submit" name="submit" value="Sauvegarder">
			</div>
			<?php if(isset($error_image)){?>
			<div id="error_login">
				<?php echo $error_image;?>
			</div>
			<?php }?>
			<?php if(isset($succes)){
			?>
			<div id="error_login">
					<?php echo $succes;?>
			</div>
			<?php }?>
		</form>	
	</div>
</div>