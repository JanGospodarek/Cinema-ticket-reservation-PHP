<?php
session_start();
?>
<HTML>
<HEAD>
  <TITLE>Wylogowanie</TITLE>
</HEAD>
<BODY>
<?php
if (!isset($_SESSION["login"])){
  header("Location: index.php");
 exit();
}
  echo "Użytkownik " . $_SESSION["login"];
  echo " został wylogowany.";
  session_destroy();
?>
</BODY>
</HTML>
