<?php
    session_start();     
    if(!isset($_SESSION['loginname'])){
        header("location:login.php");
    };                           

?>