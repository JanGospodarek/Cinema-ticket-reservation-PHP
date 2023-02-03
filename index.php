<?php
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

$sql = "SELECT ID,LogIn,Password FROM users";
$result = $conn->query($sql);

if(isset($_POST['login'],$_POST['password'],$_POST['number']))
{
  while($row = $result->fetch_assoc()) {
    if($_POST['login']==$row["LogIn"]&&$_POST['password']==$row["Password"])
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
else
	$error = false;
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
        <form method='post' >
          <p>Login: <input type="text" name="login" /></p>
          <p>Hasło: <input type="text" name="password" /></p>
          <p>Numer telefonu: <input type="text" name="number" /></p>
          <button type="submit">Zaloguj</button>
        </form>
      </div>
    </div>

    <script src="./script.js"></script>
    <script>console.log('hej')</script>
    <?php include 'script.php'?>
  </body>
</html>
