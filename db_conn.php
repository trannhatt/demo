<?php

#server name
$sName = "localhost";
#username
$uName = "root";
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
