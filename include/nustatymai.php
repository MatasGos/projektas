<?php
//nustatymai.php

define("DB_SERVER", "localhost");
define("DB_USER", "pma");
define("DB_PASS", "");
define("DB_NAME", "test");
define("TBL_USERS", "users");
define("TBL_MESSAGE", "message");
define("TBL_RESERVATIONS", "reservation");

$user_roles=array( 
	"Administratorius"=>"9",
	"Vartotojas"=>"4",
	"Konsultantas"=>"5",);   
define("DEFAULT_LEVEL","Vartotojas"); 
define("ADMIN_LEVEL","Administratorius");  
define("UZBLOKUOTAS","255");      

$uregister="both";  
define("EMAIL_FROM_NAME", "Demo");
define("EMAIL_FROM_ADDR", "demo@ktu.lt");
define("EMAIL_WELCOME", false);

?>
