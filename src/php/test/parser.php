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
$page_gf = "./data/".$TKR_SYM."_gf.html";

$URL = "http://www.google.com/finance?q=".$TKR_SYM;
print "$URL\n";

system("curl --silent -o $page_gf \"$URL\"");


/************************************
 Create HTML DOM object 
************************************/
// $html = file_get_html('./data/AAPL.html');
$html = file_get_html($page_gf);
// echo $html->plaintext;

/************************************
 Extract the required data 
************************************/

// Find the information tables
$snapdata0 = $html->find('table.snap-data', 0);
$snapdata1 = $html->find('table.snap-data', 1);
/* Print these tables */
foreach($snapdata0->find('tr') as $row){

    // echo "$row \n";
    print "\n";

    foreach($row->find('td') as $cell) {

        // push the cell's text to the array
	    // print "$cell ";
	    print "$cell->innertext";
    }

    $rowData = $row->find('td', 1);
    print $rowData->innertext;
}
print "\n";
foreach($snapdata1->find('tr') as $row){

    // echo "$row \n";
    print "\n";

    foreach($row->find('td') as $cell) {

        // push the cell's text to the array
	    // print "$cell ";
	    print "$cell->innertext";
    }

    $rowData = $row->find('td', 1);
    print $rowData->innertext;
}
print "\n";
print "\n";

// Find the current evaluation
$cureval = $html->find('span[class=pr]', 0)->plaintext;
// $cureval = $html->find('span[id=ref_22144_l]', 0);

// Extract snapdata 
$range = $snapdata0->find('tr', 0)->find('td', 1)->plaintext;
$range_52 = $snapdata0->find('tr', 1)->find('td', 1)->plaintext;
$open = $snapdata0->find('tr', 2)->find('td', 1)->plaintext;
$volume = $snapdata0->find('tr', 3)->find('td', 1)->plaintext;
$mkt_cap = $snapdata0->find('tr', 4)->find('td', 1)->plaintext;
$PE= $snapdata0->find('tr', 5)->find('td', 1)->plaintext;

$div_yield = $snapdata1->find('tr', 0)->find('td', 1)->plaintext;
$EPS= $snapdata1->find('tr', 1)->find('td', 1)->plaintext;
$shares= $snapdata1->find('tr', 2)->find('td', 1)->plaintext;
$beta= $snapdata1->find('tr', 3)->find('td', 1)->plaintext;
$inst_own= $snapdata1->find('tr', 4)->find('td', 1)->plaintext;

/* Display the retrieved data */
print "Current evaluation: $cureval";
print "\n";
print "Range: $range";
print "\n";
print "52 W Range: $range_52";
print "\n";
print "Open: $open";
print "\n";
print "volume: $volume";
print "\n";
print "Mkt cap: $mkt_cap";
print "\n";
print "P/E: $PE";
print "\n";
print "div/yield: $div_yield";
print "\n";
print "EPS: $EPS";
print "\n";
print "Shares: $shares";
print "\n";
print "beta: $beta";
print "\n";
print "inst/own: $inst_own";
print "\n";
print "**********\n";


/************************************
 Connect to database
************************************/
$mysql_conn = mysql_connect("localhost","root","vinay123");
if (!$mysql_conn)
  {
  die('Could not connect: ' . mysql_error());
  }



$mysql_conn = mysql_connect("localhost","root","vinay123");
if (!$mysql_conn)
{
    die('Could not connect: ' . mysql_error());
}
if (mysql_query("CREATE TABLE betatrek",$mysql_conn))
{
   print "Database created\n";
}


?>
