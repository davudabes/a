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
          <a href="https://arbimoon.xyz/"><img src="https://arbicharts.com/img/top-ad.png" style="max-width:880px;width:100%;"></a>
        </div>
      </div>
      <div class="row">
        <div class="d-none d-lg-block col-lg-2">
          <a href="https://thehoneypot.finance/"><img src="https://arbicharts.com/img/honeypot-side.jpg"></a>
        </div>
        <div class="col-12 col-lg-8" style="text-align:center;">
          <div class="row" style="padding-bottom:2rem;">
            <div class="col-6 col-lg-2">
              <a href="https://arbicharts.com/?time=1"><button type="button" class="btn btn-secondary" style="width: 100%;">1 MIN</button></a>
            </div>
            <div class="col-6 col-lg-2">
              <a href="https://arbicharts.com/?time=5"><button type="button" class="btn btn-secondary" style="width: 100%;">5 MIN</button></a>
            </div>
            <div class="col-6 col-lg-2">
              <a href="https://arbicharts.com/?time=15"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top:3px;">15 MIN</button></a>
            </div>
            <div class="col-6 col-lg-2">
              <a href="https://arbicharts.com/?time=30"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top:3px;">30 MIN</button></a>
            </div>
            <div class="col-6 col-lg-2">
              <a href="https://arbicharts.com/?time=60"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top:3px;">60 MIN</button></a>
            </div>
            <div class="col-6 col-lg-2">
              <a href="https://arbicharts.com/?time=120"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top:3px;">120 MIN</button></a>
            </div>            
          </div>
          <div class="row">
            <div class="col-12 col-lg-6">
              <h1 style="font-size: 2rem;text-align: left;margin-bottom: 0.5rem;">ARBIMOON $AMOON</h1>
              <?php include $_SERVER['DOCUMENT_ROOT'].'/include/amoon.php';?>
              <a href="https://app.sushi.com/swap?inputCurrency=0x1a7BD9EDC36Fb2b3c0852bcD7438c2A957Fd7Ad5"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;">Buy ArbiMoon</button></a>
            </div>

            <div class="col-12 col-lg-6">
              <h1 style="font-size: 2rem;text-align: left;margin-bottom: 0.5rem;">THEHONEYPOT $HONEY</h1>
              <?php include $_SERVER['DOCUMENT_ROOT'].'/include/honeypot.php';?>
              <a href="https://app.sushi.com/swap?outputCurrency=0xdE31e75182276738B0c025daa8F80020A4F2fbFE"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;">Buy Honey</button></a>
            </div>
