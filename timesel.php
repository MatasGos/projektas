<?php
// operacija2.php
// tiesiog rodomas  tekstas ir nuoroda atgal

session_start();

if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "reserv")&&($_SESSION['prev'] != "time")) || !isset($_GET['consultant']))
 { header("Location: logout.php");exit;}
 $_SESSION['prev']="time";
 include("include/nustatymai.php");
 if(!strpos($_GET['consultant'], ' ') !== true){
        echo "ivyko klaida"; exit;
}
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
            <?php echo "<h1>Konsultanto ".$_GET['name']." galimi laikai</h1>" ?>
            <?php
        $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        


	$sql = "SELECT username,userlevel,email,timestamp,userid "
            . "FROM " . TBL_USERS ." WHERE users.userid = '".$_GET['consultant']."' ORDER BY userlevel DESC,username";
	$result = mysqli_query($db, $sql);
	if (!$result || (mysqli_num_rows($result) < 1))  
            {echo "Klaida skaitant lentelę users"; echo $sql; exit;}
?>
            <table class="center"  border="1" cellspacing="0" cellpadding="3">
    <tr><td><b>Vartotojo vardas</b></td><td><b>Nuotrauka</b></td><td><b>Konsultuota</b><td><b>Email</b></td></tr>
<?php
        $row = mysqli_fetch_assoc($result);	 
        $id=$row['userid']; 
	$level=$row['userlevel']; 
	$user= $row['username'];
        $email = $row['email'];
        $picture = $row['userid'].".jpg";
        $image = (file_exists($picture)) ? $picture : "default.jpg";
        if($level == 5){
      	$time = date("G:i", strtotime($row['timestamp']));
      	echo "<tr><td>".$user. "</td>";?>
        <td><img src="<?=$image?>" alt="" /></td><td><?=$time?></td><td><?=$email?></td><?php



	$sql = "SELECT start, consultant, user, id "
            . "FROM " . TBL_RESERVATIONS  
            ." WHERE start > NOW() AND consultant = '".$_GET['consultant']
            ."' AND user is NULL ORDER BY start";
            
	$result = mysqli_query($db, $sql);
        if (mysqli_num_rows($result) < 1){
                echo "dėja jūsų pasirinktas konsultantas neturi galimų laikų"; exit;
        }
        if (!$result )  
            {echo "Klaida skaitant lentelę reservation"; exit;}
?>

            <table class="center"  border="1" cellspacing="0" cellpadding="3">
    <tr><td><b>Laikas</b></td><td><b>Rezervuoti konsultacija</b></td></tr>
<?php
        while($row = mysqli_fetch_assoc($result)) 
	{	 
        $start=$row['start']; 
        $id = $row['id']; 
      	echo "<tr><td>".$start."</td>";
        echo'<td> [<a href="reservconf.php?id='.$id.'">pasirinkti</a>]</td>';
   }
        }
