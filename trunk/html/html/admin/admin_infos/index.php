<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<LINK rel="stylesheet" type="text/css" href="/html/css/style.css">
 <script type="text/javascript" src="/html/js/jquery.js"></script>
 <script type="text/javascript" src="/html/js/liveschool.js"></script> 


<title>LiveSchool</title>
</head>
<body>
<div id="header">
<?php include($_SERVER['DOCUMENT_ROOT']."/html/html/commun/header.php"); ?>
</div>
	<div id="main_conteneur" style="background-image: url('/core/controller/thumb_controller.php?src=<?php echo FileUtils::getEtablissementImageFond($etablissement);?>&x=700&y=700&f=0&q=100')">
	<div id="post_conteneur">
		<?php include($_SERVER['DOCUMENT_ROOT']."/html/html/admin/left.php"); ?>
		<?php include($_SERVER['DOCUMENT_ROOT']."/html/html/admin/admin_infos/admin_infos.php"); ?>
	
	</div>
</div> 
<div id="footer">
<?php include($_SERVER['DOCUMENT_ROOT']."/html/html/commun/footer.php"); ?>
</div></body>
</html>