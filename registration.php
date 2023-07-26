<?php
// You may place your database connection code here if it's not in a separate 'database.php' file
 require_once('register.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Registration</title>
    <!-- Your CSS files here -->
    <link rel="stylesheet" href="assets/css/libs.min.css">
    <link rel="stylesheet" href="assets/css/coinex.css?v=1.0.0">
    <script>
        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            var signupButton = document.getElementById("signupButton");

            if (password !== confirmPassword) {
                signupButton.disabled = true;
                document.getElementById('password').className = 'form-control is-invalid';
                document.getElementById('confirmPassword').className = 'form-control is-invalid';
            } else {
                signupButton.disabled = false;
                document.getElementById('signupButton').className = 'btn btn-outline-success';
                document.getElementById('password').className = 'form-control is-valid';
                document.getElementById('confirmPassword').className = 'form-control is-valid';
            }
        
        }
    </script>
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
                                        <h2 class="text-center mb-4">Sign Up</h2>
                                        <form method="post" action="register.php">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                                        <label for="Name">Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="username" name="username" placeholder="User Name" required>
                                                        <label for="lastName">User Name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
                                                        <label for="floatingInput">Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="phoneno" name="phone" placeholder="phoneno" required>
                                                        <label for="phoneno">Phone no</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-floating mb-2">
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" onkeyup="validatePassword()" required>
                                                        <label for="password">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-floating mb-2">
                                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm-password" onkeyup="validatePassword()" required>
                                                        <label for="confirmPassword">Confirm Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-check d-flex justify-content-center mb-2">
                                                <input type="checkbox" class="form-check-input" id="agree" required>
                                                <label class="ms-1 form-check-label" for="agree">I agree with the terms of use</label>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary" id="signupButton" disabled>Sign Up</button>
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
                                            <p>Already have an Account <a class="text-primary" href="../../dashboard/auth/sign-in.html">Sign in</a></p>
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
