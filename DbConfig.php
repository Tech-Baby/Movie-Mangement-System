<?php  

function getdbconnection(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "mms";


    try{

      $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // var_dump($conn);
      return $conn;
    }catch(PDOException $e){
        echo "Connection failed " . $e->getMessage();
    }
















}











?>