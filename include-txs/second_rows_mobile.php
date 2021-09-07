<?php

$DATABASE_HOST = "";
$DATABASE_USER = "";
$DATABASE_PASS = '';
$DATABASE_NAME = "";

function seconds2human($time) {
    $dtNow = new DateTime('now');
    $dtToCompare = new DateTime($time);
    $diff = $dtNow->diff($dtToCompare);
    $ss = ((($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i)*60 + $diff->s;

    $s = $ss%60;
    $m = floor(($ss%3600)/60);
    $h = floor(($ss%86400)/3600);
    $d = floor(($ss%2592000)/86400);
    $M = floor($ss/2592000);
    if($M == 1){
        return '1 Month';
    } elseif($M > 1){
        return $M . ' Months';
    } else {
        if($d == 1){
            return '1 day';
        } elseif($d > 1){
            return $d . ' days';
        } else {
            if($h == 1){
                return '1 hour';
            } elseif($h > 1){
                return $h . ' hours';
            } else {
                if($m == 1){
                    return '1min';
                } elseif($m > 1){
                    return $m . 'mins';
                } else {
                    if($s == 1){
                        return '1s';
                    } elseif($s > 1){
                        return $s . 's';
                    } elseif($s < 5) {
                        return '0s';
                    } else {
                        return '0s';
                    }
                }
            }
        }
    }
}

?>
<?php
    $DATABASE_HOST = "67.227.154.184";
    $DATABASE_USER = "krakenst_arbimoo";
    $DATABASE_PASS = '.Db(XaG$F5{X';
    $DATABASE_NAME = "krakenst_hreflang";

    $date_time = $_GET["contract"];

    $mysql = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    $database_gather = "SELECT * FROM coinTracker ORDER BY `id` DESC LIMIT 1";
    $database_results = mysqli_query($mysql, $database_gather);
    while ($row = mysqli_fetch_row($database_results)) {
        $start = new DateTime('NOW');
        $start->modify('+1 hour');
        $end = new DateTime($row[7]);
        $asdasd = $start->getTimestamp() - $end->getTimestamp(); // output: 284169600        
        if ($date_time != $row[3]) {
            $database_gather_reddit = "SELECT * FROM coinTrackerReddit WHERE `coinName` LIKE '".$row[1]."'";
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
        }else{
            
        }
        
    }
?>