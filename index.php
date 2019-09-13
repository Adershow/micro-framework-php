<?php
session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
require_once ROOT . DS . 'core' . DS . 'bootstrap.php';
require_once ROOT . DS . 'config' . DS . 'routes.php';
