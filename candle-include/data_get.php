<?php
$DATABASE_HOST = '';
$DATABASE_USER = '';                       
$DATABASE_PASS = '';
$DATABASE_NAME = '';
$link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$contract = $_GET["contract"];
if($contract == ''){
  $contract = 'amoon';
}
$query = "SELECT * FROM `all_coins` WHERE `coin_name` LIKE '".$contract."' ORDER BY `all_coins`.`datetime` DESC";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_row($result)) {
    $dates .= '"'.$row[0]. '",';
    $price .= $row[1]. ","; 
    $datetime .= '"'.$row[2]. '",';
}
?>