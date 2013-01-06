<?php
require_once realpath (__DIR__ . '/../src/Autoloader.php');
$load = new Autoloader();
$load->registro();
if($_POST['peticion']){
    switch ($_POST['action']) {
        case 'login':
            echo \action\LoginAction::loginExecute($_POST['json']);
            break;
        case 'adminReistro':
            echo \action\RegistroAction::registraUsuarioExecute($_POST['json']);
            break;
        case 'empleadoReistro':
            echo \action\RegistroAction::registraClienteExecute($_POST['json']);
            break;
        default:
            break;
    }
}
?>
