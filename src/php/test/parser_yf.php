<?php
include('/opt/lampp/htdocs/simplehtmldom_1_5/simple_html_dom.php');

/************************************
 Input validation 
************************************/
foreach($argv as $value)
{
  // print "$value ";
}
// print "\n";
$TKR_SYM = $argv[1];
$page_yf = "./data/".$TKR_SYM."_yf_historic.csv";

$URL = "http://ichart.finance.yahoo.com/table.csv?s=".$TKR_SYM."&a=00&b=1&c=1991&d=10&e=22&f=2011&g=d&ignore=.csv";
print "$URL\n";

system("curl --silent -o $page_yf \"$URL\"");


/************************************
 Extract the required data 
************************************/

/************************************
 Connect to database
************************************/
$mysql_conn = mysql_connect("localhost","root","vinay123");
if (!$mysql_conn)
  {
  die('Could not connect: ' . mysql_error());
  }


?>
