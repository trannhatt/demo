<?php

#server name
$sName = "database-1.corloppcovr8.us-east-1.rds.amazonaws.com";
#username
$uName = "3306";
#password
$pass = "";

#database name
$db_name = "e_bookstore";
/** 
    * create database connection
    * using the PHP Data Objects (PDO)
**/
try {
    $conn = new PDO("mysql:host=$sName;port=3306;dbname=$db_name",
                    $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Connection failed: ". $e->getMessage();
}
?>
