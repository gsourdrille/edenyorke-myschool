<div id="current_admin_page">
	<div id="center_conteneur">
		
		<div class="floatleft">
		<input type="text" id="filter" value=""/>
		<select id="liste_niveaux" size="6">
			<?php  foreach ($listeNiveaux as $selectNiveau){
				$selected = false;
				if(isset($niveau) && $niveau->idNiveau == $selectNiveau->idNiveau){
					$selected = true;
				}
				echo "<option value='$selectNiveau->idNiveau' ";
				if($selected){
					echo "selected=selected";
				}
				echo "onclick=loadNiveaux()>$selectNiveau->nom</option>";
				}?>
		</select>
		<form action="/myschool/core/controller/admin_niveaux_controller.php" method="post">
			<div id="button_submit_infos">
				<input type="submit" name="showAdd" value="Ajouter">
			</div>
		</form>
		</div>
		<div class="floatright">
		<?php  if(isset($showNiveau) && $showNiveau){?>
			<form action="/myschool/core/controller/admin_niveaux_controller.php" method="post">
				<input type="hidden" name="idNiveau"  value="<?php if(isset($niveau->idNiveau)){echo $niveau->idNiveau;}?>"/>
				<div id="nom_niveau">
					<label for="name">Nom : </label>
					<input type="text" name="nom" value="<?php if(isset($nom)){echo $nom;}else{echo $niveau->nom;}?>"/>
					<?php if(isset($error_nom)){?>
					<div id="error_login">
						<?php echo $error_nom;?>
					</div>
					<?php }?>
				</div>
				<div id="button_submit_infos">
					<input type="submit" name="save" value="Sauvegarder">
				</div>
				<?php if(isset($niveau->idNiveau)){?>
				<div id="button_submit_infos">
					<input type="submit" name="delete" value="Supprimer">
				</div>
				<?php }?>
			</form>
			<?php if(isset($succes)){
			?>
			<div id="error_login">
					<?php echo $succes;?>
			</div>
			<?php }?>
			
		<?php
		}?>
		</div>
		
	</div>
</div>

