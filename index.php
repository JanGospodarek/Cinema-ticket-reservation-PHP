<?php
include('./connect.php');


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$error="";


if(isset($_POST['login'],$_POST['password'],$_POST['number']))
{
  if(isset($_POST['hasAccount'])){
    $login=$_POST['login'];
    $password=$_POST['password'];
    $hashPassword = password_hash($password,PASSWORD_BCRYPT);
    $number=$_POST['number'];
    $sql="INSERT INTO users (LogIn,Password,Number) VALUES ('$login','$hashPassword','$number')";
    $result = $conn->query($sql);

    session_start();
		$_SESSION['login']=$_POST['login'];
		header("Location: main.php");
		exit();
  }else{
    $sql = "SELECT ID,LogIn,Password,Number FROM users";
    $result = $conn->query($sql);
  
    while($row = $result->fetch_assoc()) {
      if($_POST['login']==$row["LogIn"]&&password_verify($_POST['password'],$row['Password'])&&$_POST['number']==$row["Number"])
    {
      session_start();
      $_SESSION['login']=$_POST['login'];
      header("Location: main.php");
      exit();
    }
    else
      $error = "<B>Błędny login lub hasło!</B><BR>";
    }
  }

 
	
}
else

  $conn->close();

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
    <div id="main">
      <div class="dialog">
        <h2>Zaloguj się</h2>
        <p><?php echo $error?></p>
        <form method='post' >
          <p>Nie mam konta  <label class="switch">
          
          <input type="checkbox" name="hasAccount">
          <span class="slider round"></span>
          </label></p>
      
          <p>Login: <input type="text" name="login" /></p>
          <p>Hasło: <input type="text" name="password" /></p>
          <p>Numer telefonu: <input type="text" name="number" /></p>
          <button type="submit">Zaloguj</button>
        </form>
      </div>
    </div>
  <script>

  </script>
  </body>
</html>
