<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input fields
    $id = $_POST["id"];
    $coinName = sanitizeInput($_POST["coinName"]);
    $cSymbol = sanitizeInput($_POST["cSymbol"]);
    $entryPrice = sanitizeInput($_POST["entryPrice"]);
    $quantity = sanitizeInput($_POST["quantity"]);
    $firstTarget = sanitizeInput($_POST["firstTarget"]);
    $secondTarget = sanitizeInput($_POST["secondTarget"]);
    $stopLoss = sanitizeInput($_POST["stopLoss"]);

    // Database connection 
    require_once('database.php');

    // Prepare the SQL statement to update the record
    $sql = "UPDATE cryptotable SET coin_name='$coinName', c_symbol='$cSymbol', entry_price='$entryPrice', quantity='$quantity',
            first_target='$firstTarget', second_target='$secondTarget', stop_loss='$stopLoss' WHERE id=$id";

    // Check if the update is successful
    if ($conn->query($sql) === TRUE) {
         // Show alert modal
         echo "<script>
         alert('Record updated successfully!');
         window.location.href = 'fetchdata.php';
     </script>";
        exit(); // Ensure no more code is executed after the redirect

    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request.";
}

// Function to clean user input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
