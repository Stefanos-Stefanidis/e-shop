<?php require ("header.php");?>

<?php

if (isset($_SESSION['loggedIn'])){
	if ($_SESSION['loggedIn'] == "trueAdmin"){

		?>
		<div class="container" id="submitted-orders">
    <h1>Submitted Orders</h1>
    <?php
    
		$orderedItemsId = [];
		$i=0;
		$itemsNum = 1;
		$order = mysql_query("SELECT * FROM submittedorders");
		
		if (mysql_num_rows($order)==0) echo 'No orders submitted';
		else {
			while ($rows = mysql_fetch_array($order))
			{
					$orderId = $rows['id'];
					$orderName = $rows['orderName'];
					$orderContent = $rows['orderContent'];
					$orderDetails = $rows['orderDetails'];
					$orderStatus = $rows['orderStatus'];
					
					echo	'<form action="orderReview.php" method="post"><div class="container">';
					echo	'<input class="form-control" id="textField" name="orderId" value='.$orderId.' readonly style="display:none">';
					echo	'<h3>Client: ' .$orderName.' - Order Id: ' .$orderId.'</h3>';
					echo	'<p><h4>Products</h4>' .$orderContent.'</p>';
					echo	'<h4>Status: ' .$orderStatus.'</h4>';
					
					echo	'<button type="submit" name="updateStatus" class="btn btn-default" value="Pending">Update status to "Pending"</button> ';
					echo	'<button type="submit" name="updateStatus" class="btn btn-warning" value="Processing">Update status to "Processing"</button> ';
					echo	'<button type="submit" name="updateStatus" class="btn btn-info" value="Sent">Update status to "Sent"</button> ';
					echo	'<button type="submit" name="updateStatus" class="btn btn-success" value="Delivered">Update status to "Delivered"</button> ';
					echo	'<button type="submit" name="updateStatus" class="btn btn-danger" value="Deleted">Cancel Order</button> ';
					
					
					//~ echo	'<input class="form-control" id="textField" name="TEMPupdateStatus">';
					//~ echo	'<button type="submit" name="updateStatus" class="btn btn-danger">Submit new status</button> '; /* Αντί για κουμπάκια αλλαγής στάτους, πληκτρολογούμε εδώ ό,τι θέλουμε και πατάμε submit*/
					
					echo	'<br><br><a class="btn btn-default" href="orderReview.php">Refresh</a>';
					echo	'</div></form><br><br>';
			}
		}
		?></div><?php
	}
	
	if (isset($_POST['updateStatus'])){
			
			//$newStatus = $_POST['TEMPupdateStatus'];
			$newStatus = $_POST['updateStatus'];
			$updateId = $_POST['orderId'];
			$updateStatus = mysql_query("UPDATE submittedOrders SET orderStatus='".$newStatus."' WHERE id='".$updateId."'");
			
			if ($newStatus == "Deleted"){
					$updateStatus = mysql_query("DELETE FROM submittedOrders WHERE id='".$updateId."'");
			}
			
			header("Location: orderReview.php");
	}
}
else
{
	header("Location: index.php");
}
?>
