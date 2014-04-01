<form id="commentEditForm<?php echo $commentaire->idCommentaire;?>" action="/core/controller/create_comment_controller.php" method="post">
	<input type="hidden" name="idCommentaire" value="<?php echo $commentaire->idCommentaire;?>"/>
	<input type="hidden" name="action" value="EDIT"/>
	<textarea name="writeCommentArea" class="writeCommentArea"><?php echo $commentaire->contenu;?></textarea>
	<input type="button" onclick="hideEditCommentaire('<?php echo $commentaire->idCommentaire;?>')" value="Annuler"/>
	<input type="button" onclick="editComment('<?php echo $commentaire->idCommentaire;?>',<?php echo $idPostComment;?>)" value="Envoyer"/>
</form>

