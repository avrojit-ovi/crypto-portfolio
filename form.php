<?php


// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}
?>


<?php
// Define variables and set to empty values
$coinName = $cSymbol = $entryPrice = $quantity = $firstTarget = $secondTarget = $stopLoss = "";

// Function to clean user input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input fields
    $coinName = sanitizeInput($_POST["coinName"]);
    $cSymbol = sanitizeInput($_POST["cSymbol"]);
    $entryPrice = sanitizeInput($_POST["entryPrice"]);
    $quantity = sanitizeInput($_POST["quantity"]);
    $firstTarget = sanitizeInput($_POST["firstTarget"]);
    $secondTarget = sanitizeInput($_POST["secondTarget"]);
    $stopLoss = sanitizeInput($_POST["stopLoss"]);

    require_once('database.php');

    // Prepare the SQL statement to insert data into the table
    $sql = "INSERT INTO cryptotable (coin_name, c_symbol, entry_price, quantity, first_target, second_target, stop_loss)
            VALUES ('$coinName', '$cSymbol', '$entryPrice', '$quantity', '$firstTarget', '$secondTarget', '$stopLoss')";

    // Check if the insertion is successful
    if ($conn->query($sql) === TRUE) {
         // Show alert modal
         echo "<script>
         alert('Coin added successfully!');
         window.location.href = 'fetchdata.php';
     </script>";
        exit(); // Ensure no more code is executed after the redirect
    } else {
        echo "Error inserting data: " . $conn->error;
    }


    
    // Close the database connection
    $conn->close();
}
?>





