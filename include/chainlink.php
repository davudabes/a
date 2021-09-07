<?php
$chainlink_link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$chainlink_query = "SELECT * FROM `all_coins` WHERE `coin_name` LIKE 'chainlink' ORDER BY `all_coins`.`datetime` DESC LIMIT 1440";
$chainlink_result = mysqli_query($chainlink_link, $chainlink_query);
/* fetch associative array */

while ($chainlink_row = mysqli_fetch_row($chainlink_result)) {
    $chainlink_dates .= '"'.$chainlink_row[0]. '",';
    $chainlink_price .= $chainlink_row[1]. ","; 
}

$timer = $_GET['time'];

if($timer == ''){
    $timer = '30';
}
?>

<canvas id="chainlink_Chart" style="width: 600px;max-width: 600px;display: block;height: 300px;margin: 0 auto;"></canvas>

<script>
var php_dates = '<?php echo $chainlink_dates; ?>';
var splitdates = php_dates.split(",")
var php_price = "<?php echo $chainlink_price; ?>";
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

new Chart("chainlink_Chart", {
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