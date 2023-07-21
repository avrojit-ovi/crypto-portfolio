<!-- modal code start here -->


<!-- Modal -->

<div class="modal fade" id="addCoinModal" aria-hidden="true" aria-labelledby="addCoinModalLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCoinModalLabel">Add Coin Data</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
<!-- form code start here -->
<?php


// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: ../../login.php");
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
         window.location.href = '{$baseURL}fetchdata.php';
     </script>";
        exit(); // Ensure no more code is executed after the redirect
    } else {
        echo "Error inserting data: " . $conn->error;
    }


    
    // Close the database connection
   
}
?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <!--Coin Name input -->
  <div class="form-outline mb-4">
    <input type="text" id="form5Example1" class="form-control" name="coinName" placeholder="Coin Name"/>
  </div>
  
  <!--Coin Name input -->
  <div class="form-outline mb-4">
    <input type="text" id="form5Example1" class="form-control" name="cSymbol" placeholder="Coin Symbol" />
  </div>

    <!--Coin Name input -->
  <div class="form-outline mb-4">
    <input type="text" id="form5Example1" class="form-control" name="entryPrice" placeholder="Entry Price"/>
  </div>
  
  <!--Coin Name input -->
  <div class="form-outline mb-4">
    <input type="text" id="form5Example1" class="form-control" name="quantity" placeholder="Coin Quantity"/>
  </div>
    
  <!--Coin Name input -->
  <div class="form-outline mb-4">
    <input type="text" id="form5Example1" class="form-control" name="firstTarget" placeholder="First Target"/>
   
  </div>
    
  <!--Coin Name input -->
  <div class="form-outline mb-4">
    <input type="text" id="form5Example1" class="form-control" name="secondTarget" placeholder="Second Target"/>
    
  </div>
    
  <!--Coin Name input -->
  <div class="form-outline mb-4">
    <input type="text" id="form5Example1" class="form-control" name="stopLoss" placeholder="Stop Loss"/>
    
  </div> 
  
<!--Coin Name input -->
<div class="form-outline mb-4">
    <input type="datetime-local" id="dateNtime" class="form-control" name="dateNtime" disabled>
</div>
  

<!-- Input for Date and Time -->
   
   
    

  <!-- Submit button -->
  
  


<!-- form code ends here -->

      </div>
      <div class="modal-footer">
      <a type="button" href="fetchdata.php" class="btn btn-secondary" data-mdb-dismiss="modal">close</a>
      <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- modal code end here -->

<script>
// Function to format the date and time with Bangladesh timezone (GMT+6)
function formatDate(date) {
    const padZero = (num) => (num < 10 ? '0' + num : num);
    const year = date.getFullYear();
    const month = padZero(date.getMonth() + 1);
    const day = padZero(date.getDate());
    const hours = padZero(date.getHours());
    const minutes = padZero(date.getMinutes());
    return `${year}-${month}-${day}T${hours}:${minutes}`;
}

// Get the input field
const datetimeInput = document.getElementById("dateNtime");

// Set the initial value
datetimeInput.value = formatDate(new Date());

// Update the value every minute to show the current date and time in Bangladesh timezone
setInterval(() => {
    datetimeInput.value = formatDate(new Date());
}, 60000); // 60000 milliseconds = 1 minute
</script>

