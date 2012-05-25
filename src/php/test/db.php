<?php
/************************************
 Connect to database
************************************/
$mysql_conn = mysql_connect("localhost","root","passw0rd");
if (!$mysql_conn)
{
  die('Could not connect: ' . mysql_error());
}

if (mysql_query("CREATE DATABASE betatrek",$mysql_conn))
{
  print "Database created\n";
}
else
{
  print "Error creating database: " . mysql_error() . "\n";
}

if (mysql_query("CREATE TABLE betatrek.gf_data(Ticker varchar(16), beta float, 
                    shares int, mkt_cap int)",$mysql_conn))
{
  print "Database created\n";
}
else
{
  print "Error creating database: " . mysql_error() . "\n";
}

?>
