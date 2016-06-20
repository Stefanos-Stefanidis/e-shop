<?php require ('header.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
 
<title>User Management System (Tom Cameron for NetTuts)</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>  
<body>  
<div id="main">
<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
		?>
    <h1>Submitted Orders</h1>
    <?php
     
		$username = $_SESSION['Username'];
		$orderedItemsId = [];
		$i=0;
		$itemsNum = 1;
		if($_SESSION['LoggedIn']!="adminTrue") $order = mysql_query("SELECT * FROM submittedorders WHERE orderName = '".$_SESSION['Username']."'");
		//if($_SESSION['LoggedIn']=="adminTrue") $order = mysql_query("SELECT * FROM submittedorders");
		
		if (mysql_num_rows($order)==0) echo 'No orders submitted';
		else {
			
			while ($rows = mysql_fetch_array($order))
			{
					$orderId = $rows['id'];
					$orderName = $rows['orderName'];
					$orderContent = $rows['orderContent'];
					$orderDetails = $rows['orderDetails'];
					$orderStatus = $rows['orderStatus'];
					
				//if($_SESSION['LoggedIn']=="adminTrue"){
				echo "<div class='container' id='submited-orders'>";
					echo "<div class='col-md-6'>";
						echo "<ul>";
						echo	'<li>Order Id:' .$orderId.'</li>';
						echo	'<li>Name:' .$orderName.'</li>';
						echo	'<li id= "your-order">Your order:<br>' .$orderContent.'</li>';
						echo "</ul>";
					echo "</div>";
					echo "<div class='col-md-6'>";
						echo "<ul>";
						echo	'<li> <h2>Details:</h2>' .$orderDetails.'</li>';
						echo	'<li id= "status-order">Status: ' .$orderStatus.'</li><br><br>';
						echo "</ul>";
					echo "</div>";
				echo "</div>";
				//}
			}
			
			//~ if($_SESSION['LoggedIn']!="adminTrue"){
				//~ echo	'<li>Name:' .$orderName.'</li>';
				//~ echo	'<li>Your order:' .$orderContent.'</li>';
				//~ echo	'<li>Details:' .$orderDetails.'</li>';
				//~ echo	'<li>Status:' .$orderStatus.'</li>';
			//~ }
}
}
else
{
   header("Location: index.php");
    
}
?>
 
</div>
</body>
</html>
