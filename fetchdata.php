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
    <title>CryptoTTTable Data</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .edit-btn, .delete-btn {
            display: inline-block;
            padding: 6px 12px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border: none;
            border-radius: 4px;
        }
        .delete-btn {
            background-color: #f44336;
        }
    </style>
</head>
<body>
<a type="button" href="form.php"><input type="button" value="add coin"></a>
<a href="logout.php"><input type="button" value="Logout"></a>
<?php
// Database connection 
require_once('database.php');

// Check if the delete action is triggered
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // Prepare the SQL statement to delete the record
    $deleteSql = "DELETE FROM cryptotable WHERE id = $deleteId";

    // Execute the deletion query
    if ($conn->query($deleteSql) === TRUE) {
        // Show alert modal
        echo "<script>
        alert('Record deleted successfully!');
        window.location.href = 'fetchdata.php';
    </script>";
       exit(); // Ensure no more code is executed after the redirect
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Prepare the SQL statement to fetch data from the table
$sql = "SELECT * FROM cryptotable";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Coin Name</th><th>Coin Symbol</th><th>Coin Price</th><th>Entry Price</th><th>First Target</th><th>Second Target</th><th>Stop Loss</th><th>Actions</th></tr>";
    
    // Loop through each row of data
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["coin_name"] . "</td>";
        echo "<td>" . $row["c_symbol"] . "</td>";
        echo "<td>";
        echo "<span id='coinPrice_" . $row["id"] . "'></span>";
        echo "</td>";
        echo "<td>" . $row["entry_price"] . "</td>";
        echo "<td>" . $row["first_target"] . "</td>";
        echo "<td>" . $row["second_target"] . "</td>";
        echo "<td>" . $row["stop_loss"] . "</td>";
        echo "<td>";
        echo "<a class='edit-btn' href='edit.php?id=" . $row["id"] . "'>Edit</a> ";
        echo "<a class='delete-btn' href='?delete_id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>";
        echo "</td>";
        echo "</tr>";
        echo "<script>
                var first_target_" . $row["id"] . " = " . $row["first_target"] . ";
                var coin_" . $row["id"] . " = '" . $row["c_symbol"] . "';

                var ws_" . $row["id"] . " = new WebSocket('wss://stream.binance.com:9443/ws/' + coin_" . $row["id"] . " + '@trade');
                var price_" . $row["id"] . " = 0;
                var old_price_" . $row["id"] . " = 0;

                ws_" . $row["id"] . ".onmessage = (event) => {
                    data_" . $row["id"] . " = JSON.parse(event.data);
                    price_" . $row["id"] . " = parseFloat(data_" . $row["id"] . ".p).toFixed(6);
                    if (price_" . $row["id"] . " > old_price_" . $row["id"] . ") {
                        document.getElementById('coinPrice_" . $row["id"] . "').style.color = 'green';
                    } else if (price_" . $row["id"] . " == old_price_" . $row["id"] . ") {
                        document.getElementById('coinPrice_" . $row["id"] . "').style.color = 'black';
                    } else {
                        document.getElementById('coinPrice_" . $row["id"] . "').style.color = 'red';
                    }
                    old_price_" . $row["id"] . " = price_" . $row["id"] . ";

                    if (parseFloat(price_" . $row["id"] . ") > first_target_" . $row["id"] . ") {
                        document.getElementById('coinPrice_" . $row["id"] . "').parentNode.parentNode.style.color = 'green';
                    } else {
                        document.getElementById('coinPrice_" . $row["id"] . "').parentNode.parentNode.style.color = 'red';
                    }
                    document.getElementById('coinPrice_" . $row["id"] . "').innerText = parseFloat(data_" . $row["id"] . ".p).toFixed(6);
                };
            </script>";
    }

    echo "</table>";
} else {
    echo "No data available in the table.";
}

// Close the database connection
$conn->close();
?>

</body>
</html>
