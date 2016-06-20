<?php require("header.php"); ?>

	<img id="image" class="img-responsive" src="img/frontpage.jpg">
	<br>
	<br>

	<h3>Recently added products</h3>
	<br><br>	 
	<div class="container">
		
		<?php
		

		$query = mysql_query("SELECT * FROM products ORDER BY id DESC LIMIT 6");

		while ($rows = mysql_fetch_array($query)) {

			$image = $rows['image'];
			$name = $rows ['name'];	
			$price = $rows ['price'];
			$category = $rows['category'];
			$id = $rows['id'];

			echo ' <div class="col-md-3 " id = "product-boxes">';
			echo  '<p id ="product-img">' .'<img  height = 100 width = 100 src= admin/'. $image . '>' . '</p>' ;
			echo  '<p> name: ' .  $name  . '</p>' ;
			echo  '<p> price: ' . $price  . '</p>' ;
			echo  '<p> category: ' . $category . '</p>'; 
		

			if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])){
				$username = $_SESSION['Username'];
					echo "<hr>";
				echo "<form method='post' >";
					echo '<input class="btn btn-default" type="submit" name="order" value="buy now">';
					echo  '<input type = hidden name = id value=' . $id . '>';
				echo "</form>";
				if (isset($_POST['order'])) {
					$id=$_POST["id"];
					$query = mysql_query("SELECT * FROM products WHERE id = '$id'");
					while ($rows = mysql_fetch_array($query)) {
						$orderedProduct = $rows ['name'];
					}

					$registerquery = mysql_query("INSERT INTO orders (itemName, userName) VALUES('".$orderedProduct."', '".$username."')");
			 		header("Location: index.php");

					
				}
			}
			echo '</div>';
			
			

		}


		?>

	</div>	
	<a href="allproducts.php" class="btn btn-primary btn-lg btn-block" role="button">Show all products</a>

	<div id="footer">
		<ul>
			<li> <a href="#"> About us</a> </li>
			<li> <a href="#">Information</a> </li>	
			<li> <a href="#">Terms & Conditions</a></li>		
			<a href="https://www.facebook.com" target="_blank">
				<li id="facebook" class="fa fa-facebook-official fa-3x" title="find us on facebook"></li>
			</a>
			<iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.351555599735!2d-73.99374738448417!3d40.73228924431075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259999d5525f9%3A0xb89a5259674d0486!2s797+Broadway%2C+New+York%2C+NY+10003%2C+USA!5e0!3m2!1sen!2sgr!4v1460445218850" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
			<a href="https://www.instagram.com" target = "_blank">
				<li id="instagram" class="fa fa-instagram fa-3x" title="find us on instagram"></li>
			</a>			
		</ul>
	</div>
</body>
</html>