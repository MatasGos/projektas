<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "clients")&&($_SESSION['prev'] != "convo")))
{ header("Location:logout.php");exit;}
$_SESSION['prev']="clients";
include("include/nustatymai.php");
$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
            $sql = "INSERT INTO  ".TBL_RESERVATIONS. " (consultant, start) "
                ." VALUES ('".$_SESSION['userid']."', '".$_REQUEST['day']."')";
            $result = mysqli_query($db, $sql);
            echo $sql;
            if ($result === true){
                header('Location: clients.php');
            } else {
                echo "Klaida. Nepavyko sukurti rezervacijos";
                echo '<td> [<a href="convo.php?conv='.$id.'">Atidarytis</a>]</td>';
            }