<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT']."/myschool/core/controller/zone_posts_controller.php")?>

<?php foreach ($listePosts as $post){?>
	<div class="post">
		<div id="valid">
			<img alt="J'ai vu" title="J'ai vu" src="/myschool/html/images/valider.png" class="image_valid"/>
		</div>
		<div id="createur">
			<div id="nom_createur">
					<?php if ($post->fullCreateur->avatar!=null){?>
					<img src="<?php echo FileUtils::getUtilisateurAvatar($post->fullCreateur);?>" class="icon_user">
					<?php }else{?>
					<img src="/myschool/html/images/icon_user.png" class="icon_user">  
					<?php }?>
			<?php echo $post->fullCreateur->prenom; ?> <?php echo $post->fullCreateur->nom?>	
			</div>
			<div id="poste">
				Math&eacute;matiques
			</div>
		</div>
		<div id="post_content">
			<div class="post_content_texte">
				<?php echo $post->contenu ?>
			</div>
			<?php if(count($post->piecesJointes)>0){?>
				<div class="post_content_pj">
					<?php foreach ($post->piecesJointes as $pj){?>
						<div class="zone_pj">
							<a href="<?php echo FileUtils::getPostFile($post->idPost,$pj)?>"><?php echo $pj->path?></a>
						</div>
					<?php }?>
				</div>
			<?php }?>
		</div>
		<?php if($post->commentairesActives){?>
			<div id="post_comment">
			<?php $idPostComment = "post_comment_content_".$post->idPost;?>
			<?php $idPostWriteComment = "post_comment_write_comment_".$post->idPost;?>
			<?php $idFormWriteComment = "writeCommentForm_".$post->idPost;?>
				<div id="post_comment_entete">
					<div id="post_comment_nb">
						<?php if(count($post->commentaires)>0){?>	
							<a href="#dev" onclick="showComment(<?php echo $idPostComment;?>)"><?php echo count($post->commentaires)?> Commentaires</a>
						<?php }else{
						 echo "0 Commentaire";
						 }?>
					</div>
					<div id="post_comment_write_tools">
						<a href="#dev" onclick="showComment(<?php echo $idPostWriteComment;?>)">
							<img alt="" src="/myschool/html/images/write.png"  class="post_comment_write_icon"/>
						</a>
					</div>
				</div>
				<div class="post_comment_write_comment" id="<?php echo $idPostWriteComment ?>">
					<form id="<?php echo $idFormWriteComment;?>" action="/myschool/core/controller/create_comment_controller.php" method="post">
						<input type="hidden" name="idPost" value="<?php echo $post->idPost;?>"/>
						<textarea name="writeCommentArea" class="writeCommentArea"></textarea>
						<input type="button" onclick="hideComment(<?php echo $idPostWriteComment;?>)" value="Annuler"/>
						<input type="button" onclick="sendComment(<?php echo $idFormWriteComment;?>,<?php echo $idPostComment;?>)" value="Envoyer"/>
					</form>
				</div>
				<div class="post_comment_content" id="<?php echo $idPostComment ?>">
					<?php foreach ($post->commentaires as $commentaire){?>
						<div class="comment">
							<div id="comment_createur">
								<?php if ($commentaire->fullCreateur->avatar!=null){?>
									<img src="<?php echo FileUtils::getUtilisateurAvatar($commentaire->fullCreateur);?>" class="icon_user">
								<?php }else{?>
									<img src="/myschool/html/images/icon_user.png" class="icon_user">  
								<?php }?>
								<?php echo $commentaire->fullCreateur->fullName();?>
							</div>
							<div id="comment_content">
								<?php echo $commentaire->contenu?> 
							</div>
						</div>
					<?php }?>
					<div id="post_comment_footer" class="">
						<a href="#dev" onclick="hideComment(<?php echo $idPostComment;?>)">réduire</a>
					</div>
				</div>
				
			</div>
		<?php }?>
	</div>
<?php }?>