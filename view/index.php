<?php
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../classes/UserLogin.php';
require_once '../classes/HomePage.php';
require_once '../classes/Rooms.php';


$usersLogin = new UserLogin($db);
$homePage = new HomePage($db);
$rooms = new Room($db);


if (isset($_GET['do']) && !empty($_GET['do'])) {
    $module = $_GET['do'];
}
if (time() - $_SESSION['start'] > $_SESSION['expire']) {
    session_unset();
    session_destroy();
} else {
    $_SESSION['start'] = time();
}
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header('Location:../');
    exit();
}

if (!($usersLogin->CheckUserLogin())) {
    header('Location:../');
    exit();
}

header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
//session_cache_limiter('public'); // works too
session_start();
switch ($module) {
    case 'home':
        if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
            header('Location:../');
            exit();
        }
        $studios = json_decode($homePage->getStudios(), true);
        require './templates/home.php';
        break;

    case 'rooms':
        $rooms = $rooms->getRoomlist();
        require './templates/rooms.php';
        break;

    case 'StatusUpdate':
        print_r($rooms->StatusUpdate($_POST['data']));
        break;

    case 'booking_process':
        if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
            header('Location:../');
            exit();
        }
        echo $homePage->saveBooking($_POST);
        break;

    case 'show_booking':
        if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
            header('Location:../');
            exit();
        }
        echo $homePage->showBooking($_POST);
        break;

    case 'cancel_booking':
        if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
            header('Location:../');
            exit();
        }
        echo $homePage->cancelBooking($_POST);
        break;


    case 'bookings':
        $booking_details = $rooms->getBookingList();
        require './templates/booking_list.php';
        break;

    default:
        if ($_GET['do'] == 'doing') {
            require 'errors/500.php';
        } else {
            echo "<script> localStorage.clear(); </script>";
            require 'errors/404.php';
        }
}
