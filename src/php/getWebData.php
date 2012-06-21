<?php
include('../../include/htdocs/simplehtmldom_1_5/simple_html_dom.php');
include_once 'ticker.php';
include_once 'db.php';


function getYahooData($Ticker)
{
    $yf_page = "./data/".$TKR_SYM."_yf_historic.csv";

    $URL = "http://ichart.finance.yahoo.com/table.csv?s=".$TKR_SYM."&a=00&b=1&c=1991&d=10&e=22&f=2011&g=d&ignore=.csv";
    print "$URL\n";

    system("curl --silent -o $yf_page \"$URL\"");

}

function getGoogleData($Ticker)
{
    if (empty($Ticker)) {
        print "Error: ticker empty\n";
        return;
    }
    print "$Ticker: ";

    $t = new Stock();

    /* Get the data from google finance */
    $URL = "http://www.google.com/finance?q=".$Ticker;
    $URL_history = "http://www.google.com/finance/historical?q=".$Ticker;
    $gf_stock = "../../data/".$Ticker."_gf.html";
    $gf_history = "../../data/".$Ticker."_gf_history.html";
    system("curl --silent -o $gf_stock \"$URL\"");
    system("curl --silent -o $gf_history \"$URL_history\"");

    /************************************
     Create HTML DOM objects
     ************************************/
    $gf_html = file_get_html($gf_stock);
    $gf_history_html = file_get_html($gf_history);
    // echo $gf_html->plaintext;

    /************************************
     Extract the current data
     ************************************/
    // Find the information tables
    $companydata = $gf_html->find('div#companyheader', 0);
    $snapdata0 = $gf_html->find('table.snap-data', 0);
    $snapdata1 = $gf_html->find('table.snap-data', 1);

    // Find Company info.
    $companyname = $companydata->find('h3', 0);
    $t->cname = html_entity_decode($companyname->plaintext);
    print "$t->cname\n";

    // Find the current evaluation
    $cureval = $gf_html->find('span[class=pr]', 0)->plaintext;
    // $cureval = $gf_html->find('span[id=ref_22144_l]', 0);

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

    /* Insert the data into database. */
    $t->ticker = $Ticker;
    $t->evaluation = floatval($cureval);
    $t->volume = intval($volume);
    $t->mkt_cap = intval($mkt_cap);
    $t->beta = floatval($beta);
    $t->insertStock();

    /* Print these tables */
    /*
    foreach($snapdata0->find('tr') as $row){

        print "\n";

        foreach($row->find('td') as $cell) {

            // push the cell's text to the array
            print "$cell->innertext";
        }

        $rowData = $row->find('td', 1);
        print $rowData->innertext;
    }
    print "\n";

    foreach($snapdata1->find('tr') as $row){

        print "\n";

        foreach($row->find('td') as $cell) {

        // push the cell's text to the array
        print "$cell->innertext";
        }

        $rowData = $row->find('td', 1);
        print $rowData->innertext;
    }
    print "\n";
    print "\n";
    */

    /* Display the retrieved data */
    /*
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
    */

    /************************************
     Extract the historical data
     ************************************/
    $histdata = $gf_history_html->find('table.historical_price', 0);
    // print "$histdata->plaintext\n";
    $history = $histdata->find('tr', 0);
    print $history->plaintext;
}

?>
