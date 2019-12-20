<?php
// proclogin.php tikrina prisijungimo reikšmes
// formoje įvestas reikšmes išsaugo $_SESSION['xxxx_login']
// jei randa klaidų jas sužymi $_SESSION['xxxx_error']
// jei vardas ir slaptažodis tinka, užpildo $_SESSION['user'] ir $_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']  atžymi prisijungimo laiką DB
// po sėkmingo arba ne bandymo jungtis vėl nukreipia i index.php
//
// jei paspausta "Pamiršote slaptažodį", formoje turi būti jau įvestas vardas , nukreips į forgotpass.php, o ten pabars ir į newpass.php

session_start(); 
// cia sesijos kontrole: proclogin tik is login  :palikti taip
  if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "login"))
	{ header("Location: logout.php");exit;}

  include("include/nustatymai.php");
  include("include/functions.php");
  $_SESSION['prev'] = "proclogin";
  $_SESSION['name_error']="";
  $_SESSION['pass_error']="";
 
  $user=strtolower($_POST['user']);   // i mazasias raides
  $_SESSION['name_login']=$user;

// pasiruosiam klaidoms is anksto
  if (isset($_POST['problem'])) {  // nori pagalbos
	 $_SESSION['message']="Turi būti įvestas galiojantis vartotojo vardas";}  
  else {$_SESSION['message']="Pabandykite dar kartą";}
            
        if (checkname($user)) //vardo sintakse
        { list($dbuname,$dbpass,$dblevel,$dbuid,$dbemail, $cred, $time,$s, $m, $h)=checkdb($user);  //patikrinam ir jei randam, nuskaitom DB       
         if ($dbuname)  {  //yra vartotojas DB
           
		   $_SESSION['ulevel']=$dblevel; 
		   $_SESSION['userid']=$dbuid;
		   $_SESSION['umail']=$dbemail; 

           // $_SESSION['user'] - nustatysim veliau, jei slaptazodis  geras
		   if (isset($_POST['problem'])){  // vartotojas praso priminti slaptazodi
                              header("Location:forgotpass.php");exit;
                        }
		  	$pass=$_POST['pass'];$_SESSION['pass_login']=$pass;
          	if (checkpass($pass,$dbpass))
	       	{ // vardas ir slaptazodis geras 
			   if ($dblevel == UZBLOKUOTAS) 
			      {$_SESSION['message']="Jūsų paskyra užblokuota";
				   $_SESSION['name_error']=
				     "<font size=\"2\" color=\"#ff0000\">* Prisijungimas negalimas. Kreipkitės į administratorių</font>";
				  }
				else {
					// ar level galiojantis?
				$yra=false;
				foreach($user_roles as $x=>$x_value){if ($x_value == $dblevel) $yra=true;}	 
				if (!$yra)
				{$_SESSION['message']="Negaliojanti vartotojo rolė.";
				 $_SESSION['name_error']=
				     "<font size=\"2\" color=\"#ff0000\">* Prisijungimas negalimas. Kreipkitės į administratorių</font>";}
			 	else{
			  //prijungiam
              $_SESSION['user']=$user;
			  $_SESSION['prev']="proclogin";
			  $_SESSION['message']="";
			  $_SESSION['cred']=$cred; 
			  $_SESSION['time']=$time; 
			  $_SESSION['s']=$s; 
			  $_SESSION['m']=$m; 
			  $_SESSION['h']=$h; 
             }}
           }
    }}

  //           session_regenerate_id(true);
            header("Location:index.php");exit;
  
     ?>
  