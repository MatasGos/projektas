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
         Atgal į [<a href="konsultantai.php">konsultantų sąrašą</a>]
      </td></tr>
	</table><br>
			
		<div style="text-align: center;color:green"> <br>
            <?php 
            $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

            $sql = "SELECT sum(case when closed is null and user = '".$_SESSION['userid']."' then 1 else 0 end) as count FROM `reservation` ";
            $result = mysqli_query($db, $sql);
            $row = mysqli_fetch_row($result);  
            if($row['count'] == 0){
            $sql = "SELECT start, consultant, username "
                . "FROM " . TBL_RESERVATIONS
                . " left join ".TBL_USERS
                . " on ".TBL_RESERVATIONS.".
                consultant = ".TBL_USERS.".userid" 
                ." WHERE id = ".$_GET['id'];
                $result = mysqli_query($db, $sql);
                $row = mysqli_fetch_row($result);  
            $result = mysqli_query($db, $sql);
            echo "<h1> Patvirtinu, kad užsirezervuoju konsultaciją ".$row[0]." metu pas konsultantą ".$row[2].".</h1>" ;
            echo'<td> [<a href="reservdone.php?id='.$_GET['id'].'">patvirtinti</a>]</td>';}
            else {
                echo "<h1> Turite aktyvia konsultacija. Negalima vienu metu turet kelias konsultacijas.</h1>" ;
            }
