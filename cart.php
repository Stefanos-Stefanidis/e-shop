<?php require ('header.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  

<link rel="stylesheet" href="style.css" type="text/css" />
</head>  
<body>  
<div id="main">
<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
			?>
		<div class="container">
    <h2>Welcome <code><?=$_SESSION['Username']?></code>!</h2>
		<h3>Your cart contains:</h3>
    <?php
     
		$username = $_SESSION['Username'];
		$orderedItemsId = [];
		$i=0;
		$itemsNum = 1;
		$order = mysql_query("SELECT * FROM orders WHERE userName = '".$username."' order by itemName");
		$total_price = 0;
		?>
		
		<?php
		if (mysql_num_rows($order)==0) {
			echo '<h2>No items selected</h2>';
			echo	'<br><a class="btn btn-success"  href="allproducts.php">Add products</a></div>';
			echo	'<br><a class="btn btn-info"  href="orderReview.php">review your ordrer</a></div>';
			}
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
					echo '<form action="cart.php" method="post">';
					if($i==0) $itemsNum = 1;
					if($i>0){
						if($orderedItemsId[$i]['name'] == $orderedItemsId[$i-1]['name']) $itemsNum++;
						if($orderedItemsId[$i]['name'] != $orderedItemsId[$i-1]['name']) {
							echo  '<li>' .$orderedItemsId[$i-1]['name'].' : '.$itemsNum.' item(s)</li>';
							echo	'<button type="submit" name="removeThis" class="btn btn-default" value="'.$orderedItemsId[$i-1]['name'].'">Remove this product</button></br></br></br>';
							//echo	'<button type="submit" name="removeThis" class="btn btn-default" value="test">Remove this product</button></br></br></br>';
							$itemsNum=1;
						}
					}
					$i++;
				}
				
				echo	'<li>' .$orderedItemsId[$i-1]['name'].' : '.$itemsNum.' item(s)</li>';
				echo	'<button type="submit" name="removeThis" class="btn btn-default" value="'.$orderedItemsId[$i-1]['name'].'">Remove this product</button></br></br></br>';
				echo	'<li>Total Price: ' .$total_price.' €</li>';
				echo	'</form>';
				echo	'<br><a class="btn btn-primary"  href="submit.php">Submit your order</a><br>';
				echo	'<br><a class="btn btn-success"  href="allproducts.php">Add more products</a></div>';
				echo	'<br><a class="btn btn-info"  href="orderReview.php">review your ordrer</a></div>';
				
			}
			
			
	if (isset($_POST['removeThis'])){
			
			$deleteProduct = $_POST['removeThis'];
			$updateStatus = mysql_query("DELETE FROM orders WHERE itemName='".$deleteProduct."' AND username='".$username."'");
			echo	'<br><br><div class="container"><a class="btn btn-warning"  href="cart.php">Refresh</a></div>';
			
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
