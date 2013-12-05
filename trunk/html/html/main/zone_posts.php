<?php include($_SERVER['DOCUMENT_ROOT']."/myschool/core/controller/zone_posts_controller.php")?>

<?php foreach ($listePosts as $post){?>
	<div class="post">
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
		</div>
		<?php if($post->commentairesActives){?>
			<div id="post_comment">
				<div id="post_comment_nb">
					<?php echo count($post->commentaires)?> Commentaires
				</div>
				<div id="post_comment_write_tools">
					<img alt="" src="/myschool/html/images/write.png"  class="post_comment_write_icon"/>
				</div>
			</div>
		<?php }?>
		<div id="valid">
			<img alt="J'ai vu" title="J'ai vu" src="/myschool/html/images/valider.png" class="image_valid"/>
		</div>
	</div>
<?php }?>