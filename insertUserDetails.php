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
require_once 'db_login.php';//Make sure we're logged into the database server
$con = mysql_connect($db_hostname, $db_username, $db_password);//make connection to the database server
if (!$con) die("Unable to connect to MySQL: " . mysql_error());//If connection fails return error

 
$db_select=mysql_select_db("company", $con);//select company database from server

 if (!$db_select){
    echo("Could not select the database: <br />". mysql_error());//If cannot select database return the SQL error
}
//Initialise variables using values from POST data
$name = $_POST['name'];
$age = $_POST['age'];
$address = $_POST['address'];
 
// attempt to insert variables into customer table
//create $sql variable which will be the query
$sql="INSERT INTO customer (name, age, address)
 VALUES ('$name','$age','$address')";
echo $sql;
// Insert one record into customer table
if (mysql_query($sql, $con)) {
    echo "Added record to customer\n <br>";
} else {
    echo 'Error adding a record: ' . mysql_error() . "\n";
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