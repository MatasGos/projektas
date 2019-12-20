<?php
// operacija3.php  Parodoma registruotų vartotojų lentelė

session_start();
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "credit"))
{ header("Location: logout.php");exit;}
$_SESSION['prev']="time";
include("include/nustatymai.php");
include("include/functions.php");
?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Rezervacija</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
    <table style="border-width: 2px; border-style: dotted;"><tr><td>
         Atgal į [<a href="index.php"> Pradžia</a>]
      </td></tr>
	</table><br>
			
		<div style="text-align: center;color:green"> <br>
            <?php 
            $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
            $s = $_SESSION['s'];
            $s = $s + $_REQUEST['credits'] * 30;
            $m = $_SESSION['m'];
            $h = $_SESSION['h'];
            $m = $m + intdiv($s, 60);
            $s = $s % 60;
            $h = $h + intdiv($m, 60);
            $m = $m % 60;
            echo $sum;
            $sum = $h*1000+$m*100+$s;
            //$sum = "'".$h.":".$m.":".$s."'";
            //$sum = $_REQUEST['credits'] * 30;
            $sql = "UPDATE ".TBL_USERS
                ." SET timestamp=".$sum." WHERE '".$_SESSION['userid']."'=userid";
            $result = mysqli_query($db, $sql);
            
            if ($result === true){
                echo "Kreditų sąskaita papildyta. Prisijunkite per nauja, kad pamatytumet atnaujintą balansą";?>
                [<a href="logout.php"> Atsijungti</a>] <?php
            } else {
                echo $sql;
                echo "Papildyti kreditų nepavyko. Pabandykite vėliau.";
            }

?>		
        </div><br>
