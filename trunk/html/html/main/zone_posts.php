<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT']."/myschool/core/controller/zone_posts_controller.php")?>

<?php foreach ($listePosts as $post){?>
	<div class="post">
		<div id="valid">
			<img alt="J'ai vu" title="J'ai vu" src="/myschool/html/images/valider.png" class="image_valid"/>
		</div>
		<div id="createur">
			<div id="entete_createur">
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
			<div id="infos_post">
				<div id="edit_post_link">
					<?php if($post->isCreateur){?>
						<a href="#dev" onclick="showEditPost(<?php echo $post->idPost;?>)">modifier</a>
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
							<a href="<?php echo FileUtils::getPostFile($post->idPost,$pj->path)?>"><?php echo $pj->path?></a>
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
<?php }?>