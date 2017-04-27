<?php

//Connection to the MySQL Server by - tutbuzz.com

define('DB_SERVER', 'localhost'); // Mysql hostname, usually localhost
define('DB_USERNAME', 'dzserve1_jay'); // Mysql username
define('DB_PASSWORD', 'password1'); // Mysql password
define('DB_DATABASE', 'dzserve1_jay'); // Mysql database name


$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>