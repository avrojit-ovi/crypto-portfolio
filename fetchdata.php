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
    <title>Edit Crypto Trade Tracking Table Data</title>
    <?php require_once('includes/bootstrap-css.php'); ?>
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
        td#pl_row {
            font-weight: bold;
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
    <br>
    <a type="button" class="btn btn-info" data-mdb-toggle="modal" data-mdb-target="#addCoinModal">ADD COIN</a>
    <a href="logout.php"><input type="button" class="btn btn-info" value="Logout"></a><br><br>


   <?php require_once('./includes/modals/addmodal.php') ?>

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
        echo "<table class='table table-hover table-bordered'>";
        echo "<tr><th>ID</th><th>Coin Name</th><th>Coin Symbol</th><th>Coin Price</th><th>Entry Price</th><th>Coin Quantity</th><th>% Change</th><th>P&L</th><th>First Target</th><th>Second Target</th><th>Stop Loss</th><th>Actions</th></tr>";

        // Loop through each row of data
        while ($row = $result->fetch_assoc()) {
            $entryPrice = floatval($row["entry_price"]);
            $coinPrice = 0; // Initialize coin_price to 0


            // this code is for when a specific column's coin price is higher then first target
            echo "<tr";
            if (isset($row["c_price"])) {
                if (floatval($row["c_price"]) > floatval($row["first_target"])) {
                    echo " class='table-success'";
                } elseif (floatval($row["c_price"]) < floatval($row["stop_loss"])) {
                    echo " class='table-danger'";
                }
            }
            echo ">";

            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["coin_name"] . "</td>";
            echo "<td>" . $row["c_symbol"] . "</td>";
            echo "<td>";
            echo "<span id='coinPrice_" . $row["id"] . "'></span>";
            echo "</td>";
            echo "<td>" . $row["entry_price"] . "</td>";
            echo "<td>" . $row["quantity"] . "</td>";
            echo "<td id='change_" . $row["id"] . "'></td>";
            echo "<td id='pl_row" . $row["id"] . "'></td>";
            echo "<td>" . $row["first_target"] . "</td>";
            echo "<td>" . $row["second_target"] . "</td>";
            echo "<td>" . $row["stop_loss"] . "</td>";
            echo "<td>";
            echo "<a class='edit-btn btn btn-success' href='edit.php?id=" . $row["id"] . "'><i class='fas fa-pen-to-square'></i></a> ";
            echo "<a class='delete-btn btn btn-danger' href='?delete_id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this record?\")'><i class='far fa-trash-can'></i></a>";
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

                // Calculate and update % Change and P&L
                coinPrice_" . $row["id"] . " = parseFloat(data_" . $row["id"] . ".p);
                var change_" . $row["id"] . " = ((coinPrice_" . $row["id"] . " - " . $entryPrice . ") / " . $entryPrice . ") * 100;
                var pl_row" . $row["id"] . " = (coinPrice_" . $row["id"] . " - " . $entryPrice . ") * " . $row["quantity"] . ";
                document.getElementById('change_" . $row["id"] . "').innerText = change_" . $row["id"] . ".toFixed(2) + '%';
                document.getElementById('pl_row" . $row["id"] . "').innerText = pl_row" . $row["id"] . ".toFixed(6) + ' $';
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
    <?php require_once('includes/bootstrap-js.php'); ?>
    
</body>
</html>
