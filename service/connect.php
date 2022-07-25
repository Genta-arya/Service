<?php

$connect = null;

try{
    //Config
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_tugas";

    //Connect
    $database = "mysql:dbname=$dbname;host=$host";
    $connect = new PDO($database, $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    

} catch (PDOException $e){
    echo "Error ! " . $e->getMessage();
    die;
}

?>