<?php

include_once 'user.php';
include_once 'ticker.php';
include 'getWebData.php';

/*
$u = new User();
$u->setUsername("vinay");
$u->setPassword("password");
$u->setEmail("vinay@betatrek.com");
$u->insertUser();

$t = new Stock();
$t->ticker = "GOOG";
$t->evaluation = 1.6;
$t->insertTicker();
*/

init_database();

$nasdaq_file = "./input/TKR_TEST";
$tickers = split("\n", file_get_contents($nasdaq_file));

foreach($tickers as $line_num => $ticker)
{
    // print "$ticker\n";
    getGoogleData($ticker);
}


?>
