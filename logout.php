<?php
include_once "db/inc_db.php";
session_start();
session_unset();
$objLms->conn->close();
session_destroy();
header("location:index.php");
?>