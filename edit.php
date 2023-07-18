<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit CryptoTTTable Data</title>
</head>
<body>

<?php
// Check if the record ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Database connection details
    require_once('database.php');

    // Prepare the SQL statement to fetch the record
    $sql = "SELECT * FROM cryptotable WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the record data
        $row = $result->fetch_assoc();
        $coinName = $row["coin_name"];
        $cSymbol = $row["c_symbol"];
        $entryPrice = $row["entry_price"];
        $firstTarget = $row["first_target"];
        $secondTarget = $row["second_target"];
        $stopLoss = $row["stop_loss"];

        // Display the edit form
        echo "<h2>Edit CryptoTTTable Data</h2>";
        echo "<form method='post' action='update.php'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<label for='coinName'>Coin Name:</label>";
        echo "<input type='text' name='coinName' value='$coinName' required><br><br>";
        echo "<label for='cSymbol'>Coin Symbol:</label>";
        echo "<input type='text' name='cSymbol' value='$cSymbol' required><br><br>";
        echo "<label for='entryPrice'>Entry Price:</label>";
        echo "<input type='text' name='entryPrice' value='$entryPrice' required><br><br>";
        echo "<label for='firstTarget'>First Target:</label>";
        echo "<input type='text' name='firstTarget' value='$firstTarget' required><br><br>";
        echo "<label for='secondTarget'>Second Target:</label>";
        echo "<input type='text' name='secondTarget' value='$secondTarget' required><br><br>";
        echo "<label for='stopLoss'>Stop Loss:</label>";
        echo "<input type='text' name='stopLoss' value='$stopLoss' required><br><br>";
        echo "<input type='submit' value='Update'>";
        echo "    ";
        echo '<a type="button" href="fetchdata.php"><input type="button" value="close"></a>';
       
        echo "</form>";
    } else {
        echo "Record not found.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>

</body>
</html>
