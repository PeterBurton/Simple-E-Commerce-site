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
include('db_login.php');
// Connect to database
$con = mysql_connect( $db_hostname, $db_username, $db_password );
echo 'after sql connect ';
if (!$con)//If can't connect give error
  {
  echo 'Could not connect: ' . mysql_error();
  }

// Create tables...


$sql = 'DROP DATABASE if exists company';//delete database if it already exists
if (mysql_query($sql, $con)) {
    echo "Database my_db was successfully dropped <br>\n";//If successful confirm
} else {
    echo 'Error dropping database: ' . mysql_error() . "\n";//Else show error message
}
$sql = "CREATE DATABASE company";//create company database
if (mysql_query($sql, $con)) {
    echo "Database my_db was successfully created <br>\n";
} else {
    echo 'Error creating database: ' . mysql_error() . "\n";
}
mysql_select_db("company", $con);//selct company database
//create $sql variable which will hold the create products table query
$sql = "CREATE TABLE IF NOT EXISTS products (
         productID    INT UNSIGNED  NOT NULL AUTO_INCREMENT,
         name         VARCHAR(30)   NOT NULL DEFAULT '',
         quantity     INT UNSIGNED  NOT NULL DEFAULT 0,
         price        DECIMAL(7,2)  NOT NULL DEFAULT 99999.99,
         imagefilename    VARCHAR(30)   NOT NULL DEFAULT '',
         PRIMARY KEY  (productID)
       )";
// Execute query in $sql
if (mysql_query($sql, $con)) {
    echo "Create table products\n <br>";//if succesful confirm
} else {
    echo 'Error creating table: ' . mysql_error() . "\n";//else show error message
}

//Change $sql variable to hold create customer table query
$sql = 	"CREATE TABLE IF NOT EXISTS customer (
		customerID INT UNSIGNED NOT NULL AUTO_INCREMENT,
		name VARCHAR(40) NOT NULL,
		age INT UNSIGNED NOT NULL DEFAULT 0,
		address VARCHAR(60),
		PRIMARY KEY (customerID)
		)";
//Execute query in $sql		
if (mysql_query($sql, $con)) {
    echo "Create table customer\n <br>";
} else {
    echo 'Error creating table: ' . mysql_error() . "\n";
}
//Change value of $sql to hold query for creating orders table
$sql = "CREATE TABLE IF NOT EXISTS orders (
 orderID INT UNSIGNED NOT NULL AUTO_INCREMENT,
 customerID INT UNSIGNED,
 total DECIMAL(7,2) NOT NULL DEFAULT 99999.99,
 PRIMARY KEY (orderID)
 )";
// Execute query in $sql
if (mysql_query($sql, $con)) {
 echo "Create table orders\n <br>";
} else {
 echo 'Error creating table: ' . mysql_error() . "\n";
}



// Change $sql to insert Car 1 query
$sql="INSERT INTO products (name, quantity, price, imagefilename)
	VALUES
	('car 1','5','23.4','image1.jpg')";
//Execute query in $sql	
if (mysql_query($sql, $con)) 
	{
    echo "Added record to products\n <br>";
	}
	else 
	{
    echo 'Error adding a record: ' . mysql_error() . "\n";
	}

// Change $sql to insert Car 2 query
$sql="INSERT INTO products (name, quantity, price, imagefilename)
	VALUES
	('car 2','5','23.4','image2.jpg')";
//Execute query in $sql 
if (mysql_query($sql, $con)) 
	{
    echo "Added record to products\n <br>";
	} 
else 
	{	
    echo 'Error adding a record: ' . mysql_error() . "\n";
	}

	// Change $sql to insert Car 3 query
$sql="INSERT INTO products (name, quantity, price, imagefilename)
	VALUES
	('car 3','5','23.4','image3.jpg')";
	//Execute $sql query
if (mysql_query($sql, $con)) 
	{
    echo "Added record to products\n <br>";	
	} 
else 
	{
    echo 'Error adding a record: ' . mysql_error() . "\n";
	}
//Close connection
mysql_close($con);

echo "    Database setup program complete";//Confirm success
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