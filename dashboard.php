<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

    // Database connection details
    require_once('database.php');

// Get the logged-in user's username
$username = $_SESSION['username'];

// Prepare the SQL statement to fetch the user's name
$sql = "SELECT name FROM users WHERE username = '$username'";

// Execute the SQL statement
$result = $conn->query($sql);

// Check if the query was successful and if the user was found
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
} else {
    // Default to username if name not found
    $name = $username;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $name; ?></h2>
    <p>This is the dashboard page. Only logged-in users can access this page.</p>
    <a href="fetchdata.php"><input type="button" value="Trade Tracking Table"></a>
    <a href="logout.php"><input type="button" value="Logout"></a>
</body>
</html>
