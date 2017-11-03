<?php
/**
 * Shows this page when there is an error in logging in 
 * @author    Sayeed Md Ashraful Islam 	Roll : 48
 */
 
session_start();
session_destroy();
header("location:login.html");

?>
