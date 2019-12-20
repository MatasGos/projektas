<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "index")&&($_SESSION['prev'] != "reserv")&&($_SESSION['prev'] != "clients")))
{ header("Location:logout.php");exit;}
$_SESSION['prev']="clients";

echo '<form action="clientadd.php">
  Sukurti nauja rezervacijos laika: <input type="datetime-local" name="day" value=2017-06-01T08:30>
  <input type="submit" value="Rasyti">
</form>';

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
            <h1>Konsultaciju sąrašas</h1>
            <?php
    
	$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$sql = "SELECT start, user, closed, id "
            . "FROM " . TBL_RESERVATIONS . " WHERE consultant='".$_SESSION['userid']."' ORDER BY start ";
    $result = mysqli_query($db, $sql);
	if (mysqli_num_rows($result) < 1){
        echo "Neturite pokalbiu"; exit;
    }
    if (!$result )  
    {echo "Klaida skaitant lentelę message"; exit;}
    ?>
            <table class="center"  border="1" cellspacing="0" cellpadding="3">
    <tr><td><b>Klientas</b></td><td><b>Data</b></td><b></b></td></tr>
<?php
        while($row = mysqli_fetch_assoc($result)) 
	{	 
        $id = $row['id']; 
        $start=$row['start']; 
	      $client=$row['client']; 
	  	  $user= $row['user'];
      	echo "<tr><td>".$user. "</td>";
        echo "<td>".$start."</td>";
        echo'<td> [<a href="convo.php?conv='.$id.'">Atidaryti</a>]</td>';
            }
?>		
</div><br>

