<?php
  session_start();
  session_destroy();
  $_SESSION = array(); ?>
<!DOCTYPE html>
<!--[if lte IE 7]> <html class="ie7 ie" lang="fr"> <![endif]-->
<!--[if IE 8]> <html class="ie8 ie" lang="fr"> <![endif]-->
<!--[if IE 9]> <html class="ie9 ie" lang="fr"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="fr"> <!--<![endif]-->
  <head>
    <?php include("structure/head.php"); ?>
  </head>
	<body>
    <!--h1 class="logo">
      <span>
        <img src="/html/images/logo-liveschool.svg" alt="LiveSchool" />
      </span>
    </h1-->
    
    <?php include("body.php"); ?>

    <?php 
    // FICHIERS JAVASCRIPT
    include("structure/js-bottom.php"); ?>    
	
  </body>
</html>