<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "convo")&&($_SESSION['prev'] != "convos")&&($_SESSION['prev'] != "clients")))
{ header("Location:logout.php");exit;}
$_SESSION['prev']="convo";
$_SESSION['convoid']=$_GET['conv'];
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
            <h1>Pokalbis</h1>
            <?php
    
	$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$sql = "SELECT text,author, ".TBL_USERS.".username "
            . "FROM " . TBL_MESSAGE. " 
            left join ".TBL_USERS." on author = userid 
            where reservation=".$_GET['conv']." ORDER BY time ";
  $result = mysqli_query($db, $sql);
	if (mysqli_num_rows($result) < 1){
    echo "Pokalbis tuscias"; 
}
if (!$result )  
{echo "Klaida skaitant lentelę message"; exit;}
?>
            <table class="center"  border="1" cellspacing="0" cellpadding="3">
    <!---<tr><td><b>Autorius</b></td><td><b>Tekstas</b></td></tr> -->
<?php
$user = $_SESSION["user"];
echo "<center>";
        while($row = mysqli_fetch_assoc($result)) 
	{	 
    $username = $row['username']; 
        $text=$row['text']; 
	    $author=$row['author']; 
        if(strtolower($username) == $user){
          ?>
          
            <div class="container" style="max-width: 1000px;">
            <p><?=$text?></p>
            <span class="time-right"><?=$username?></span>
            </div>
          <?php
        }
        else{
          ?>
            <div class="container darker" style="max-width: 1000px;">
            <p><?=$text?></p>
            <span class="time-left"><?=$username?></span>
            </div>
          <?php
        }
   }
   echo "</center>";
   $sql = "SELECT (hour(timestamp)*120+minute(timestamp)*2+Round(second(timestamp)/30,0)) as hours, 
   reservation.closed IS NULL as closed, reservation.user , 
     date_add(reservation.start,interval (hour(timestamp)*3600+minute(timestamp)*60+Round(second(timestamp),0)) second) as used  , 
    CURRENT_TIMESTAMP  as time_now
   FROM reservation 
   left join users on reservation.user = users.userid
   where reservation.id=".$_SESSION['convoid'];
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
  $closed = $row['closed'];
  $one = "1";
  if ($closed!=$one){
    echo "pokalbis baigtas";
  }
  else {
    ?>
    <form action="convoadd.php">
Žinutė:<br>
  <input type="text" name="text" value="1">
  <input type="submit" value="Rasyti">
</form> 
<form action="convoclose.php">
  <input type="submit" value="Baigti">
</form>
<form action="sendss.php">
  <input type="submit" value="Ekrano kopijos siuntimas">
</form> 
</div><br><?php
  if($row['time_now']>$row['used']){
    header("Location:convoclose.php");exit;
  }
  

  }
?>

