

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
		<select multiple id="selectRight">
			<option value="1">Option 1</option>
			<option value="2">Option 2</option>
			<option value="3">Option 3</option>
			<option value="4">Option 4</option>
			<option value="5">Option 5</option>
			<option value="6">Option 6</option>
			<option value="7">Option 7</option>
			<option value="8">Option 8</option>
			<option value="9">Option 9</option>
			<option value="10">Option 10</option>
		</select>
		
		<input type="button" onClick="closeNewPost()" value="Annuler">
		<input type="button" onClick="hideAssoPost()" value="Précédent">
		<input type="button" onClick="submit()" value="Envoyer">
	</div>
</div>


