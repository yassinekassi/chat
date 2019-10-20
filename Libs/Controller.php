<?php
require_once(ROOT . "/libs/Views.php");
class Controller {

    function __construct(){
        $this->view = new Views();

    }
    public function loadModel($name) {
        $path = ROOT . '/App/Models/'.$name.'Model.php';
        if (file_exists($path)) {
            require ROOT . '/App/Models/'.$name.'Model.php';
            require ROOT . '/App/Models/'.$name.'Manager.php';
        }
    }
}