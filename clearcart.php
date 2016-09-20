<?php
session_start();//This starts a new session
$_SESSION["cart"] = array();//This creates a new session array
header("Location:ShowProducts.php");//This returns the user back to the show products page
?>