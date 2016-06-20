<?php require("header.php"); ?>

<h3>by category products</h3>

<form action="bycategory.php" method="POST">
	<div class="form-group">
		<select class="form-control" name="typeField">
			<?php
			$query = mysql_query("SELECT * FROM categories");

			while ($rows = mysql_fetch_array($query)) {
				$categories = $rows['category'];

				echo "<option>$categories</option>";
			}

			?>

		</select>
		<input class="btn btn-default" type="submit" name="submit" value="go">
	</div>
</form>
<div class="container">
	<?php 	
	if (isset($_POST['submit'])){
		$categoryName = $_POST['typeField'];
		$query = mysql_query("SELECT * FROM products WHERE category= '$categoryName' ORDER BY id DESC");
		while ($rows = mysql_fetch_array($query)) {

			$image = $rows['image'];
			$name = $rows ['name'];	
			$price = $rows ['price'];
			$category = $rows['category'];
			$id = $rows['id'];

			echo ' <div class="col-md-3 " id = "product-boxes">';
			echo  '<p>' .'<img  height = 100 width = 100 src= admin/'. $image . '>' . '</p>' ;
			echo  '<p> name: ' .  $name  . '</p>' ;
			echo  '<p> price: ' . $price  . '</p>' ;
			echo  '<p> category: ' . $category . '</p>'; 

			if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])){
				$username = $_SESSION['Username'];
					echo "<hr>";
				echo "<form method='post'>";
					echo '<input class="btn btn-default" type="submit" name="order" value="buy now">';
					echo  '<input type = hidden name = id value=' . $id . '>';
				echo "</form>";
				if (isset($_POST['order'])) {
					$id=$_POST["id"];
					$query = mysql_query("SELECT * FROM products WHERE id = '$id'");
					while ($rows = mysql_fetch_array($query)) {
						$name1 = $rows ['name'];
					}

					$registerquery = mysql_query("INSERT INTO orders (itemName, userName) VALUES('".$name1."', '".$username."')");
			 		header("Location: bycategory.php");
					
				}
			}
			echo '</div>';
		}
	}
	?>
</div>