<?php
session_start();
if (!isset($_SESSION["login"])){
  header("Location: index.php");
 exit();
}
// if(isset($_GET['miejsca'])) return;
include('./connect.php');


$ID=$_GET['ID'];
$godzina=$_GET['godzina'];
$data=$_GET['data'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT IDSeansu,miejsca FROM seanse WHERE IDFilmu=$ID AND Data='$data' AND Godzina='$godzina' ";
$result = $conn->query($sql);
 
$sqlFilm="SELECT Nazwa,Opis,imgUrl FROM films WHERE IDFilmu=$ID  ";
$resultFilm = $conn->query($sqlFilm);

class seansClass {
        public $ID;
     public $data;
     public $godzina;
     public $miejsca;
     public $nazwa;
     public $imgUrl;
     public $opis;
   
    
}
$seans=new seansClass();

while($row = $result->fetch_assoc()) {
  $seans->ID=$row['IDSeansu'];
  $seans->data=$data;
  $seans->godzina=$godzina;
  $seans->miejsca=$row['miejsca'];
//   array_push($filmy,$film );
}
while($row = $resultFilm->fetch_assoc()) {
    $seans->nazwa=$row['Nazwa'];
    $seans->imgUrl=$row['imgUrl'];
    $seans->opis=$row['Opis'];
   
  //   array_push($filmy,$film );
  }
// foreach($filmy as $i){
//   echo 'Nazwa'.$i->nazwa;
// }
$conn->close();


?>