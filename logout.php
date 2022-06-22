<?php
echo "dsjhfdj";
include_once("config/config.php");
include_once("rs_lang.admin.php");
$objDb  		= new Database();
$objCommon 		= new Common();
$objAdminUser 	= new AdminUser();
$objValidate 	= new Validate();

echo $user_cd = $objAdminUser->user_cd;
echo $uname = $objAdminUser->username;
//session_name(PNAME);
//session_start();
$objAdminUser->setLogout();

 header("Location:./index.php");
?>