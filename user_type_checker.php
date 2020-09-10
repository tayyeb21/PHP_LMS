<?php
 if($_SESSION['user_type']!='administrator')
 {
     session_destroy();
     header("location:../index.php?val=1");
 }
 else{}
?>