<?php require ('header.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
 
<link rel="stylesheet" href="style.css" type="text/css" />
</head>  
<body>  
<div id="main">
<?php
		$orderContent = '';
		$orderDetails = '';
		$orderStatus = 'Pending';
		
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
			?>
		<div class="container" id="ordered-products">
    <h4><code><?=$_SESSION['Username']?></code>, add your personal data and submit your order</h4>
		<p>Your products:</p>
		<div style="margin-left:50px">
    <?php
		

		
		$username = $_SESSION['Username'];
		$orderedItemsId = [];
		$i=0;
		$itemsNum = 1;
		$total_price = 0;
		$order = mysql_query("SELECT * FROM orders WHERE userName = '".$username."' order by itemName");
		if (mysql_num_rows($order)==0) echo 'No items selected';
		else {
			
			while ($rows = mysql_fetch_array($order))
			{
					$item = $rows['itemName'];
					$orderedItemsId[$i]['name'] = $item;
					$itemData = mysql_query("SELECT * FROM products WHERE name = '".$item."'");
					
					while ($rowsItems = mysql_fetch_array($itemData)){
						$orderedItemsId[$i]['price'] = $rowsItems['price'];
						$total_price += $orderedItemsId[$i]['price'];
					}
					
					if($i==0) $itemsNum = 1;
					if($i>0){
						if($orderedItemsId[$i]['name'] == $orderedItemsId[$i-1]['name']) $itemsNum++;
						if($orderedItemsId[$i]['name'] != $orderedItemsId[$i-1]['name']) {
						
								$orderContent.= $orderedItemsId[$i-1]['name'].' : '.$itemsNum.' item(s)<br>';
						
								$itemsNum=1;
								echo	'<t><li>' .$orderedItemsId[$i-1]['name'].' : '.$itemsNum.' item(s)</li>';
						}
					}
					$i++;
				}
				$orderContent.= $orderedItemsId[$i-1]['name'].' : '.$itemsNum.' item(s)';
			}
				echo	'<li>' .$orderedItemsId[$i-1]['name'].' : '.$itemsNum.' item(s)</li>';
				echo	'<li>Total Price: ' .$total_price.' €</li></div>';
			
?>

<h3>Details</h3>
	<form action="submit.php" method="post">
		<div class="container">
			<label >Address</label>
			<input  class="form-control"  id ="textField" name="addressInput">
			<label for="phone">Phone Number</label>
			<input type="number" class="form-control"  id ="textField" name="phoneInput" >
			<p>You will be charged for: <?php echo $total_price?> €</p>
			<label>
				<input type="checkbox" name="cashbox" value="pay with cash">pay with cash
			</label>
			<br>
			<label for="cardNumber">Credit Card</label>
			<input type="cardNumber" class="form-control"  id ="textField" name="cardInput" >
			<label for="nameSurname">Owner's Name</label>
			<input type="cardNumber" class="form-control"  id ="textField" name="nameSurname" >
			<label for="expireDate">Expiration Date</label>
			<input type="expireDate" class="form-control"  id ="textField" name="expireDate" >
			<label for="code">Security Code</label>
			<input type="code" class="form-control"  id ="textField" name="code" >
			
			<br>
			<button type="submit" name="submit" class="btn btn-default">Ok</button>  	
			<a class="btn btn-default" href="cart.php">Back</a>
		</div>
	</form>
</div>
<?php

if (isset($_POST['submit'])){
	if (isset($_POST['cashbox'])) {
		if( !empty($_POST['addressInput']) && !empty($_POST['phoneInput'])){

			$address = $_POST['addressInput'];
			$phone = $_POST['phoneInput'];
			$orderDetails = "<br>Address: ".$address."<br>Phone Number: ".$phone;
			$orderDone = mysql_query("INSERT INTO submittedOrders (orderName, orderContent,orderDetails,orderStatus) VALUES('".$_SESSION['Username']."', '".$orderContent."','".$orderDetails."','".$orderStatus."')");
			echo $orderDone;
			header("Location: orderReview.php");
			
			$deleteSubmittedOrder = mysql_query("DELETE FROM orders WHERE userName = '".$username."'");
		}
		else{
			echo "<div><h3>Please fill the fields Address and Phone number</h3></div>";
		}

	}
	elseif(!isset($_POST['cashbox'])){
		if(!empty($_POST['addressInput']) && !empty($_POST['addressInput']) && !empty($_POST['addressInput']) && !empty($_POST['nameSurname']) && !empty($_POST['code'])&& !empty($_POST['expireDate'])){
	//Να μπει έλεγχος ότι δεν είναι κενά
	
	//Εκτός από νούμερο κάρτας, ονοματεπώνυμο, κωδικός ασφαλείας, ημερομηνία λήξης. Δεν τα αποθηκεύουμε κάπου.
	
		$address = $_POST['addressInput'];
		$phone = $_POST['phoneInput'];
		$orderDetails = "<br>Address: ".$address."<br>Phone Number: ".$phone;
		$orderDone = mysql_query("INSERT INTO submittedOrders (orderName, orderContent,orderDetails,orderStatus) VALUES('".$_SESSION['Username']."', '".$orderContent."','".$orderDetails."','".$orderStatus."')");
		echo $orderDone;
		header("Location: orderReview.php");
		
		$deleteSubmittedOrder = mysql_query("DELETE FROM orders WHERE userName = '".$username."'");
		
		}
		else{
			echo "<div><h3>Please fill in all fields above</h3></div>";
		}
	}


	
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
