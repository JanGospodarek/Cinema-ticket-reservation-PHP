<?php
session_start();
if (!isset($_SESSION["login"])){
  header("Location: index.php");
 exit();
}
include('./connect.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT IDFilmu,Nazwa,Data,Opis,Godziny,imgUrl FROM films";
$result = $conn->query($sql);
$filmy=[];
 
class filmClass {
  public $ID;
     public $nazwa;
     public $opis;
     public $data;
     public $godziny;
     public $link;
    
}

while($row = $result->fetch_assoc()) {
  $film=new filmClass();
  $film->nazwa=$row['Nazwa'];
  $film->ID=$row['IDFilmu'];
  $film->opis=$row['Opis'];
  $film->data=$row['Data'];
  $film->godziny=$row['Godziny'];
  $film->link=$row['imgUrl'];
  array_push($filmy,$film );
}
// var_dump($filmy)
// foreach($filmy as $i){
//   echo 'Nazwa'.$i->nazwa;
// }
?>