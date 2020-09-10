<?php
if(!isset($_SESSION['login_status']))
	header("location:index.php?val=0");
?>