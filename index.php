<?php
// all the requests will pass through this file
// require  autoload
require_once realpath("vendor/autoload.php");
require_once "./App/Config/Config.php";
require_once "./App/Helpers/Session.php";
// set default value to home
$control = 'Home';
$function = 'Home';
// get the parameters from url
$param = $_SERVER['REQUEST_URI'];
$param = strtolower($param);
$parameters = explode("/", $param);
// if parameters are set then assign them try o variables
if (isset($parameters[1]) && $parameters[1] != '') {
    $control = $parameters[1];
    $control = ucfirst($control);

}
if (isset($parameters[2]) && $parameters[2] != '') {
    $function = $parameters[2];
}

// try  creating  the controller object if not possible then call default Home class
try {
    $class_name = "App\\Controller\\$control";
    $class = new $class_name();
    //  if method exists then call the class method
    if (method_exists($class, $function)) {
        $class->$function();
    }
} catch (error) {
    $control = 'Home';
    $function = 'Home';
    $class_name = "App\\Controller\\$control";
    $class = new $class_name();
}
