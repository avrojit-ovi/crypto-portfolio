<!-- modal code start here -->


<!-- Modal -->
<div class="modal right fade" id="addCoinModal" tabindex="-1" aria-labelledby="addCoinModalLabel" aria-hidden="true" data-mdb-backdrop="static" data-mdb-keyboard="true">
  <div class="modal-dialog modal-side modal-bottom-left">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCoinModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
<!-- form code start here -->
<?php require_once('./form.php'); ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <!--Coin Name input -->
  <div class="form-outline mb-4">
    <input type="text" id="form5Example1" class="form-control" name="coinName" />
    <label class="form-label" for="coinName">Coin Name</label>
  </div>
  
  <!--Coin Name input -->
  <div class="form-outline mb-4">
    <input type="text" id="form5Example1" class="form-control" name="cSymbol" />
    <label class="form-label" for="cSymbol">Coin Symbol</label>
  </div>

    <!--Coin Name input -->
  <div class="form-outline mb-4">
    <input type="text" id="form5Example1" class="form-control" name="entryPrice" />
    <label class="form-label" for="entryPrice">Entry Price</label>
  </div>
  
  <!--Coin Name input -->
  <div class="form-outline mb-4">
    <input type="text" id="form5Example1" class="form-control" name="quantity" />
    <label class="form-label" for="quantity">Coin Quantity</label>
  </div>
    
  <!--Coin Name input -->
  <div class="form-outline mb-4">
    <input type="text" id="form5Example1" class="form-control" name="firstTarget" />
    <label class="form-label" for="firstTarget">First Target</label>
  </div>
    
  <!--Coin Name input -->
  <div class="form-outline mb-4">
    <input type="text" id="form5Example1" class="form-control" name="secondTarget" />
    <label class="form-label" for="secondTarget">Second Target</label>
  </div>
    
  <!--Coin Name input -->
  <div class="form-outline mb-4">
    <input type="text" id="form5Example1" class="form-control" name="stopLoss" />
    <label class="form-label" for="stopLoss">Stop Loss</label>
  </div>
  



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