<?php
require_once 'config/config.php';
require_once 'classes/UserLogin.php';
session_start();
$usersLogin = new UserLogin($db);

$module = '';
if (isset($_GET['do'])) {
    $module = $_GET['do'];
}
switch ($module) {
    case 'LOGIN_PAGE':
        session_unset();
        require 'login.php';
        break;

    case 'LOGIN_CHECK':
        if (!isset($_POST) || !empty($_POST)) {
            $return_message = $usersLogin->loginCheck($_POST);
        }
        if ($return_message == '') {
            $_POST['username'] = '';
            $_POST['password']  = '';
            $_POST['location'] = '';
            header('Location: ' . HOME_PAGE);
            exit();
        } else {
            session_unset();
            require 'login.php';
            exit();
        }
        break;

    case 'LOGOUT':
        $userid = !empty($_POST['username']) ? $_POST['username'] : $_GET['id'];
        session_unset();
        require 'login.php';
        break;

    default:
        session_unset();
        session_destroy();
        $_SESSION['username'] = '';
        require_once 'login.php';
}
