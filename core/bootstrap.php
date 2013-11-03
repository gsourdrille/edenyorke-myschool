<?php

// bootstrap.php
 
/**
 * Bootstrap Doctrine.php, register autoloader specify
 * configuration attributes and load models.
 */
 
require_once('lib/Doctrine.php');

spl_autoload_register(array('Doctrine', 'autoload'));
spl_autoload_register(array('Doctrine', 'modelsAutoload')); 
 
$manager = Doctrine_Manager::getInstance();
 
$conn = Doctrine_Manager::connection('mysql://root:root@localhost/myschool','doctrine');
 
$manager->setAttribute(Doctrine_Core::ATTR_VALIDATE, Doctrine_Core::VALIDATE_ALL);
$manager->setAttribute(Doctrine_Core::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
$manager->setAttribute(Doctrine_Core::ATTR_AUTOLOAD_TABLE_CLASSES, true);
$manager->setAttribute(Doctrine_Core::ATTR_MODEL_LOADING, Doctrine_Core::MODEL_LOADING_CONSERVATIVE);
 
Doctrine_Core::loadModels('models');