<?php
$coin = "fidausdt";
$target = 0.2247;
$entry = 3210;


?>


<!DOCTYPE html>
<html>
<head>
  <title>Crypto Coin Trade Tracking Table</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
    <center><h2>Crypto Trade Tracking Table</h2></center>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Coin Name</th>
          <th>Coin Price</th>
          <th>Entry Price</th>
          <th>First Target</th>
          <th>Second Target</th>
          <th>Stop Loss</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $coin; ?></td>
          <td>
            <div id="trade"></div>
            <script>
               var first_target = <?php echo $target; ?>;
               var coin = "<?php echo $coin; ?>";

              ws = new WebSocket('wss://stream.binance.com:9443/ws/' + coin + '@trade');
              price = 0;
              old_price = 0;
              

              ws.onmessage = (event) => {
                data = JSON.parse(event.data);
                price = parseFloat(data.p).toFixed(4);
                if (price > old_price) {
                  trade.style.color = "green";
                } else if (price == old_price) {
                  trade.style.color = "black";
                } else {
                  trade.style.color = "red";
                }
                old_price = price;

                if (parseFloat(price) > first_target) {
                  trade.parentNode.parentNode.style.color = "green";
                } else {
                  trade.parentNode.parentNode.style.color = "red";
                }
                trade.innerText = parseFloat(data.p).toFixed(4);
              }
            </script>
          </td>
          <td>0.2500</td>
          <td>0.3550</td>
          <td>0.3800</td>
          <td>0.00</td>
        </tr>
        <tr>
          <td>PHA</td>
          <td>
            <div id="trade2"></div>
            <script>
              ws2 = new WebSocket('wss://stream.binance.com:9443/ws/phausdt@trade');
              price2 = 0;
              old_price2 = 0;
              first_target2 = 0.00625;

              ws2.onmessage = (event) => {
                data2 = JSON.parse(event.data);
                price2 = parseFloat(data2.p).toFixed(5);
                if (price2 > old_price2) {
                  trade2.style.color = "green";
                } else if (price2 == old_price2) {
                  trade2.style.color = "black";
                } else {
                  trade2.style.color = "red";
                }
                old_price2 = price2;

                if (parseFloat(price2) > first_target2) {
                  trade2.parentNode.parentNode.style.color = "green";
                } else {
                  trade2.parentNode.parentNode.style.color = "red";
                }
                trade2.innerText = parseFloat(data2.p).toFixed(5);
              }
            </script>
          </td>
      <td>0.00547</td>
      <td>0.00625</td>
      <td>0.00680</td>
      <td>0.00380</td>
        </tr>
        <tr>
          <td>UMA</td>
          <td>
            <div id="trade3"></div>
            <script>
              ws3 = new WebSocket('wss://stream.binance.com:9443/ws/umausdt@trade');
              price3 = 0;
              old_price3 = 0;
              first_target3 = 1.830;

              ws3.onmessage = (event) => {
                data3 = JSON.parse(event.data);
                price3 = parseFloat(data3.p).toFixed(5);
                if (price3 > old_price3) {
                  trade3.style.color = "green";
                } else if (price3 == old_price3) {
                  trade3.style.color = "black";
                } else {
                  trade3.style.color = "red";
                }
                old_price3 = price3;

                if (parseFloat(price3) > first_target3) {
                  trade3.parentNode.parentNode.style.color = "green";
                } else {
                  trade3.parentNode.parentNode.style.color = "red";
                }
                trade3.innerText = parseFloat(data3.p).toFixed(5);
              }
            </script>
          </td>
      <td>1.620</td>
      <td>1.830</td>
      <td>2.050</td>
      <td>1.250</td>
        </tr>
        <!-- Add more rows as needed -->
      </tbody>
    </table>
  </div>

</body>
</html>
