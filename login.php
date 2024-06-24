<?php

require_once "config.php";
require_once "session.php";


$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // validate if email is empty
    if (empty($email)) {
        $error .= '<p class="error">Please enter email.</p>';
    }

    // validate if password is empty
    if (empty($password)) {
        $error .= '<p class="error">Please enter your password.</p>';
    }

    if (empty($error)) {
        $usersql = "SELECT * FROM users WHERE email = '$_POST[email]'";
        $userresults = mysqli_query($db, $usersql);
        $userresults->num_rows;
        if($userresults->num_rows > 0) {
            $row = mysqli_fetch_assoc($userresults);

            if ($row) {
                if (empty($row['password']) || is_null($row['password'])) {
                    $error .= '<p class="error">password is null</p>';
                } else if (password_verify($password, $row['password'])) {
                    $_SESSION["userid"] = $row['id'];
                    $_SESSION["user"] = $row;
                    header("location: index.php");
                    exit;
                } else {
                    $error .= '<p class="error">password is wrong</p>';
                }
            } else {
                $error .= '<p class="error">email is wrong</p>';
            }
        }
        else {
            $error .= '<p class="error">User not found</p>';
        }
        //$query->close();
    }
    // Close connection
    mysqli_close($db);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Custom Brewery - Using Open Brewery Api</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="assets/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">Custom Brewery</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-4">
                        <?php if (isset($_SESSION["userid"]) && $_SESSION["user"] == true) { ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                        <?php }else{ ?>
                            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-2">
            <div class="container px-4 px-lg-5 my-4">
                <div class="text-center text-white pb-3">
                    <h1 class="display-4 fw-bolder">Custom Brewery</h1>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Login</h2>
                    <p>Please fill in your email and password.</p>
                    <?php echo $error; ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" required />
                        </div>    
                        <div class="form-group pb-4">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group pb-4">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </div>
                        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
                    </form>
                </div>
            </div>
        </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Custom Brewery 2024</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="./index.js"></script>
    </body>
</html>