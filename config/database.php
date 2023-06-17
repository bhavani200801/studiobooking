
<?php
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
if (!ini_get('display_errors')) {
    ini_set('display_errors', 1);
}

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_REMOTE_DATABASE', 'studio_booking');

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD) or die("Connection failed: " . mysqli_connect_error());
if ($db->select_db(DB_REMOTE_DATABASE)) {
} else {
    echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">';
    echo "<div class='container mt-5 text-center '>
    <div class='alert alert-danger ' role='alert'>
        <h4 class='alert-heading'>Connection Failed</h4>
            Error connection to database.
    </div>
</div> ";
}
?>
