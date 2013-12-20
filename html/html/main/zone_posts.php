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
				<div id="post_comment_entete">
					<div id="post_comment_nb">
						<?php if(count($post->commentaires)>0){?>	
							<a href="#dev" onclick="showComment(<?php echo $idPostComment;?>)"><?php echo count($post->commentaires)?> Commentaires</a>
						<?php }else{
						 echo "0 Commentaire";
						 }?>
					</div>
					<div id="post_comment_write_tools">
						<img alt="" src="/myschool/html/images/write.png"  class="post_comment_write_icon"/>
					</div>
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