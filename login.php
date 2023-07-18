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
        echo "Invalid username or password";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
        <a href="registration.php"><input type="button" value="Register"></a>
    </form>
</body>
</html>
