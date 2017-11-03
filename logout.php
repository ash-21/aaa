<?php
/**
 * Destroys the session
 * @author    Sayeed Md Ashraful Islam 	Roll : 48
 */
 
session_start();
session_destroy();
header("location:login.html");

?>
