<?php
// operacija3.php  Parodoma registruotų vartotojų lentelė

session_start();
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
{ header("Location: logout.php");exit;}
$_SESSION['prev']="credit";

?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Operacija 3</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <table class="center" ><tr><td>
        </td></tr><tr><td> 
 <?php
        echo "<h1> Kreditai.</h1> <br>";
        echo "<br><br><br>";
        echo "<h4> Jūs turite ".$_SESSION['cred']." kreditų </h4> <br>";
        echo "<h4> Vienas kreditas yra lygus vienai valandai konsultacijų. </h4> <br>";
        echo "<h4> Jūsų likęs konsultavimosi laikas: ".$_SESSION['time']." </h4> <br>";
?>
<form action="creditadd.php">
  Kreditu kiekis:<br>
  <input type="Number" name="credits" value="1">
  <br>
  <br><br>
  <input type="submit" value="Papildyti">
</form> 
	  </table>
  </body></html>
