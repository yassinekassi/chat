<?php
define('ROOT', dirname(__DIR__));
require ROOT . "/config/database.php";
require ROOT . "/config/path.php";
require ROOT . "/libs/Controller.php";
require ROOT . "/libs/Database.php";
require ROOT . "/libs/Session.php";

if(!isset($_SESSION))
{
	Session::init();
}

if(isset($_GET['url']))
{
    $url = $_GET["url"];
}else
{
    $url = 'user/login';
}

$url = rtrim($url);
$url = explode('/', $url);

$file = ROOT . '/App/Controllers/' . $url[0] . '.php';

if (file_exists($file)) {
    require $file;
}
else {
    require ROOT . "/App/Controllers/Error.php";
    $controller = new Error();
    return false;
}

$controller = ucfirst($url[0]);
$controller = new $controller();
$controller->loadModel(ucfirst($url[0]));
if (isset($url[2])) {
    $controller->{$url[1]}($url[2]);
}
else {
    if (isset($url[1])) {
        $controller->{$url[1]}();
    }
}

?>