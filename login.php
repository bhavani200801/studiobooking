<?php require_once 'config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Login Form</title>
    <style>
        body {
            font-family: "Karla", sans-serif;
            background-color: #d0d0ce;
            min-height: 100vh;
            max-height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container vertical-center">
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xl-5">
                        <div class="card login-card">
                            <div class="row g-0">
                                <div class="col-md-12 col-lg-12 d-flex align-items-center">
                                    <div class="card-body text-black">
                                        <form action="index.php?do=LOGIN_CHECK" id="loginform" method="POST">
                                            <h5 class="mb-3 pb-3">Sign into your account</h5>
                                            <div class="form-group form-outline mb-4">
                                                <!-- <label for="username">User Name</label> -->
                                                <input type="text" name="username" id="username" class="form-control" value="<?php echo $_POST['username']; ?>" placeholder="username">
                                            </div>
                                            <div class="form-outline mb-4">
                                                <!-- <label for="password">Password</label> -->
                                                <input type="password" name="password" id="password" value="<?php echo $_POST['password']; ?>" class="form-control" placeholder="password">
                                            </div>
                                            <span class="text-danger">
                                            </span>
                                            <div class=".alertmsg text-danger m-0">
                                                <ul class="list-unstyled m-0" id="alertmsg">
                                                    <?php echo ($_SESSION['error_message'] ? "<li>" . $_SESSION['error_message'] . "</li>" : '') ?>
                                                </ul>
                                            </div>
                                            <div class="pt-1 mb-4">
                                                <button type="submit" id="login" class="btn btn-block btn-primary mb-4">
                                                    Login
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>