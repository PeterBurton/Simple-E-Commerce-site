<html>
   <head>
      <title>Used Cars for sale</title>
	  <link rel="stylesheet" type="text/css" href="company.css">
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script type="text/javascript" language="javascript">
         function addToCart(id,fieldname){
            var num = document.getElementById(fieldname).value;
            $.post( 
                  "updatecart.php",
                  { prodid: id,
                    qty: num },
                  function(data) {
                    // uncomment this line to see php response 
 //$('#stage').html(data);
                  }
               );
         }
   </script>
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
<div id="stage" style="background-color:#FFFFFF;">
      </div>
<form action="ShowProducts.php" method="post">
<div id="userdetails">
<!--Add User Login Form at top of page, posts to the php within this page-->
Username:<input type="text" name="username" id="username" value="" />
 <input type="submit" value="Login">
</form>		       
</div>	  
	  
	  
<?php
// Start the session
session_start();
if (isset($_POST["username"]))
{//Get the username for this session from the post value
$_SESSION["username"] = $_POST["username"];

}
if (isset($_SESSION["username"])){
    $username = $_SESSION["username"]; //create $username variable so it can be echoed to screen that user is logged in
    echo "<p> You are logged in as $username </p>";
}
require_once 'db_login.php';//Make sure logged into Database Server
$db_server = mysql_connect($db_hostname, $db_username, $db_password);//create connection to server
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());//If connection fails give error

mysql_select_db($db_database)//select databse
or die("Unable to select database: " . mysql_error());

$query = "SELECT * FROM products";//variable with query to select all from products
$result = mysql_query($query);//run query assign to $result array

if (!$result) die ("Database access failed: " . mysql_error());//If this fails inform user

$rows = mysql_num_rows($result);//creates array from $result
echo "<table border=1><tr> <th>description</th> <th>Price</th><th>Image</th></tr>";
$count=1;
while ($row = mysql_fetch_assoc($result)) {//$row array is a row from the table as an array
    echo "<tr>";
    echo "<td>".$row['name']."</td>";//print a row of the table pulling name, price, image, Quantity etc from the $row array
    echo "<td>".$row["price"]."</td>";
    echo '<td><img src="images/'.$row["imagefilename"].'" alt="Car" height="100" width="100">' ."</td>";
     echo '<td><span>Quantity</span>';
     echo  '<input type="number" size="2" maxlength="2" id="qty'.$count.'" value='.$row["quantity"].' /></td>';
    
     echo '<input type="hidden" name="id" value="'.$row['productID'].'"/>';
     echo '<td><input type="button" id="driver" value="Buy" onclick="addToCart(';
     echo ''.$row['productID'].','."'qty".$count."')".'"/></td>'; 
     echo "</tr>";
     $count++;//increment the counter
}

echo "</table>";
echo '<form method="post" action="displaycart.php">';//post to displaycart.php
echo '<button type="submit">Display Cart</button></form>'; 
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
