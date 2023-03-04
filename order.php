
<?php include "components/fetchFilmData.php"?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../style.css" />
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
            <div id="wrapper">
                <div id="topCont">
                   
                </div>
                <div id="centerCont">
                    <div id="salaWrap">
                        <div id="sala">
                      
                        </div>
                        <div id="ekran">Ekran</div>
                    </div>
                  

                    <div id="orderInfo">
                        <p>Liczba miejsc: <span id='liczbaMiejsc'></span></p>
                        <p>Cena: <span id='cena'></span>zł</p>
                        <!-- <form action="../handleOrder.php"  method="get"> -->
                          <!-- <input type="text" name="miejsca" hidden id="miejsca">
                          <input type="text" name="seans" hidden id="seans"> -->

                          <a href='' id="order">Zamów</a>

                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
      </div>
      <script>
        const seans=<?php echo json_encode($seans)?>;
        
        console.log(seans);
        const topCont=document.getElementById('topCont')
        const sala=document.getElementById('sala')

        topCont.innerHTML=`
        <div id="imgCont">
                        <img src="${seans.imgUrl}" alt="" width="250px">
                    </div>
                    <div class="info">
                        <h1>${seans.nazwa}</h1>
                        <div class="desc">
                          ${seans.opis}
                        </div>
                      </div>
                    <div  id="dataCont">
                        <h2>Data:</h2>
                        <p>${seans.data}</p>
                        <h2>Godzina:</h2>
                        <p>${seans.godzina}</p>
                    </div>`


        miejscaArr=seans.miejsca.split(',')
        console.log(seans);
        for (let index = 300; index >= 1; index--) {
          const btn=document.createElement('button');
          btn.classList.add('krzeslo');
          btn.innerText=index;
          if(miejscaArr.includes(`${index}`)){
            btn.style.backgroundColor='red';
            btn.classList.add('occupied')
          }
          sala.appendChild(btn)
        }

        const selected=[]

        sala.addEventListener('click',(e)=>{
          if(!e.target.classList.contains('krzeslo')||e.target.classList.contains('occupied')) return;
          const btn=e.target
          const id=btn.innerText
          if(selected.includes(`${id}`)){
            const index=selected.findIndex((el)=>el==id)
            selected.splice(index,1)
            btn.style.backgroundColor='rgb(36, 36, 36)';
          }else{
            selected.push(id)
            btn.style.backgroundColor='orange';

          }

          updateSummary()

        })


        function updateSummary(){
          const liczba=document.getElementById('liczbaMiejsc')
          const cena=document.getElementById('cena')
          document.getElementById('order').href=`../handleOrder.php?miejsca=${selected.map(el=>{return el})}&IDSeansu=${seans.ID}&data=${seans.data}&godzina=${seans.godzina}&zajeteMiejsca=${seans.miejsca}`
          liczba.innerText=selected.length
          cena.innerText=selected.length*12.99
        }

        
        
</script>
  </body>
</html>
