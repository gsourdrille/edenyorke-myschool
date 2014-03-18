<?php 
@session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/core/controller/visionneuse_controller.php")?>

<div class="galleria">
<?php foreach ($listeImages as $image){?>
	<a href="/core/controller/thumb_controller.php?src=<?php echo FileUtils::getPostFile($idPost,$image->path)?>&x=500&y=500&f=0 "><img src="/core/controller/thumb_controller.php?src=<?php echo FileUtils::getPostFile($idPost,$image->path)?>&x=50&y=50&f=0&resize=true "></a>
	<?php 
}
?>
</div>