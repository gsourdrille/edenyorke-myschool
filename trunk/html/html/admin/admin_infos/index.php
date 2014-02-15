<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<LINK rel="stylesheet" type="text/css" href="/myschool/html/css/style.css">
<LINK rel="stylesheet" type="text/css" href="/myschool/html/css/style_upload.css">
 <script type="text/javascript" src="/myschool/html/js/jquery.js"></script>
 <script type="text/javascript" src="/myschool/html/js/myschool.js"></script> 
 <script type="text/javascript" src="/myschool/html/js/jquery.knob.js"></script>
 <script type="text/javascript" src="/myschool/html/js/jquery.ui.widget.js"></script>
 <script type="text/javascript" src="/myschool/html/js/jquery.iframe-transport.js"></script>
 <script type="text/javascript" src="/myschool/html/js/jquery.fileupload.js"></script>

<title>MySchool</title>
</head>
<body>
<div id="header">
<?php include($_SERVER['DOCUMENT_ROOT']."/myschool/html/html/commun/header.php"); ?>
</div>
<div id="main_conteneur" style="background-image: url('<?php echo FileUtils::getEtablissementImageFond($etablissement);?>')">
	<div id="post_conteneur">
		<?php include($_SERVER['DOCUMENT_ROOT']."/myschool/html/html/admin/left.php"); ?>
		<?php include($_SERVER['DOCUMENT_ROOT']."/myschool/html/html/admin/admin_infos/admin_infos.php"); ?>
	
	</div>
</div> 
<?php include($_SERVER['DOCUMENT_ROOT']."/myschool/html/html/commun/footer.php"); ?>
</body>
</html>