<!--            <div class="col-12 col-lg-6">
              <h1 style="font-size: 2rem;text-align: left;margin-bottom: 0.5rem;">GMX $GMX</h1>

              <a href="https://app.sushi.com/swap?inputCurrency=&outputCurrency=0xfc5A1A6EB076a2C7aD06eD22C90d7E710E35ad0a"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;">Buy GMX</button></a>
            </div> -->
            <div class="col-12 col-lg-6">
              <h1 style="font-size: 2rem;text-align: left;margin-bottom: 0.5rem;">ARBYS $ARBYS</h1>
              <?php include $_SERVER['DOCUMENT_ROOT'].'/include/arbys.php';?>
              <a href="https://app.sushi.com/swap?outputCurrency=0x86A1012d437BBFf84fbDF62569D12d4FD3396F8c"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;">Buy Arbys</button></a>
            </div>
            <div class="col-12 col-lg-6">
              <h1 style="font-size: 2rem;text-align: left;margin-bottom: 0.5rem;">ARBIDOGE $ADOGE</h1>
              <?php include $_SERVER['DOCUMENT_ROOT'].'/include/adoge.php';?>
              <a href="https://app.sushi.com/swap?outputCurrency=0x155f0dd04424939368972f4e1838687d6a831151"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;">Buy ArbiDoge</button></a>
            </div>  

            <div class="col-12 col-lg-6">
              <h1 style="font-size: 2rem;text-align: left;margin-bottom: 0.5rem;">ARBIAPU $APU</h1>
              <?php include $_SERVER['DOCUMENT_ROOT'].'/include/arbiapu.php';?>
              <a href="https://app.sushi.com/swap?inputCurrency=&outputCurrency=0x6FA81f74228b06b7956Bfa80382e309E4B3b4946"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;">Buy ArbiApu</button></a>
            </div>  

            <div class="col-12 col-lg-6">
              <h1 style="font-size: 2rem;text-align: left;margin-bottom: 0.5rem;">ARBIBOMB $ARIB</h1>
              <?php include $_SERVER['DOCUMENT_ROOT'].'/include/arib.php';?>
              <a href="https://app.sushi.com/swap?inputCurrency=&outputCurrency=0x631E77a55a6dDf7b9a95D5a1a1bCaB6D938C6747"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;">Buy ArbiBomb</button></a>
            </div>
            <div class="col-12 col-lg-6">
              <h1 style="font-size: 2rem;text-align: left;margin-bottom: 0.5rem;">STATICSHOCK $STS</h1>
              <?php include $_SERVER['DOCUMENT_ROOT'].'/include/sts.php';?>
              <a href="https://app.sushi.com/swap?inputCurrency=&outputCurrency=0x72ce55c986854F4ef3Bd6d2AD524F172f6d3A6c4"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;">Buy StaticShock</button></a>
            </div>            
            <div class="col-12 col-lg-6">
              <h1 style="font-size: 2rem;text-align: left;margin-bottom: 0.5rem;">ARBIUFO $AUFO</h1>
              <?php include $_SERVER['DOCUMENT_ROOT'].'/include/aufo.php';?>
              <a href="https://app.sushi.com/swap?inputCurrency=ETH&outputCurrency=0x689df05c0447e70affaa66babf0e6156414c2bc6"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;">Buy ArbiUFO</button></a>
            </div>
            <div class="col-12 col-lg-6">
              <h1 style="font-size: 2rem;text-align: left;margin-bottom: 0.5rem;">ARBCAT $ACAT</h1>
              <?php include $_SERVER['DOCUMENT_ROOT'].'/include/acat.php';?>
              <a href="https://app.sushi.com/swap?inputCurrency=ETH&outputCurrency=0x08f6d3c2f7f99dcd276ace4113ac11d65566ba3d"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;">Buy ArbCat</button></a>
            </div>   
            <div class="col-12 col-lg-6">
              <h1 style="font-size: 2rem;text-align: left;margin-bottom: 0.5rem;">AKITAARBI $AKITAARBI</h1>
              <?php include $_SERVER['DOCUMENT_ROOT'].'/include/akitaarbi.php';?>
              <a href="https://app.sushi.com/swap?inputCurrency=0xd786ca0a3f6caa22938cd751b905c39f84555bcb"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;">Buy AkitaArbi</button></a>
            </div>  
            
            <div class="col-12 col-lg-6">
              <h1 style="font-size: 2rem;text-align: left;margin-bottom: 0.5rem;">ARB MARS $ARBM</h1>
              <?php include $_SERVER['DOCUMENT_ROOT'].'/include/arbm.php';?>
              <a href="https://app.sushi.com/swap?outputCurrency=0x13a1c16a36dc5cba6aff21cb6839021c86f671b1"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;">Buy ARB MARS</button></a>
            </div>            

            <div class="col-12 col-lg-6">
              <h1 style="font-size: 2rem;text-align: left;margin-bottom: 0.5rem;">CHAINLINK $LINK</h1>
              <?php include $_SERVER['DOCUMENT_ROOT'].'/include/chainlink.php';?>
              <a href="https://app.sushi.com/swap?inputCurrency=0xf97f4df75117a78c1a5a0dbb814af92458539fb4"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;">Buy ChainLink</button></a>
            </div>  
            <div class="col-12 col-lg-6">
              <h1 style="font-size: 2rem;text-align: left;margin-bottom: 0.5rem;">SUSHITOKEN $SUSHI</h1>
              <?php include $_SERVER['DOCUMENT_ROOT'].'/include/sushitoken.php';?>
              <a href="https://app.sushi.com/swap?inputCurrency=0xd4d42f0b6def4ce0383636770ef773390d85c61a"><button type="button" class="btn btn-secondary" style="width: 100%;margin-top: 6px;margin-bottom: 26px;background-color: #20fcf2;color: black;font-family: 'Blinker', sans-serif;">Buy Sushitoken</button></a>
            </div>   
            <div class="col-12 col-lg-6">
              <h1 style="font-size: 2rem;text-align: left;margin-bottom: 0.5rem;">WRAPPED ETHER $WETH</h1>
              <?php include $_SERVER['DOCUMENT_ROOT'].'/include/wrappedether.php';?>
            </div>   
          </div>
        </div>
        <div class="d-none d-lg-block col-lg-2" style="text-align: right;">
          <a href="https://arbimoon.xyz/"><img src="https://arbicharts.com/img/side-ad.png"></a>
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