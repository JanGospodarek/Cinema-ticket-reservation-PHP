<?php
session_start();
if (!isset($_SESSION["login"])){
  header("Location: index.php");
 exit();
}
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
      <div class="filmItem">
        <div class="img">
          <img src="avatar.webp" alt="logo" width="140px" />
        </div>
        <div class="info">
          <h2>Tytuł</h2>
          <div class="desc">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sunt
            nesciunt eius minus aut iste quidem earum recusandae optio culpa ut?
            Modi, saepe sequi! Facere magni, sint officia aspernatur unde
          </div>
        </div>
        <div class="free">
          <h3>Daty:</h3>
          <div class="daty">
            <button class="dataCont">12.12.2023</button>
            <button class="dataCont">12.12.2023</button>
            <button class="dataCont">12.12.2023</button>
            <button class="dataCont">12.12.2023</button>
            <button class="dataCont">12.12.2023</button>
            <button class="dataCont">12.12.2023</button>
            <button class="dataCont">12.12.2023</button>
            <button class="dataCont">12.12.2023</button>
            <button class="dataCont">12.12.2023</button>
            <button class="dataCont">12.12.2023</button>
            <button class="dataCont">12.12.2023</button>
            <button class="dataCont">12.12.2023</button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
