<?php
define("PATH",__DIR__);
define("PATH_CSS",PATH."/src/css/style.css");

require "./src/Router/Router.php";
require "./src/Controller/Controller.php";

$router = new Router($_GET['url']);
$router->get('/', "home");
$router->get('/bbtan-js', "bbtan");

$router->run();
?>