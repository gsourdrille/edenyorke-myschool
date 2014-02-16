<?php 
@session_start();
include($_SERVER['DOCUMENT_ROOT']."/myschool/core/controller/visionneuse_controller.php")?>

<div class="galleria">
<?php foreach ($listeImages as $image){?>
	<a href="/myschool/core/controller/thumb_controller.php?src=<?php echo FileUtils::getPostFile($idPost,$image->path)?>&x=500&y=500&f=0 "><img src="/myschool/core/controller/thumb_controller.php?src=<?php echo FileUtils::getPostFile($idPost,$image->path)?>&x=50&y=50&f=0 "></a>
	<?php 
}
?>
</div>