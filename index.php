<?php
require ("./src/controller/UsuarioController.php");
require_once ("./src/utilities/JWT.php");
require_once ("./src/utilities/loadEnv.php");

$url = $_SERVER["REQUEST_URI"];
$UsuarioController = new UsuarioController ();
session_start ();

if (($url == "/login" || $url == "/") && !isset($_SESSION ["token"])) {
    $UsuarioController->Login(); 
} elseif ($url == "/cadastro" && !isset($_SESSION["token"])) {
    $UsuarioController->Cadastro();
} elseif ($url == "/dashboard" && isset($_SESSION["token"])) {
    $UsuarioController->Dashboard();
} else {
    echo ("<script> window.location.href = history.back (); </script>");
};
?>