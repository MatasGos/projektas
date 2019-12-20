<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 
    updatecreds();
     echo "<table width=100% border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
        echo "<tr><td>";
        echo "Prisijungęs vartotojas: <b>".$user."</b>     Rolė: <b>".$role."</b>       <a href=\"credit.php\">Kreditai</a>: ".$_SESSION['cred']." <B> <br> ";
        echo "</td></tr><tr><td>";
        if ($_SESSION['user'] != "guest") echo "[<a href=\"useredit.php\">Redaguoti paskyrą</a>] &nbsp;&nbsp;";
        echo "[<a href=\"konsultantai.php\">Konsultantai</a>] &nbsp;&nbsp;";
        echo "[<a href=\"konsultantaitop.php\">TOP Konsultantai</a>] &nbsp;&nbsp;";
        if (($userlevel == $user_roles["Konsultantas"])) {
          echo "[<a href=\"convos.php\">Jusu Konsultacijos</a>] &nbsp;&nbsp;";
         }  
        //echo "[<a href=\"convos.php\">Jusu Konsultacijos</a>] &nbsp;&nbsp;";
        echo "[<a href=\"video.php\">VIDEO</a>] &nbsp;&nbsp;";
        if (($userlevel == $user_roles["Konsultantas"])) {
            echo "[<a href=\"clients.php\">Klientai </a>] &nbsp;&nbsp;";
       		}   
        //Trečia operacija tik rodoma pasirinktu kategoriju vartotojams, pvz.:
        // if (($userlevel == $user_roles["Dėstytojas"]) || ($userlevel == $user_roles[ADMIN_LEVEL] )) {
        //     echo "[<a href=\"operacija3.php\">Demo operacija3</a>] &nbsp;&nbsp;";
       	// 	}   
        //Administratoriaus sąsaja rodoma tik administratoriui
        if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
            echo "[<a href=\"admin.php\">Administratoriaus sąsaja</a>] &nbsp;&nbsp;";
        }
        echo "[<a href=\"logout.php\">Atsijungti</a>]";
      echo "</td></tr></table>";
?>       
    
 