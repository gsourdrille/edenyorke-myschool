<div id="current_admin_page">
	<div id="center_conteneur">
		
		<div class="floatleft">
		<select id="liste_niveaux" size="6"  onclick="loadNiveaux()">
			<?php  foreach ($listeNiveaux as $selectNiveau){
				$selected = false;
				if(isset($_SESSION['NIVEAU_SELECTED']) && $_SESSION['NIVEAU_SELECTED'] == $selectNiveau->idNiveau){
					$selected = true;
				}
				echo "<option value='$selectNiveau->idNiveau' ";
				if($selected){
					echo "selected=selected";
				}
				echo ">$selectNiveau->nom</option>";
				}?>
		</select>
		<form action="/myschool/core/controller/admin_niveaux_controller.php" method="post">
			<div id="button_submit_infos">
				<input type="submit" name="showAddNiveau" value="Ajouter">
			</div>
		</form>
		</div>
		<div class="floatright">
		<?php  if(isset($showNiveau) && $showNiveau){?>
			<form action="/myschool/core/controller/admin_niveaux_controller.php" method="post">
				<input type="hidden" name="idNiveau"  value="<?php if(isset($niveau->idNiveau)){echo $niveau->idNiveau;}?>"/>
				<div id="nom_niveau">
					<label for="name">Nom : </label>
					<input type="text" name="nomNiveau" value="<?php if(isset($nomNiveau)){echo $nomNiveau;}else{echo $niveau->nom;}?>"/>
					<?php if(isset($error_nom_niveau)){?>
					<div id="error_login">
						<?php echo $error_nom_niveau;?>
					</div>
					<?php }?>
				</div>
				<div id="button_submit_infos">
					<input type="submit" name="saveNiveau" value="Sauvegarder">
				</div>
				<?php if(isset($niveau->idNiveau)){?>
				<div id="button_submit_infos">
					<input type="submit" name="deleteNiveau" value="Supprimer">
				</div>
				<?php }?>
			</form>
			<?php if(isset($succesNiveau)){
			?>
			<div id="error_login">
					<?php echo $succesNiveau;?>
			</div>
			<?php }?>
		
		
		
		
			<div>
				<div class="floatleft">
					<select id="liste_classes" size="6"  onclick="loadClasses()">
						<?php  foreach ($listeClasses as $selectClasse){
							$selected = false;
							if(isset($classe) && $classe->idClasse == $selectClasse->idClasse){
								$selected = true;
							}
							echo "<option value='$selectClasse->idClasse' ";
							if($selected){
								echo "selected=selected";
							}
							echo ">$selectClasse->nom</option>";
							}?>
					</select>
		<form action="/myschool/core/controller/admin_niveaux_controller.php" method="post">
			<div id="button_submit_infos">
				<input type="submit" name="showAddClasse" value="Ajouter">
			</div>
		</form>
		</div>
		<div class="floatright">
		<?php  if(isset($showClasse) && $showClasse){?>
			<form action="/myschool/core/controller/admin_niveaux_controller.php" method="post">
				<input type="hidden" name="idClasse"  value="<?php if(isset($classe->idClasse)){echo $classe->idClasse;}?>"/>
				<div id="nom_classe">
					<label for="name">Nom : </label>
					<input type="text" name="nomClasse" value="<?php if(isset($nomClasse)){echo $nomClasse;}else{echo $classe->nom;}?>"/>
					<?php if(isset($error_nom_classe)){?>
					<div id="error_login">
						<?php echo $error_nom_classe;?>
					</div>
					<?php }?>
				</div>
				<div id="button_submit_infos">
					<input type="submit" name="saveClasse" value="Sauvegarder">
				</div>
				<?php if(isset($classe->idClasse)){?>
				<div id="button_submit_infos">
					<input type="submit" name="deleteClasse" value="Supprimer">
				</div>
				<?php }?>
			</form>
			<?php if(isset($succesClasse)){
			?>
			<div id="error_login">
					<?php echo $succesClasse;?>
			</div>
			<?php }?>
			
		<?php
		}?>
		</div>
			
			</div>
		</div>			
			
		<?php
		}?>	
			
			
			
		
	</div>
</div>

