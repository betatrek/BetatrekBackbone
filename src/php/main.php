<?php

include_once 'user.php';
include_once 'ticker.php';
include 'getWebData.php';

init_database();

$nasdaq_file = "./input/TKR_NASDAQ_NEW";
//$lines = file($nasdaq_file);
$lines = split("\n", file_get_contents($nasdaq_file));

foreach($lines as $line_num => $line)
{
    echo $line;
    getGoogleTickerData($line);
}

/*
$u = new User();
$u->setUsername("vinay");
$u->setPassword("password");
$u->setEmail("vinay@betatrek.com");
$u->insertUser();

$t = new Ticker();
$t->ticker = "GOOG";
$t->evaluation = 1.6;
$t->insertTicker();
*/

?>
