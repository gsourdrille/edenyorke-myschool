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
				<input type="hidden" name="action" value="CREATE"/>
				<textarea name="writeCommentArea" class="writeCommentArea"></textarea>
				<input type="button" onclick="hideComment(<?php echo $idPostWriteComment;?>)" value="Annuler"/>
				<input type="button" onclick="sendComment(<?php echo $idFormWriteComment;?>,<?php echo $idPostComment;?>)" value="Envoyer"/>
			</form>
		</div>
		<div class="post_comment_content" id="<?php echo $idPostComment ?>">
			<?php foreach ($post->commentaires as $commentaire){?>
				<div class="comment">
					<div id="entete_comment">
						<div id="comment_createur">
							<?php if ($commentaire->fullCreateur->avatar!=null){?>
								<img src="/myschool/core/controller/thumb_controller.php?src=<?php echo FileUtils::getUtilisateurAvatar($commentaire->fullCreateur);?>&x=100&y=100&f=0 " class="icon_user">
							<?php }else{?>
								<img src="/myschool/html/images/icon_user.png" class="icon_user">  
							<?php }?>
							<?php echo $commentaire->fullCreateur->fullName();?>
							<?php if($commentaire->isCreateur){?>
								<div id="edit_commentaire_link">
									<a href="#dev" onclick="showEditCommentaire(<?php echo $commentaire->idCommentaire;?>)">modifier</a>
								</div>
								<div id="delete_commentaire_link">
									<a href="#dev" onclick="deleteCommentaire(<?php echo $commentaire->idCommentaire;?>,<?php echo $idPostComment;?>)">supprimer</a>
								</div>
							<?php }?>
						</div>
						<div id="comment_date">
							le <?php echo $commentaire->dateCreation->format(Constants::FORMAT_DATE);?>
						</div>
					</div>
					<div class="comment_content" id="comment_content_<?php echo $commentaire->idCommentaire;?>">
						<?php echo $commentaire->contenu?> 
					</div>
					<?php if($commentaire->isCreateur){?>
						<div class="edit_commentaire" id="edit_commentaire_<?php echo $commentaire->idCommentaire;?>">
							<?php include("edit_commentaire.php");?>
						</div>
					<?php }?>
				</div>
			<?php }?>
			<div id="post_comment_footer" class="">
				<a href="#dev" onclick="hideComment(<?php echo $idPostComment;?>)">réduire</a>
			</div>
		</div>
		
	</div>