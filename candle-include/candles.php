<?php
$candle_time = $_GET['time'];
if($candle_time == ''){
  $candle_time = 15;
}
?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/candle-include/data_get.php';?>

<script>
var dates = [<?php echo $dates; ?>];
var price = [<?php echo $price; ?>];
var datetime = [<?php echo $datetime; ?>];
var price_array = []
for(i=0;i<dates.length;i++){
    price_array.push([datetime[i].replace("-","/").replace("-","/"),dates[i],price[i]]);
}
console.log(price_array)
var grouped_price = [];
var grouped_prices = [];
var final_grouping = [];
var counting_segments = 0;

for(j=0;j<price_array.length;j++){
    if(counting_segments == <?php echo $candle_time; ?>){
        final_grouping.push([price_array[j][0],[grouped_prices]])
        var grouped_prices = [];
        counting_segments = 0
    }
    if(counting_segments == 0){
        grouped_prices.push(price_array[j][2])
        counting_segments = counting_segments + 1;
    } else {
        grouped_prices.push(price_array[j][2])
        counting_segments = counting_segments + 1;
    }
}

function roundTimeQuarterHour(time) {
    var timeToReturn = new Date(time);
    timeToReturn.setMilliseconds(Math.round(timeToReturn.getMilliseconds() / 1000) * 1000);
    timeToReturn.setSeconds(Math.round(timeToReturn.getSeconds() / 60) * 60);
    timeToReturn.setMinutes(Math.round(timeToReturn.getMinutes() / 15) * 15);
    return timeToReturn;
}

var new_array = []
for(k=0;k<final_grouping.length;k++){
    var final_date = Date.parse(final_grouping[k][0])
    var last_price= final_grouping[k][1][0][final_grouping[k][1][0].length-1]
    var first_price= final_grouping[k][1][0][0]
    var max_price = Math.max(...final_grouping[k][1][0])
    var min_price = Math.max(...final_grouping[k][1][0])
    new_array.push({x: final_date,  y: [last_price,max_price,min_price,first_price]})
}
console.log(new_array)
</script>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>CandleStick Chart</title>

    <link href="assets/styles.css" rel="stylesheet" />

    <style>
      
        #chart {
      max-width: 100%;
      margin: 35px auto;
    }
      
    </style>

    <script>
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"><\/script>'
        )
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js"><\/script>'
        )
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"><\/script>'
        )
    </script>

    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    

    <script>
      // Replace Math.random() with a pseudo-random number generator to get reproducible results in e2e tests
      // Based on https://gist.github.com/blixt/f17b47c62508be59987b
      var _seed = 42;
      Math.random = function() {
        _seed = _seed * 16807 % 2147483647;
        return (_seed - 1) / 2147483646;
      };
    </script>

    <script src="assets/ohlc.js"></script>
  </head>

  <body>
     <div id="chart" style="min-height: 715px;margin: 0px;"></div>

    <script>
      
        var options = {
          series: [{
          data: new_array
        }],
          chart: {
          type: 'candlestick',
          height: 700
        },
        title: {
          text: 'CandleStick Chart',
          align: 'left'
        },
        xaxis: {
          type: 'datetime'
        },
        yaxis: {
          tooltip: {
            enabled: true
          }
        },
        theme: {
          mode: "#171717"
        },
        grid: {
          show: false
        },
        tooltip:{
          enabled: true,
          theme: "dark"
        },
        zoom: {
    enabled: true,
    autoScaleYaxis: true
},responsive: [{
    breakpoint: 1000,
    options: {},
}]           
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>

    
  </body>
</html>
