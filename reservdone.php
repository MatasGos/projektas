<?php
// operacija2.php
// tiesiog rodomas  tekstas ir nuoroda atgal

session_start();

if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "time") || !isset($_GET['id']))
 { header("Location: logout.php");exit;}
 $_SESSION['prev']="time";
 include("include/nustatymai.php");
//  if(!is_int($_GET['id'])){
//          echo "ivyko klaida"; exit;
//  }
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
            
            $sql = "UPDATE ".TBL_RESERVATIONS
                ." SET user='".$_SESSION['userid']."' WHERE id = ".$_GET['id'];
            $result = mysqli_query($db, $sql);
            if ($result === true){
                //echo $sql;
                echo "Rezervacija pavyko";
            } else {
                echo "rezervacija nepavyko, bandykite dar karta";
            }

?>		
        </div><br>
