<?php
$host="localhost";
$db="bda_2022";
$user="root";
$password="";

try {
    $conection=new PDO("mysql:host=$host;dbname=$db",$user,$password);
} catch ( Exception $ex){
    echo $ex->getMessage();

}
?>