<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <script>
        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            var signupButton = document.getElementById("signupButton");

            if (password !== confirmPassword) {
                signupButton.disabled = true;
            } else {
                signupButton.disabled = false;
            }
        }
    </script>
</head>
<body>
    <h2>User Registration</h2>
    <form method="post" action="register.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" onkeyup="validatePassword()" required><br><br>
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" onkeyup="validatePassword()" required><br><br>
        <input type="submit" id="signupButton" value="Signup" disabled>
        <a href="login.php"><input type="button" value="login"></a>
    </form>
</body>
</html>
