<?php
include('/opt/lampp/htdocs/simplehtmldom_1_5/simple_html_dom.php');

/************************************
 Input validation 
 ************************************/

function getGoogleTickerData($Ticker)
{

    $gf_page = "../../data/".$Ticker."_gf.html";
    $URL = "http://www.google.com/finance?q=".$Ticker;

    print "$URL\n";
    /* Gt the data from google finance */
    system("curl --silent -o $gf_page \"$URL\"");

    /************************************
     Create HTML DOM object 
     ************************************/
    // $html = file_get_html('./data/AAPL.html');
    $html = file_get_html($gf_page);
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
    print "Current evaluation: $cureval \n";
    print "Range: $range \n";
    print "52 W Range: $range_52 \n";
    print "Open: $open \n";
    print "volume: $volume \n";
    print "Mkt cap: $mkt_cap \n";
    print "P/E: $PE \n";
    print "div/yield: $div_yield \n";
    print "EPS: $EPS \n";
    print "Shares: $shares \n";
    print "beta: $beta \n";
    print "inst/own: $inst_own \n";
    print "**********\n";

}

function getYahooTickerData($Ticker)
{
    $yf_page = "./data/".$TKR_SYM."_yf_historic.csv";

    $URL = "http://ichart.finance.yahoo.com/table.csv?s=".$TKR_SYM."&a=00&b=1&c=1991&d=10&e=22&f=2011&g=d&ignore=.csv";
    print "$URL\n";

    system("curl --silent -o $yf_page \"$URL\"");

}


$TKR_SYM = $argv[1];
getGoogleTickerData($TKR_SYM);

?>
