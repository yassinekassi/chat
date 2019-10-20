<?php
class Views {

    function __construct(){
    }

    public function render($name){
       require_once ROOT . "/App/Views/header.php";
       require ROOT . "/App/Views/".$name.".php";
       require_once ROOT . "/App/Views/footer.php";
    }
}