<?session_start();
session_destroy();
$_SESSION = array();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<LINK rel="stylesheet" type="text/css" href="/myschool/html/css/style.css">
		 <script type="text/javascript" src="/myschool/html/js/jquery.js"></script>
		 <script type="text/javascript" src="/myschool/html/js/jquery-ui.min.js"></script> 
		 <script type="text/javascript" src="/myschool/html/js/myschool_login.js"></script> 
	
	 
		<title>MySchool</title>
	</head>
	<body>
		<div id="header">
			<?php include("header.php"); ?>
		</div>
			<?php include("body.php"); ?>
		<div id="footer">
			<?php include($_SERVER['DOCUMENT_ROOT']."/myschool/html/html/commun/footer.php"); ?>
		</div>
	</body>
</html>