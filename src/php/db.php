<?php

/************************************
 Connect to database
************************************/
function connect_mysql() 
{
    $mysql_conn = mysql_connect("localhost","root","passw0rd");
    if (!$mysql_conn)
    {
        die('Could not connect: ' . mysql_error());
    }
    return $mysql_conn;
}

function select_database($mysql_conn, $database) 
{
    $db_selected = mysql_select_db($database, $mysql_conn);
    if (!$db_selected) {
        die ('Can\'t use : ' . $database. mysql_error());
    }

    return $db_selected;
}

function create_database($mysql_conn, $database) 
{

    if (mysql_query("CREATE DATABASE $database",$mysql_conn))
    {
        print $database." database created\n";
    }
    else
    {
        print "Error creating database: " . mysql_error() . "\n";
    }
}

function init_accounts_database($mysql_conn, $database) 
{
    select_database($mysql_conn, $database);
    $accounts_sql = "CREATE TABLE $database.Accounts(username varchar(16), 
                     password varchar(32), email varchar(80), fname varchar(32),
                     lname varchar(32))";
    if (!mysql_query($accounts_sql ,$mysql_conn))
    {
        print "Error creating Accounts table: " . mysql_error() . "\n";
    }
}

function init_finance_database($mysql_conn, $database) 
{
    select_database($mysql_conn, $database);

    $google_sql = "CREATE TABLE $database.Stock_Ticker(ticker varchar(8) NOT NULL, 
                   PRIMARY KEY (ticker), cname varchar(128) NOT NULL)";
    if (!mysql_query($google_sql, $mysql_conn))
    {
        print "Error creating ticker table: " . mysql_error() . "\n";
    }

    $google_sql = "CREATE TABLE $database.Stock(ticker varchar(8) NOT NULL, 
                   PRIMARY KEY (ticker), evaluation float, volume int, 
                   mkt_cap int, beta float)";
    if (!mysql_query($google_sql, $mysql_conn))
    {
        print "Error creating Stock: " . mysql_error() . "\n";
    }

    $google_sql = "CREATE TABLE $database.Stock_History(ticker varchar(8) NOT NULL, 
                   day DATE, PRIMARY KEY (ticker, day), beta float, open int,
                   high int, low int, closed int, volume int)";
    if (!mysql_query($google_sql, $mysql_conn))
    {
        print "Error creating historic data table: " . mysql_error() . "\n";
    }
}

function init_database() 
{
    $acc_db = "bt_user_accounts";
    $fin_db = "bt_finance";

    $mysql_conn = connect_mysql();
    create_database($mysql_conn, $acc_db);
    create_database($mysql_conn, $fin_db);

    init_finance_database($mysql_conn, $fin_db);
    init_accounts_database($mysql_conn, $acc_db);
}

?>
