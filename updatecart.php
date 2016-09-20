<?php
echo 'hello';
if (isset($_POST["prodid"]))//Chechs for a product ID
{
session_start();//Start session
if (!isset($_SESSION["cart"]))//Check if $_SESSION["cart"] array variable exists
   $_SESSION["cart"] = array();//If not create the array
require_once 'db_login.php';//Make sure we're logged in
$db_server = mysql_connect($db_hostname, $db_username, $db_password);//create connection to server
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());//If connection fails inform user

mysql_select_db($db_database)//select database
or die("Unable to select database: " . mysql_error());
//create $query variable to hold the SQL query. 
//query will get all items from products table with the POST product ID value
$query = "SELECT * FROM products where productID=".$_POST["prodid"];
//Execute the query, assign to variable $result
$result = mysql_query($query);
//If it fails show error message
if (!$result) die ("Database access failed: " . mysql_error());


$rows = count($_SESSION["cart"]);//$rows variable created from size of $_SESSION["cart"] array
$cnt=0;//initialise counter
$found =0;//initialise $found variable to 0
while ($cnt < $rows) {
 $row = $_SESSION["cart"][$cnt];//$row array is equal to the row in the cart at the counter value

 if ($row["productID"] == $_POST["prodid"]){//If product ID in $row matches the posted product ID
 $found = 1;//Set $found to 1
 $_SESSION["cart"][$cnt]["qty"] += $_POST["qty"];//increase the quantity of that particular product by quantity posted
 break;//break the loop
 }
$cnt++;//increment count
}
if ($found ==0)//if $found = 0 that means the product isn't already in the cart and needs to be added
 while ($row = mysql_fetch_assoc($result)) {//set $row array to equal the result of the query
 $row['qty'] = $_POST["qty"];//add the quantity from the POST values
 array_push($_SESSION["cart"], $row);//array_push() treats array as a stack, and pushes the passed variables in $row onto the end of the $_SESSION["cart"] array
 }

$rows = count($_SESSION["cart"]);//$rows given value of the count of the amount of rows in the cart
$cnt=0;//set counter to 0
echo "<table border=1><tr> <th>description</th> <th>quantity</th><th>Image</th></tr>";//open up a table
while ($cnt < $rows) {//while counter is less than number of rows
    $row = $_SESSION["cart"][$cnt];
    echo "<tr>";//print a row of the table pulling name, qty, image, etc from the $row array
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row["qty"]."</td>";
    echo '<td><img src="images/'.$row["imagefilename"].'" alt="Car Image" height="100" width="100">' ."</td>";
    
     echo "</tr>";
     $cnt++;//increment counter
}

echo "</table>";//close table
}
?>
 

