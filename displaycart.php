<html>
	<head>
		<meta charset="utf-8">
		<title>Cart</title><!--Point to stylesheet-->
		<link rel="stylesheet" type="text/css" href="company.css">
	</head>
	<body>
	<header>
		<a href="ShowProducts.php"><h1>Honest Pete's Used Car Emporium</h1><a>
		<nav><!--Display Navigation links-->
		<a class="button" href="ShowProducts.php">Cars For Sale</a>
		<a class="button" href="insert.html">Add Cars</a>
		<a class="button" href="insertUserDetails.html">Add Customer</a>
		<a class="button" href="displaycart.php">View Cart</a>
		<a class="button" href="setupDB.php" id="Warning">Re-Setup Databases!</a>
		</nav>
</header>
<main>

<?php
session_start();//Start the php session
if (!isset($_SESSION["cart"]))//Check if $_SESSION["cart"] array variable exists
   $_SESSION["cart"] = array();//If not create the array
if(isset($_POST['delete']))//If user presses Delete button for a row
 {
 array_splice($_SESSION["cart"], $_POST["rownumber"],1);//remove row using array_splice function, which deletes the row number that was sent from the form

 }
$rows = count($_SESSION["cart"]);//count the number of different items in the cart and assign to array variable $rows
$cnt=0;//initialise variable $cnt for use in while loop
$finalTotal=0;//intialise $finalTotal variable
echo "<table border=1><tr> <th>description</th> <th>quantity</th><th>Image</th><th>Total</th></tr>";//open up a table
while ($cnt < $rows) {//while $cnt is less than $rows
    $row = $_SESSION["cart"][$cnt];//$row is equal to whatever is in the array at $cnt
	$total = "price" * "qty";
	
    echo "<tr>";//print a row of the table pulling name, qty, image, price etc from the $rows array
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['qty']."</td>";
    echo '<td><img src="images/'.$row["imagefilename"].'" alt="Car Image" height="100" width="100">' ."</td>";
	echo "<td>".$row['qty']*$row['price']."</td>";
    $finalTotal=$finalTotal+$row['qty']*$row['price'];//Add to final total
	echo '<td><form action="displaycart.php" method="post">';//Create form using POST to send value from delete button to the if statement at the start of the code
	echo '<input type="hidden" name="rownumber" value="'.$cnt.'" />';//gets row number using $cnt variable
	echo '<input type="submit" name="delete" value="Delete" /></form></td>';//Delete Button
     echo "</tr>";
     $cnt++;//increment $cnt
}
echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "<td>Final Total</td>";
echo "<td>".$finalTotal."</td>";//Display final total at end of table
echo "</tr>";
echo "</table>";



 if(isset($_POST['checkout']))//If checkout button is selected
 {
require_once 'db_login.php';//make sure we're logged into the database
$con = mysql_connect($db_hostname, $db_username, $db_password);//create connection to the database
if (!$con) die("Unable to connect to MySQL: " . mysql_error());//return error if unable to connect

 
$db_select=mysql_select_db("company", $con);//Select company database from the server

 if (!$db_select){//If it fails inform user of error
    echo("Could not select the database: <br />". mysql_error());
}
$name = $_SESSION["username"];//get the user name from the session array
$query = "SELECT customerID FROM customer WHERE name = '".$name."'";//query as a variable to get the row using the $name variable
$result = mysql_query($query);//run the query variable, save result
if (!$result) die ("Database access failed: " . mysql_error());//If fails return error
$value = mysql_result($result,0);//$value gets the customer ID from $result by looking at postion 0

//Attempt to insert customerID and the Total price into Orders Table using $value and $finalTotal
//Create variable $sql to save query
$sql="INSERT INTO orders (customerID, total)
 VALUES ('$value','$finalTotal')";
// Try running $sql query
if (mysql_query($sql, $con)) {
    echo "Added record to orders\n <br>";//If it added record show confirmation
} else {
    echo 'Error adding a record: ' . mysql_error() . "\n";//else show error
}

 }
?>
<form action="displaycart.php" method="post"><!--Create checkout button and POST to Checkout-->
<input type="submit" name="checkout" value="Checkout" /></form>
<form method="post" action="clearcart.php"><!--Create clear cart button and POST to clearcart.php page-->
<button type="submit">Clear Cart</button></form>
</main>
<footer>
		<details> 
			<summary><small>&copy; 2015 Peter Burton all rights reserved!</small></summary>
			<p><small><a href="mailto:p.burton@honestpetes.ie">Send me an email at p.burton@honestpetes.ie</a></small></p>
		</details> 
	</footer>
	</body>
	</html>


