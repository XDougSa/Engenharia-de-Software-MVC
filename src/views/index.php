<?php
require ("./src/controller/UsuarioController.php");
require_once ("./src/utilities/JWT.php");

$url = $_SERVER["REQUEST_URI"];
$UsuarioController = new UsuarioController ();

switch ($url) {
    case ("/login" || "/" ) && !isset($_SESSION ["token"]):
        $UsuarioController->Login();
        break;
    case "/cadastro" && !isset($_SESSION["token"]):
        $UsuarioController->Cadastro();
        break;
}
?>