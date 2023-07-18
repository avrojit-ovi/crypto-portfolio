<?php

    // Database connection details
    require_once('database.php');
    

// Check if the registration form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    
    // Prepare the SQL statement to insert the user data
    $sql = "INSERT INTO users (name, email, username, phone, password)
            VALUES ('$name', '$email', '$username', '$phone', '$password')";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
         // Show alert modal
         echo "<script>
         alert('Registration successfully!');
         window.location.href = 'login.php';
     </script>";
        exit(); // Ensure no more code is executed after the redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
