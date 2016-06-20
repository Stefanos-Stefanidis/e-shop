
<?php require ("header.php");?>

	<form action = "index.php" method = "POST">
		<input type ="text" name="categoryField">
		<input type="submit" class="btn btn-default btn-sm" value ="add category" name = "addCategory">
	</form>
	<br>
	<br>
	<form action="index.php" method="POST" class="container" id="addProducts">
		<div class="form-group">
			<input type="text" class="form-control"  name="imageField" placeholder="image name">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" placeholder="add name" name="nameField">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" placeholder="add price" name="priceField" value="€">
		</div>

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
		</div>

		<input class="btn btn-default" type="submit" name="submit" value="submit"> 

	</form>
	<?php  

	/*for adding a product*/
	if (isset($_POST['submit'])){
		$imagePath = 'img/'.$_POST["imageField"];
		$productName = $_POST["nameField"];
		$productPrice = $_POST["priceField"];
		$productType = $_POST["typeField"];
		$submit = $_POST["submit"];

		if ($submit) {

			if ($imagePath && $productName && $productPrice) {
				$query = mysql_query("INSERT INTO products (image,name,price,category) VALUES ('$imagePath','$productName','$productPrice','$productType')");

			}
			else{
				echo "please fill the fields";
			}
		}
	}


	/*add category*/

	if (isset($_POST['addCategory'])){

		$categoryName = $_POST["categoryField"];
		if ($categoryName) {
			$query = mysql_query("INSERT INTO categories(category) VALUES ('$categoryName')");
		}
		else{
			echo "please fill a category";
		}

	}

	?>



</body>
</html>