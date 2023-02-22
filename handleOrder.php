<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ticket";

if(isset($_GET['miejsca'],$_GET['IDSeansu'],$_GET['data'],$_GET['godzina']))
{
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $miejsca=$_GET['miejsca'];
    $IDSeansu=$_GET['IDSeansu'];
    $data=$_GET['data'];
    $godzina=$_GET['godzina'];
    $zajete=$_GET['zajeteMiejsca'];
    $noweMiejsca=$zajete.",".$miejsca;
    settype($IDSeansu,'integer');
    // var_dump($miejsca);
    // var_dump($IDSeansu);
    // var_dump($data);
    // var_dump($godzina);
    $sql = "INSERT INTO rezerwacje (IDSeansu,Godzina,Data,Miejsca) VALUES ($IDSeansu,'$godzina','$data','$miejsca')";
    $result = $conn->query($sql);
    $sql2 = "UPDATE seanse SET miejsca='$noweMiejsca' WHERE IDSeansu=$IDSeansu";
    $result2 = $conn->query($sql2);
    echo 'Zarezerwowano miejsca: '.$miejsca;
}


?>