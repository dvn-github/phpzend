<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    realpath(APPLICATION_PATH . '/default/models'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';
require_once 'Zend/Loader.php';
date_default_timezone_set("America/Mexico_City");
// Iniciar el auto cargado de clases
Zend_Loader::registerAutoload();
$configuration = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini', 'production');
$dbAdapter = Zend_Db::factory($configuration->database);

// Seleccionar el adaptador necesario

Zend_Db_Table_Abstract::setDefaultAdapter($dbAdapter);

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();