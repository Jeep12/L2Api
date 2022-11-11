<?php
require_once("libs/Router.php");
require_once("api/controller/api.controller.php");

$router = new Router();

$router->addRoute('getaccounts/:ID', 'GET', 'ApiLinegeII', 'getAccounts');
$router->addRoute('getchars/:ID', 'GET', 'ApiLinegeII', 'getChars');
$router->addRoute('getchar/:ID', 'GET', 'ApiLinegeII', 'getChar');
$router->addRoute('addaccount', 'POST', 'ApiLinegeII', 'addAccount');

$router->addRoute('getinv/:ID', 'GET', 'ApiLinegeII', 'getInv');




$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);