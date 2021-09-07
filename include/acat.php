<?php
$acat_link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$acat_query = "SELECT * FROM `all_coins` WHERE `coin_name` LIKE 'acat' ORDER BY `all_coins`.`datetime` DESC LIMIT 1440";
$acat_result = mysqli_query($acat_link, $acat_query);
/* fetch associative array */

while ($acat_row = mysqli_fetch_row($acat_result)) {
    $acat_dates .= '"'.$acat_row[0]. '",';
    $acat_price .= $acat_row[1]. ","; 
}

$timer = $_GET['time'];

if($timer == ''){
    $timer = '30';
}
?>
<script>
    var ppprice = "<?php echo $acat_price; ?>";
    var ppppsplitprice = ppprice.split(",")
    var b = ppppsplitprice.splice(-1)
    var c = ppppsplitprice[0] * <?php echo $eth_price ?>;
    var d = c * 888888888
</script>
<div><span style="float:left;color: #20fcf2;margin-bottom: 0.6rem;">Price: <span style="color:white;"><script>document.write(ppppsplitprice[0])</script></span></span>
<span style="float:right;color: #20fcf2">Mcap: <span style="color:white;">$<script>document.write(d.toLocaleString())</script></span>
</div>
<canvas id="acat_Chart" style="width: 600px;max-width: 600px;display: block;height: 300px;margin: 0 auto;"></canvas>

<script>
var php_dates = '<?php echo $acat_dates; ?>';
var splitdates = php_dates.split(",")
var php_price = "<?php echo $acat_price; ?>";
var splitprice = php_price.split(",")

var a = splitdates.splice(-1)
var b = splitprice.splice(-1)

splitdates = splitdates.reverse();
splitdatesList = []
splitprice = splitprice.reverse();
splitpriceList = []
mins = <?php echo $timer; ?>;
if(mins == ''){
    min = 30;
}else{
    min = <?php echo $timer; ?>;
}

for(i=0;i<splitdates.length;i=i+min){
    cleansplit = splitdates[i].replace('"','').replace('"','')
    cleansplit = cleansplit.split(":")
    splitdatesList.push(cleansplit[0] + ":" + cleansplit[1])
}

for(i=0;i<splitprice.length;i=i+min){
    splitpriceList.push(splitprice[i])
}

var xValues = splitdatesList;

new Chart("acat_Chart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{ 
      data: splitpriceList,
      borderColor: "#ff1c76",
      fill: false
    }]
  },
  options: {
    scales: {
        xAxes: [{
            ticks: {
                    maxRotation: 90,
                    minRotation: 90,
                    autoSkip: true,
                    maxTicksLimit: 20
            },
            gridLines: {
                drawOnChartArea: false
            }
        }],
        yAxes: [{
            gridLines: {
                drawOnChartArea: false
            },
            ticks: {
                min: Math.min.apply(this, splitprice) - 0.00000000000001,
                max: Math.max.apply(this, splitprice) + 0.00000000000001
            }
        }]
    },      
    legend: {display: false}
  },


});
</script>