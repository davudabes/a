<?php
$mysql = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$database_gather = "SELECT * FROM coinTracker ORDER BY `id` DESC LIMIT 25";
$database_results = mysqli_query($mysql, $database_gather);
/* fetch associative array */
while ($row = mysqli_fetch_row($database_results)) {
    $database_gather_reddit = "SELECT * FROM coinTrackerReddit WHERE `coinName` LIKE '%".$row[1]."%' LIMIT 1";
    $start = new DateTime('NOW');
    $start->modify('+1 hour');
    $end = new DateTime($row[7]);
    $asdasd = $start->getTimestamp() - $end->getTimestamp(); // output: 284169600    
    if(strlen($row[1]) > 10){
        $name_fix = substr($row[1], 0, 10) ."...";
    } else {
        $name_fix = $row[1];
    }
    if(strlen($row[2]) > 8){
        $symbol_fix = "$". trim(substr($row[2], 0, 8)) ."...";
    } else {
        $symbol_fix = "$". trim($row[2]);
    }
    $result = $mysql->query($database_gather_reddit);
    if ($result->num_rows > 0) {
        // output data of each row
        while($rowz = $result->fetch_assoc()) {
            $time = $row[6] . ' ' . $row[5];
            if($rowz['coinTelegram'] == ''){
                $socials = "<img src='https://www.binancesmartrat.com/img/tg-no.png' style='height: 20px;'>";
            } else {
                $socials = "<img src='https://www.binancesmartrat.com/img/tg-yes.png' style='height: 20px;'>";
            }
            printf("<div class='row' style='font-size: 13px;'>");
            printf("<div class='col-2 align-self-center' style='text-align:left;padding-right:0px;font-family: Blinker-semiBold, sans-serif;'>".$name_fix."</div>"); 
            printf("<div class='col-1 align-self-center' style='text-align:left;padding-left:0px;padding-right:0px;font-family: blinker-regular , sans-serif;'>".$symbol_fix."</div>"); 
            printf("<div class='col-6 align-self-center' id='last_contract' style='text-align:center;padding-left:0px;padding-right:0px;font-family: blinker-light  , sans-serif;'>".$row[3]."</div>");                             
            printf("<div class='col-1 align-self-center count' data-increment='".$asdasd."' style='text-align:center;padding-left:0px;padding-right:0px;font-family: blinker-semiBold , sans-serif;'>0</div>"); 
            printf("<div class='col-2 align-self-center' style='text-align:center;padding-left:0px;padding-right:0px;'><a href='https://app.sushi.com/swap?outputCurrency=".$row[3]."'><button type='button' style='background-color: #25fedf;border-color: #ff1c76;'>Buy ".$symbol_fix."</button></a></div>");                 
            printf("</div>"); 
            printf("<hr style='margin-top:5px;margin-bottom:6px'>"); 
        }
    } else {
            $time = $row[6] . ' ' . $row[5];
            printf("<div class='row' style='font-size: 13px;'>");  
            printf("<div class='col-2 align-self-center' style='text-align:left;padding-right:0px;font-family: Blinker-semiBold, sans-serif;'>".$name_fix."</div>"); 
            printf("<div class='col-1 align-self-center' style='text-align:left;padding-left:0px;padding-right:0px;font-family: blinker-regular , sans-serif;'>".$symbol_fix."</div>"); 
            printf("<div class='col-6 align-self-center' id='last_contract' style='text-align:center;padding-left:0px;padding-right:0px;font-family: blinker-light  , sans-serif;'>".$row[3]."</div>");                               
            printf("<div class='col-1 align-self-center count' data-increment='".$asdasd."' style='text-align:center;padding-left:0px;padding-right:0px;font-family: blinker-semiBold , sans-serif;'>0</div>");  
            printf("<div class='col-2 align-self-center' style='text-align:center;padding-left:0px;padding-right:0px;'><a href='https://app.sushi.com/swap?outputCurrency=".$row[3]."'><button type='button' style='background-color: #25fedf;border-color: #ff1c76;'>Buy ".$symbol_fix."</button></a></div>");                
            printf("</div>"); 
            printf("<hr style='margin-top:5px;margin-bottom:6px'>"); 
      }
}
?>     

   
