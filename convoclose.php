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
            $sql = "UPDATE reservation SET closed = sysdate() where id = ".$_SESSION['convoid'];
            $result = mysqli_query($db, $sql);
            $true = false;
            if ($result === true){
                $sql = "select consultant, (closed-start) as worked from reservation where reservation.id = ".$_SESSION['convoid'];
            $result = mysqli_query($db, $sql);
            $row = mysqli_fetch_assoc($result);
            $consultant = $row['consultant'];
            $time = $row['worked'];
            $sql = "Update users set consult_time = (sec_to_time(time_to_sec(consult_time)+ $time))
            where userid = '".$consultant."'";
            $result = mysqli_query($db, $sql);
            echo $sql;
                //header('Location: convo.php?conv='.$_SESSION['convoid']);
            }
             else {
                echo $sql;
                echo "Klaida. Zinutes issiusti nepavyko";
                echo '<td> [<a href="convo.php?conv='.$id.'">Atidaryti</a>]</td>';
            }

            