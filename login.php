<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    // Redirect to the desired page after login
    header("Location: dashboard.php");
    exit();
}

require_once('database.php');

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare the SQL statement to retrieve the user data
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    // Execute the SQL statement
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Authentication successful
        $_SESSION['username'] = $username;

        // Redirect to the desired page after login
        header("Location: dashboard.php");
        exit();
    } else {
        // Authentication failed
        $error_message = "Invalid username or password";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>COINEX | Login</title>
    <!-- Your CSS files here -->
    <link rel="stylesheet" href="assets/css/libs.min.css">
    <link rel="stylesheet" href="assets/css/coinex.css?v=1.0.0">
</head>
<body class="" data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <div style="background-image: url('assets/images/auth/01.png')">  
        <div class="wrapper">
            <section class="vh-100 bg-image">
                <div class="container h-100">
                    <div class="row justify-content-center h-100 align-items-center">
                        <div class="col-md-6 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="auth-form">
                                        <h2 class="text-center mb-4">Sign In</h2>
                                        <?php
                                        if (isset($error_message)) {
                                            echo '<div class="alert alert-danger">' . $error_message . '</div>';
                                        }
                                        ?>
                                        <form method="post" action="login.php">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" name="username" placeholder="name@example.com">
                                                <label for="floatingInput">Email</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="password" class="form-control" id="Password" name="password" placeholder="Password">
                                                <label for="Password">Password</label>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"  id="Remember">
                                                        <label class="form-check-label" for="Remember">Remember me?</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <a href="#page-forgot-password.html">Forgot Password?</a>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Sign In</button>
                                            </div>
                                            <div class="text-center mt-3">
                                                <p>or sign in with others account?</p>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <ul class="list-group list-group-horizontal list-group-flush">
                                                    <!-- Add your account login options here -->
                                                </ul>
                                            </div>
                                        </form>
                                        <div class="new-account mt-3 text-center">
                                            <p>Don't have an account? <a class="" href="registration.php">Click here to sign up</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Your JavaScript files here -->
    <script src="assets/js/libs.min.js"></script>
    <script src="assets/js/charts/widgetcharts.js"></script>
    <script src="assets/js/fslightbox.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/charts/apexcharts.js"></script>
</body>
</html>
