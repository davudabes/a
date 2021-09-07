<?php
$timer_got = time() * 1000;
/* echo strtotime("2016-03-04 11:57:00") * 1000; */
$contract = $_GET["contract"];
if($contract == ''){
  $contract = 'amoon';
}
if($contract == 'amoon'){
    $DATABASE_HOST = '';
    $DATABASE_USER = '';                       
    $DATABASE_PASS = '';
    $DATABASE_NAME = '';
    $txs_link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    $txs_query = "SELECT * FROM `all_txs` WHERE `datetime` > ".$timer_got." ORDER BY `all_txs`.`id` DESC LIMIT 20    ";
    $txs_result = mysqli_query($txs_link, $txs_query);
    while ($txs_row = mysqli_fetch_row($txs_result)) {
        if($txs_row[1] == 'Buy'){
            $color = "color: green;";
        } else {
            $color = "color: red;";
        }
        printf('<div class="row" style="'.$color.'">');
        printf('<div class="col-12 col-lg-2"><strong>'.$txs_row[1].'</strong></div>');
        printf('<div class="col-12 col-lg-3"><strong>'.$txs_row[2].'</strong></div>');
        printf('<div class="col-12 col-lg-3"><strong>$'.$txs_row[3].'</strong></div>');
        printf('<div class="col-12 col-lg-2"><strong>'.$txs_row[4].'</strong></div>');
        printf('<div class="col-12 col-lg-2"><a href="https://arbiscan.io/address/'.$txs_row[5].'">View Txs</a></div>');
        printf('</div>');
        printf('<hr>');
    }
}
?>