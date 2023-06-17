<?php
session_start();

date_default_timezone_set('Asia/Kolkata');

define("DATE_FORMAT", "d/m/Y h:i A");

define("SESSION_EXPIRY", '180');
define("ROOT_PATH", '/');
define("VIEW_PATH", ROOT_PATH . 'view/');
define('HOME_PAGE', VIEW_PATH . 'home');

$titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.');

$gender = array(
    'Male',
    'Female',
    'Transgender'
);

$martialStatus = array(
    'Single',
    'Married',
    'Divorced',
    'Widowed'
);

$bloodGroup = array('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'A1B+', 'A1B-');

$allowedImageType = array(
    "image/gif",
    "image/jpeg",
    "image/pjpeg",
    "image/png",
    "image/x-png",
    "text/plain",
    "application/octet-stream"
);

require_once 'database.php';
