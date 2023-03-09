<?php 
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASSWORD', '');
define('DBNAME', 'wisdomtutorsdb');


$db_con = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);


if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>