<html>
	<head>
		<meta charset="utf-8">
		<title>Cart</title>
		<link rel="stylesheet" type="text/css" href="company.css">
	</head>
	<body>
<header>
		<a href="ShowProducts.php"><h1>Honest Pete's Used Car Emporium</h1><a>
		<nav>
		<a class="button" href="ShowProducts.php">Cars For Sale</a>
		<a class="button" href="insert.html">Add Cars</a>
		<a class="button" href="insertUserDetails.html">Add Customer</a>
		<a class="button" href="displaycart.php">View Cart</a>
		<a class="button" href="setupDB.php" id="Warning">Re-Setup Databases!</a>
		</nav>
	</header>
	<main>
<?php
/*
Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password)
*/
require_once 'db_login.php';//make sure we're logged into the database server
$con = mysql_connect($db_hostname, $db_username, $db_password);//create connection to the database server
if (!$con) die("Unable to connect to MySQL: " . mysql_error());//if it fails give error message

 
$db_select=mysql_select_db("company", $con);//Select the company database from server

 if (!$db_select){
    echo("Could not select the database: <br />". mysql_error());//If unable to select show error message
}
//Initialise variables using values posted from insert.html page
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$image = $_POST['image'];
 
// attempt to insert variables into products table
//create $sql variable which will be the query
$sql="INSERT INTO products (name, quantity, price, imagefilename)
 VALUES ('$name','$quantity','$price','$image')";
echo $sql;
// Try and insert into products table
if (mysql_query($sql, $con)) {
    echo "Added record to products\n <br>";//If successful confirm
} else {
    echo 'Error adding a record: ' . mysql_error() . "\n";//else return error message
}
 
// close connection
mysql_close($con);
?>
</main>
<footer>
		<details> 
			<summary><small>&copy; 2015 Peter Burton all rights reserved!</small></summary>
			<p><small><a href="mailto:p.burton@honestpetes.ie">Send me an email at p.burton@honestpetes.ie</a></small></p>
		</details> 
	</footer>
	</body>
</html>	