<?php
require_once('bootstrap.php');
Doctrine::generateModelsFromYaml('yaml', 'models', array('generateTableClasses' => true));
