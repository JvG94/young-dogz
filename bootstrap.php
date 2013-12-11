<?php

session_start();

require_once(ROOT . DS . 'config' . DS . 'app.php');
require_once(ROOT . DS . 'config' . DS . 'database.php');
require_once(ROOT . DS . 'config' . DS . 'email.php');
require_once(ROOT . DS . 'library' . DS . 'functions.php');

error_reporting(E_ALL);
ini_set('log_errors', 'On');

// Set correct error reporting and logging.
if (DEBUG) {
    ini_set('display_errors', 'On');
    ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'error_debug.log');
}
else {
    ini_set('display_errors', 'Off');
    ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'error.log');
}

// Get the correct controller name.
$controllerName = (get_param(0) ? get_param(0) : DEFAULT_CONTROLLER) . 'Controller';

// Get the correct method name.
$methodName = (get_param(0, true) == BACKEND_PREFIX ? 'admin_' : '') . (get_param(1) ? get_param(1) : DEFAULT_METHOD);


$controller = new $controllerName();

// Check if the method exists if not show the 404 page.
if (method_exists($controller, $methodName)) {
    $controller->$methodName();
}