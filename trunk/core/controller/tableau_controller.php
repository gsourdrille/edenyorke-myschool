<?php

session_start();

require ('../service/tableau_service.php');
require('../logs/Logger.class.php');

		// Creation d'un objet Logger
		$logger = new Logger(Constants::LOGGER_LOCATION);

		include($_SERVER['DOCUMENT_ROOT']."/myschool/core/controller/commun_controller.php");
		require ($_SERVER['DOCUMENT_ROOT']."/myschool/html/html/main/index.php");

	