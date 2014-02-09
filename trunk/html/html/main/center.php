<div id="center_conteneur">
	<div class="toolbox">
		<div id="mask">
			Masquer Vus <input type="checkbox"></input>
		</div>
		<div id="filter">
			Filtre : <select name="filtre" size="1">
					 <option>Tous</option>
					 <option>Direction</option>
					 <option>Math&eacute;matiques</option>
					 </select>

		</div>
	</div>
	<div id="dialog-confirm-delete-post" title="Supprimer le post ?">
  		<p>Voulez vous vraiment supprimer ce post ?</p>
	</div>
	<div id="dialog-galeria">
  		<div id="visionneuse" class="galeria"></div>
	</div>
	<div id="newPost">
		<?php include("new_post.php"); ?>
	</div>
	<div id="zonePosts">
		<?php include("zone_posts.php"); ?>
	</div>
</div>