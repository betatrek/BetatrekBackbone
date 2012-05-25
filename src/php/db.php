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

function create_database($mysql_conn, $database) 
{

    if (mysql_query("CREATE DATABASE $database",$mysql_conn))
    {
        print "Database created\n";
    }
    else
    {
        print "Error creating database: " . mysql_error() . "\n";
    }
}

function connect_database($mysql_conn, $database) 
{
    $db_selected = mysql_select_db($database, $mysql_conn);
    if (!$db_selected) {
        die ('Can\'t use : ' . $database. mysql_error());
    }

    return $db_selected;
}

function init_tables($mysql_conn, $database) 
{
    if (mysql_query("CREATE TABLE $database.User(username varchar(16), password varchar(16),
                    email varchar(16), fname varchar(16), lname varchar(16))",$mysql_conn))
    {
        print "user data table\n";
    }
    else
    {
        print "Error creating database: " . mysql_error() . "\n";
    }

    if (mysql_query("CREATE TABLE $database.GF_data(ticker varchar(8), eval float, beta float, 
                    shares int, mkt_cap int)",$mysql_conn))
    {
        print "Google data table\n";
    }
    else
    {
        print "Error creating database: " . mysql_error() . "\n";
    }

}

function init_database() 
{
    $database = "betatrek";
    $mysql_conn = connect_mysql();
    connect_database($mysql_conn, $database);
    init_tables($mysql_conn, $database);
}

?>
