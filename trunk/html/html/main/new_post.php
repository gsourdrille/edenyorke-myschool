

<div id="link_new_post">
	<a href="#dev" onClick="openNewPost()">Nouveau post</a>
</div>
<div id="zone_new_post">
	<div id="step1">
		<textarea name="newPostArea" id="newPostArea"></textarea>
		<input type="button" onClick="closeNewPost()" value="Annuler">
		<input type="button" onClick="showAssoPost()" value="Suivant">
	</div>
	<div id="step2">
		<input type="button" onClick="closeNewPost()" value="Annuler">
		<input type="button" onClick="hideAssoPost()" value="Précédent">
		<input type="button" onClick="submit()" value="Envoyer">
	</div>
</div>


