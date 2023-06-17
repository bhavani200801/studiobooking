<?php
require 'layouts/header.php';
?>
<style>
    .container {
        height: 90vh;
        /* screen height */
        position: relative;
    }

    .vertical-center {
        margin: 0;
        position: absolute;
        top: 40%;
        left: 35%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }
</style>

<div class="container">
    <div class="vertical-center">
        <h1 style='font-size:17em;    margin-bottom: -0.4em;'>&#128546;</h1>
        <h1>404<br>Page Not Found</h1>
    </div>
</div>

<?php require 'layouts/footer.php'; ?>