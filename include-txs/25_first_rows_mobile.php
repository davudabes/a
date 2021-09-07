<?php
$DATABASE_HOST = "";
$DATABASE_USER = "";
$DATABASE_PASS = '';
$DATABASE_NAME = "";
?>
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
            printf("<div class='row' style='font-size: 12px;'>");     
            printf("<div class='col-2'>");  
            printf("<div class='row' style='margin-bottom: 5px;'>");  
            printf("<div class='col-12' style='text-align:left;'><strong>Name:</strong></div>");  
            printf("</div>");  
            printf("<div class='row' style='margin-bottom: 5px;'>");  
            printf("<div class='col-12' style='text-align:left;'><strong>Symbol:</strong></div>");   
            printf("</div>");  
            printf("<div class='row' style='margin-bottom: 5px;'>");  
            printf("<div class='col-12' style='text-align:left;'><strong>Contract:</strong></div>");   
            printf("</div>");     
            printf("<div class='row' style='margin-bottom: 5px;'>");  
            printf("<div class='col-12' style='text-align:left;'><strong>Deploy:</strong></div>");   
            printf("</div>");                                                                                                  
            printf("</div>");  
            printf("<div class='col-10'>");  
            printf("<div class='row' style='margin-bottom: 5px;'>");  
            printf("<div class='col-12' style='text-align:left;font-family: Blinker-semiBold, sans-serif;'>".$row[1]."</div>");  
            printf("</div>");      
            printf("<div class='row' style='margin-bottom: 5px;'>");                           
            printf("<div class='col-12' style='text-align:left;font-family: blinker-regular , sans-serif;'>$".$row[2]."</div>");  
            printf("</div>");  
            printf("<div class='row' style='margin-bottom: 5px;'>");      
            printf("<div class='col-12' id='last_contract_mobile' style='text-align:left;font-family: blinker-light  , sans-serif;'>".$row[3]."</div>");     
            printf("</div>");  
            printf("<div class='row' style='margin-bottom: 5px;'>");  
            printf("<div class='col-12 count' data-increment='".$asdasd."' style='text-align:left;font-family: blinker-semiBold , sans-serif;'>0</div>");  
            printf("</div>");       
            printf("</div>");    
            printf("<div class='col-12 align-self-center' style='text-align:center;padding-left:0px;padding-right:0px;'><a href='https://app.sushi.com/swap?outputCurrency=".$row[3]."'><button type='button' style='background-color: #25fedf;border-color: #ff1c76;'>Buy ".$row[1]."</button></a></div>");   
            printf("</div>");   
            printf("<hr>");
        }
    } else {
            $time = $row[6] . ' ' . $row[5];
            printf("<div class='row' style='font-size: 12px;'>");     
            printf("<div class='col-2'>");  
            printf("<div class='row' style='margin-bottom: 5px;'>");  
            printf("<div class='col-12' style='text-align:left;'><strong>Name:</strong></div>");  
            printf("</div>");  
            printf("<div class='row' style='margin-bottom: 5px;'>");  
            printf("<div class='col-12' style='text-align:left;'><strong>Symbol:</strong></div>");   
            printf("</div>");  
            printf("<div class='row' style='margin-bottom: 5px;'>");  
            printf("<div class='col-12' style='text-align:left;'><strong>Contract:</strong></div>");   
            printf("</div>");     
            printf("<div class='row' style='margin-bottom: 5px;'>");  
            printf("<div class='col-12' style='text-align:left;'><strong>Deploy:</strong></div>");   
            printf("</div>");                                                                                                 
            printf("</div>");  
            printf("<div class='col-10'>");  
            printf("<div class='row' style='margin-bottom: 5px;'>");  
            printf("<div class='col-12' style='text-align:left;font-family: Blinker-semiBold, sans-serif;'>".$row[1]."</div>");  
            printf("</div>");      
            printf("<div class='row' style='margin-bottom: 5px;'>");                           
            printf("<div class='col-12' style='text-align:left;font-family: blinker-regular , sans-serif;'>$".$row[2]."</div>");  
            printf("</div>");  
            printf("<div class='row' style='margin-bottom: 5px;'>");      
            printf("<div class='col-12' id='last_contract_mobile' style='text-align:left;font-family: blinker-light  , sans-serif;'>".$row[3]."</div>");     
            printf("</div>");  
            printf("<div class='row' style='margin-bottom: 5px;'>");  
            printf("<div class='col-12 count' data-increment='".$asdasd."' style='text-align:left;font-family: blinker-semiBold , sans-serif;'>0</div>");  
            printf("</div>");         
            printf("</div>");    
            printf("<div class='col-12 align-self-center' style='text-align:center;padding-left:0px;padding-right:0px;'><a href='https://app.sushi.com/swap?outputCurrency=".$row[3]."'><button type='button' style='background-color: #25fedf;border-color: #ff1c76;'>Buy ".$row[1]."</button></a></div>");   
            printf("</div>");   
            printf("<hr>");
      }
}
?>      