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
        <title>Demonstracinis video</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
    <table style="border-width: 2px; border-style: dotted;"><tr><td>
         Atgal į [<a href="index.php">Pradžia</a>]
      </td></tr>
      <video width="320" height="240" controls>
  <source src="video.mp4" type="video/mp4">
Your browser does not support the video tag.
</video>
