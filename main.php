<?php
session_start();
if (!isset($_SESSION["login"])){
  header("Location: index.php");
 exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ticket";

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
  
     public $nazwa;
     public $opis;
     public $data;
     public $godziny;
     public $link;
    
}

while($row = $result->fetch_assoc()) {
  $film=new filmClass();
  $film->nazwa=$row['Nazwa'];
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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./style.css" />
  </head>
  <body>
    <div id="top">
      <h1>Kino</h1>
      <?php
    echo "Witaj " . $_SESSION["login"];
    echo "<a id='wyloguj' href='wyloguj.php?" . SID . "'>";
   echo "Wyloguj</a>";
?>
    </div>
    <div id="center">
    
    </div>


    <script>
        const context={}

      const filmy =<?php echo json_encode($filmy)?>;

      filmy.forEach(film=>{
        const arr=film.godziny.split(",")
        film.godziny=arr
      })

      let datyArr=[];
      for (const key in filmy) {
        datyArr.push(filmy[key].data)     
          }

      const datySet=new Set(datyArr)
      datyArr= Array.from(datySet)

      datyArr.forEach((el)=>{
        const filtered=filmy.filter(film=>film.data==el)
        context[el]=filtered
      })
      let filmyStr=``;
      
      function godzinyMap(arr){
        let str=``
arr.forEach(element => {
  str+=`<button class="dataCont">${element}</button>`
});
return str
      }
      function filmMap(arr){
        let str=``
arr.forEach(element => {
  str+=`
          <div class="filmItem">
        <div class="img">
          <img src="${element.link}" alt="logo" width="140px" />
        </div>
        <div class="info">
          <h2>${element.nazwa}</h2>
          <div class="desc">
           ${element.opis}
          </div>
        </div>
        <div class="free">
          <h3>Godziny:</h3>
          <div class="daty">
          ${godzinyMap(element.godziny)}
          </div>
        </div>
      </div>
          `
});
return str
      }
      for (const key in context) {
       const el=context[key];
       filmyStr+=`
       <h2>${key}</h2>
        ${filmMap(el)}
       
       `
      }
      console.log(filmyStr);
      document.getElementById('center').innerHTML=filmyStr;
</script>
  </body>
</html>
