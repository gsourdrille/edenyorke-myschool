<?php 
@session_start();
include($_SERVER['DOCUMENT_ROOT']."/core/controller/zone_posts_controller.php")?>
<?php foreach ($resultListePosts->listePost as $post){?>
	<div class="post">
		<div id="createur">
			<div id="entete_createur">
				<div id="nom_createur">
					<?php if ($post->fullCreateur->avatar!=null){?>
					<img src="/core/controller/thumb_controller.php?src=<?php echo FileUtils::getUtilisateurAvatar($post->fullCreateur);?>&f=0 " class="icon_user">
					<?php }else{?>
					<img src="/html/images/icon_user.png" class="icon_user">  
					<?php }?>
					<?php echo $post->fullCreateur->prenom; ?> <?php echo $post->fullCreateur->nom?>	
				</div>
				<div id="poste">
					<?php echo $post->fullCreateur->type;?>
				</div>
			</div>
			<div id="infos_post">
				<div id="edit_post_link">
					<?php if($post->isCreateur){?>
						<a href="#dev" onclick="showEditPost(<?php echo $post->idPost;?>)">modifier</a>
					<?php }?>
				</div>
				<div id="delete_post_link">
					<?php if($post->isCreateur){?>
						<a href="#dev" onclick="deletePost(<?php echo $post->idPost;?>)">supprimer</a>
					<?php }?>
				</div>
				<div id="post_date">
					le <?php echo $post->dateCreation->format(Constants::FORMAT_DATE);?>
				</div>
			</div>
		</div>
		<div class="post_content" id="post_content_<?php echo $post->idPost;?>">
			<div class="post_content_texte">
				<?php echo $post->contenu ?>
			</div>
			<?php if(count($post->piecesJointes)>0){?>
				<div class="post_content_pj">
					<?php foreach ($post->piecesJointes as $pj){?>
						<div class="zone_pj">
							<?php if($pj->isImage){?>
								<a href="#dev" onClick="showGaleria(<?php echo $post->idPost;?>)"><img class="postPjThumbnails" src="/core/controller/thumb_controller.php?src=<?php echo FileUtils::getPostFile($post->idPost,$pj->path)?>&x=30&y=30&f=0&resize=true  " ></a>
							<?php }else{?>
								<a href="/core/controller/file_controller.php?post=<?php echo $post->idPost?>&pj=<?php echo $pj->idPj?>"><img class="postPjThumbnails" src="/html/images/icone-document.jpg" title="<?php echo $pj->path?>"></a>
							<?php }?>
						</div>
					<?php }?>
				</div>
			<?php }?>
		</div>
		<?php if($post->isCreateur){?>
			<div class="edit_post" id="edit_post_<?php echo $post->idPost;?>">
				<?php include("edit_post.php");?>
			</div>
		<?php }?>
		<?php if($post->commentairesActives){
			include("zone_commentaires.php");
		}?>
	</div>
<?php }
	if($resultListePosts->hasMorePosts){?>
		<div id="morePosts">
			<input type="button" value="Plus de posts" onclick="showMorePost(<?php echo $offset;?>)"/>
     	</div>
     <?php 

}
?>
