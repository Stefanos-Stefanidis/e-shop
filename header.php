<?php require ('connect.php'); ?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css" />

	
	<title>Online bag store</title>
	<link href="img/favicon.ico" rel="icon" type="image/x-icon"/>
</head>
<body>

	<div id="top-menu"> 

		<div  id="home-img"> <a href="index.php"> <img src="img/shoppe.png"></a></div>
		
		<?php
		if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])){

		echo '<li class="fa fa-user"> <a rel="nofollow" href="logout.php">Logout</a> </li>'
		?>	
		<li class="fa fa-shopping-cart"> <a href="cart.php">cart</a> </li>
		<li class="fa fa-phone">  223525432 </li>
		<?php } 
		else{
			?>
			<li  class="fa fa-user"> <a href="login.php">login/register</a> </li>
			<li class="fa fa-shopping-cart"> <a href="cart.php">cart</a> </li>
			<li class="fa fa-phone">  223525432 </li>
		<?php
		}
		?>

		
		

	</div>