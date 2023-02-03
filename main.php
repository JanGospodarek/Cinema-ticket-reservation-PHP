<?php include "fetchFilms.php"?>
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


    <script type='module'>

      const filmy =<?php echo json_encode($filmy)?>;
      const context={}

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
const sorted =datyArr.sort()
console.log(sorted);
      sorted.forEach((el)=>{
        const filtered=filmy.filter(film=>film.data==el)
        context[el]=filtered
      })
      let filmyStr=``;
      
      function godzinyMap(obj){
        let str=``
obj.godziny.forEach(el => {
  str+=`<a href='order.php/?ID=${obj.ID}?godzina=${el}' class="dataCont">${el}</a>`
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
          ${godzinyMap(element)}
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
      document.getElementById('center').innerHTML=filmyStr;
</script>
  </body>
</html>
