<?php
include("db/inc_db.php");

//CSRF , Fillter , Sanitization Security

//Always filter your incoming data
session_start();
$user_name = $_POST['user_name'];
$pswd = $_POST['pswd'];

$res = $objLms->checkLogin($user_name,$pswd);

if(mysqli_num_rows($res)>=1)
{
	$row=mysqli_fetch_assoc($res);

	$_SESSION["user_name"]=$user_name;
	$_SESSION["user_full_name"]=$row['user_full_name'];
	$_SESSION["pswd"]=$pswd;
	$_SESSION["user_type"] = $row["user_type"];
	$_SESSION["login_status"]=1;
	echo $_SESSION["login_status"];
}
else
{
	//invalid login
	echo "0";	
}

?>