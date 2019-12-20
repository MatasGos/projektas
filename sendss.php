<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "index")&&($_SESSION['prev'] != "convo")))
{ header("Location:logout.php");exit;}
$_SESSION['prev']="convo";
include("include/nustatymai.php");
$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
            $sql = "INSERT INTO  ".TBL_MESSAGE. " (author, text, reservation) "
                ." VALUES ('".$_SESSION['userid']."', '".$_REQUEST['text']."', ".$_SESSION['convoid'].")";
            $result = mysqli_query($db, $sql);
            if ($result === true){
                header('Location: convo.php?conv='.c);
            } else {
                echo "Klaida. Zinutes issiusti nepavyko";
                echo '<td> [<a href="convo.php?conv='.$id.'">Atidarytis</a>]</td>';
            }