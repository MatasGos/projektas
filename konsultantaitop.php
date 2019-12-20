<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "index")&&($_SESSION['prev'] != "reserv")&&($_SESSION['prev'] != "time")))
{ header("Location:logout.php");exit;}
$_SESSION['prev']="reserv";

?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Konsultatai</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
    <table style="border-width: 2px; border-style: dotted;"><tr><td>
         Atgal į [<a href="index.php">Pradžia</a>]
      </td></tr>
	</table><br>
			
		<div style="text-align: center;color:green"> <br>
            <h1>TOP 5 konsultantai</h1>
            <?php
    
	$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$sql = "SELECT username,userlevel,email,timestamp,userid,consult_time "
            . "FROM " . TBL_USERS . " WHERE userlevel = 5 ORDER BY users.consult_time DESC,username LIMIT 5";
	$result = mysqli_query($db, $sql);
	if (!$result || (mysqli_num_rows($result) < 1))  
            {echo "Klaida skaitant lentelę users"; exit;}
?>
            <table class="center"  border="1" cellspacing="0" cellpadding="3">
    <tr><td><b>Vartotojo vardas</b></td><td><b>Nuotrauka</b></td><td><b>Konsultuota</b><td></td></tr>
<?php
        while($row = mysqli_fetch_assoc($result)) 
	{	 
        $id=$row['userid']; 
	    $level=$row['userlevel']; 
	  	$user= $row['username'];
        $email = $row['email'];
        $picture = $row['userid'].".jpg";
        $image = (file_exists($picture)) ? $picture : "default.jpg";
        if($level == 5){
      	$time = date("G:i", strtotime($row['consult_time']));
      	echo "<tr><td>".$user. "</td>";?>
        <td><img src="<?=$image?>" alt="" /></td><td><?=$time?></td><?php
   
            }
   }
?>		
        </div><br>
