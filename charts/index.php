<?php
$DATABASE_HOST = '';
$DATABASE_USER = '';                       
$DATABASE_PASS = '';
$DATABASE_NAME = '';
$ethprice_link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$ethprice_query = "SELECT * FROM `all_coins` WHERE `coin_name` LIKE 'wrappedether' ORDER BY `all_coins`.`datetime` DESC LIMIT 1";
$ethprice_result = mysqli_query($ethprice_link, $ethprice_query);
while ($ethprice_row = mysqli_fetch_row($ethprice_result)) {
    $eth_price = $ethprice_row[1];
}

?>

<!doctype html>
<style>
@font-face {
  font-family: NightMachine;
  src: url(https://arbicharts.com/include/NightMachine.otf);
}
@import url('https://fonts.googleapis.com/css2?family=Blinker:wght@300&display=swap');
</style>
<html lang="en">
  <head>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <title>ArbiCharts</title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-206690009-1"></script>    
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-206690009-1');
    </script>
    <script>
      setInterval(function () {
        var url_desktop = 'https://arbicharts.com/candle-include/after_txs.php';
            $.ajax({
                url: url_desktop,
                success: function (data) {
                    $('#updates').prepend(data);
                }
            });      
        }, 10000);
      </script>

  </head>
  <body style="background-color: #171717;color: #FDFBF9;">
    <div class="container">
      <div class="row">
        <div class="col-12" style="text-align:center;padding-top:3rem;">
          <span style="font-size: 3.5rem;font-family: nightmachine;">ArbiCharts</span>
          <div style="margin-top: -28px;">
            <span style="font-family: nightmachine;margin-left: 29%;">by <span style="color:#20fcf2;">Arbimoon</span></span>
          </div>
        </div>      
      </div>
      <div class="row">
        <div class="col-12" style="text-align:center;padding-top:3rem;padding-bottom:3rem;">
          <a href="https://arbimoon.xyz/"><img src="https://arbicharts.com/img/arbicharts-top.jpg" style="max-width:880px;width:100%;"></a>
        </div>
      </div>
      <div class="row">
        <div class="d-none d-lg-block col-lg-2">
          <a href="https://thehoneypot.finance/"><img src="https://arbicharts.com/img/honeypot-side.jpg"></a>
        </div>
        

        <div class="col-12 col-lg-8" style="text-align:center;">
          <div class="col-12">
            <?php $contract = !empty( $_GET['contract'] ) ? $_GET['contract'] : ''; ?>
            <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <select class="form-control" name="contract" id="salecontract" style="min-width: 300px;display: initial;width: auto;">
                <option value="amoon" <?php echo $contract == 'amoon' ? 'selected' : ''; ?>>amoon</option>
                <option value="adoge" <?php echo $contract == 'adoge' ? 'selected' : ''; ?>>adoge</option>
                <option value="sts" <?php echo $contract == 'sts' ? 'selected' : ''; ?>>sts</option>
                <option value="arbitmoon" <?php echo $contract == 'arbitmoon' ? 'selected' : ''; ?>>arbitmoon</option>
                <option value="arib" <?php echo $contract == 'arib' ? 'selected' : ''; ?>>arib</option>
                <option value="aufo" <?php echo $contract == 'aufo' ? 'selected' : ''; ?>>aufo</option>
                <option value="acat" <?php echo $contract == 'acat' ? 'selected' : ''; ?>>acat</option>
                <option value="akitaarbi" <?php echo $contract == 'akitaarbi' ? 'selected' : ''; ?>>akitaarbi</option>
                <option value="chainlink" <?php echo $contract == 'chainlink' ? 'selected' : ''; ?>>chainlink</option>
                <option value="sushitoken" <?php echo $contract == 'sushitoken' ? 'selected' : ''; ?>>sushitoken</option>
                <option value="wrappedether" <?php echo $contract == 'wrappedether' ? 'selected' : ''; ?>>wrappedether</option>
                <option value="honeypot" <?php echo $contract == 'honeypot' ? 'selected' : ''; ?>>honeypot</option>
                <option value="arbys" <?php echo $contract == 'arbys' ? 'selected' : ''; ?>>arbys</option>
                <option value="arbmars" <?php echo $contract == 'arbmars' ? 'selected' : ''; ?>>arbmars</option>
                <option value="arbimars" <?php echo $contract == 'arbimars' ? 'selected' : ''; ?>>arbimars</option>
                <option value="gmx" <?php echo $contract == 'gmx' ? 'selected' : ''; ?>>gmx</option>
              </select>
              <button type="submit" class="btn btn-secondary">Submit</button>

          </div>
          <div class="col-12" style="align-items: righ;text-align: left;">
              <input class="btn btn-secondary" style="margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;" type="submit" value="5" name="time"/>
              <input class="btn btn-secondary" style="margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;" type="submit" value="15" name="time"/>
              <input class="btn btn-secondary" style="margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;" type="submit" value="30" name="time"/>
              <input class="btn btn-secondary" style="margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;" type="submit" value="60" name="time"/>
              <input class="btn btn-secondary" style="margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;" type="submit" value="120" name="time"/>
          </form>
          </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/candle-include/candles.php';?>
        <div class="col-12" style="align-items: righ;text-align: left;">
          <div class="row">
            <div class="col-12 col-lg-2"><strong>Type</strong></div>
            <div class="col-12 col-lg-3"><strong>Tokens</strong></div>
            <div class="col-12 col-lg-3"><strong>Price</strong></div>
            <div class="col-12 col-lg-2"><strong>Time</strong></div>
            <div class="col-12 col-lg-2"><strong>Tx</strong></div>
          </div>
          <hr>
          <div id="updates"></div>
          <?php include $_SERVER['DOCUMENT_ROOT'].'/candle-include/txs.php';?>
        </div>
        </div>


        
        <div class="d-none d-lg-block col-lg-2" style="text-align: right;">
          <a href="https://arbimoon.xyz/"><img src="https://arbicharts.com/img/arbicharts-side.jpg"></a>
        </div>        
      </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>




  <footer class="footer mt-auto py-3 bg-dark" style="margin-top: 3rem!important;">
  <div class="container">
    <span class="text-muted">©ARBICHARTS by ArbiMoon</span>
    <span class="text-muted" style="float:right">For banner advertisement inquires, contact: info@arbicharts.com</span>
  </div>
</footer>

</html>