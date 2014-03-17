<?php include_once($_SERVER['DOCUMENT_ROOT']."/core/utils/PostUtils.php");?>

<form id="postEditForm<?php echo $post->idPost;?>" action="/core/controller/create_post_controller.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="idPost" value="<?php echo $post->idPost;?>"/>
	<input type="hidden" name="action" value="EDIT"/>
	<div id="zone_edit_post">
		<div id="step1">
			<div>
				<div style="width:310px; height:140px ;float:left">
					<textarea name="editPostArea" id="editPostArea<?php echo $post->idPost;?>"><?php echo $post->contenu;?></textarea>
				</div>
				<div style="width:180px; float:left; margin-left:10px;height:175px">
					<select multiple id="selectRight<?php echo $post->idPost;?>" name=listPostDestinaires[]>
						<?php 
						echo "<option value='ALL'";
						if(PostUtils::isInAssociation($post->associations, TypePost::ETABLISSEMENT, $_SESSION['ETABLISSEMENT_ID'])){
							echo " selected ";
						};
						echo ">Etablissement</option>";
							
						foreach ($listeDroitsPost as $idNiveau => $listeClasses){
							$niveau = null;
							foreach ($listeNiveaux as $tmpNiveau){
								if($tmpNiveau->idNiveau == $idNiveau){
									$niveau = $tmpNiveau;
								}
							}
						
					      	echo "<optgroup label='$niveau->nom'>";
					      	echo "<option value='NIVEAU_$niveau->idNiveau'";
							if(PostUtils::isInAssociation($post->associations, TypePost::NIVEAU, $niveau->idNiveau)){
							echo " selected ";
							};				      	
					      	echo ">Tous</option>";
					      	
					      	foreach ($listeClasses as $classe){
								echo "<option value='CLASSE_$classe->idClasse'";
								if(PostUtils::isInAssociation($post->associations, TypePost::CLASSE, $classe->idClasse)){
									echo " selected ";
								};
								echo ">$classe->nom</option>";
							}
					      	echo "</optgroup>";
						}?>
					</select>
				</div>
			</div>
			<div style="float:right; margin-right:10px">
				<input type="button" onClick="hideEditPost(<?php echo $post->idPost;?>)" value="Annuler">
				<input type="button" onClick="editPost(<?php echo $post->idPost;?>)" value="Envoyer">
			</div>
		</div>
		<div id="listeFileEditPreview<?php echo $post->idPost;?>">
			<?php foreach ($post->piecesJointes as $pj){
					 if($pj->isImage){?>
						<a  id="PREV_<?php echo $pj->idPj;?>" href="#dev" onClick="deletePj(<?php echo $pj->idPj;?>,<?php echo $post->idPost;?>)"><img class="postPjThumbnails" src="/core/controller/thumb_controller.php?src=<?php echo FileUtils::getPostFile($post->idPost,$pj->path)?>&x=30&y=30&f=0&resize=true " ></a>
					<?php }else{?>
						<a id="PREV_<?php echo $pj->idPj;?>" href="#dev" onClick="deletePj(<?php echo $pj->idPj;?>,<?php echo $post->idPost;?>)"><img class="postPjThumbnails" src="/html/images/icone-document.jpg" title="<?php echo $pj->path?>"></a>
					<?php }
			}
			?>
		</div>
		<div id="enableComment">
			<label for="allowComment">Ouvert aux commentaires : </label>
			<input name="allowComment" type="checkbox" <?php echo $post->commentairesActives?  'checked' : ''?>/>
			<label for="onlyEnseignant">Seulement aux enseignants : </label>
			<input name="onlyEnseignant" type="checkbox"  <?php echo $post->seulementEnseignant?  'checked' : ''?>/>
		</div>
			
		<div id="postEditPj">
			<label for="uploadInput">Ajouter un fichier : </label>
			<div id="upload_file_edit<?php echo $post->idPost;?>">Charger</div>
			<div id="postFileAddId<?php echo $post->idPost;?>"></div>
			<div id="postFileDeleteId<?php echo $post->idPost;?>"></div>
		</div>
		<div id="post_error<?php echo $post->idPost;?>" class="error_general"></div>
	</div>
</form>

