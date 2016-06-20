<?php require ("header.php");?>

<?php

if (isset($_SESSION['loggedIn'])){
	if ($_SESSION['loggedIn'] == "trueAdmin"){


/*for the update*/

	if (isset($_POST['update'])){
		$imagePath = $_POST["bagImage"];
		$productName = $_POST["bagName"];
		$productPrice = $_POST["bagPrice"];
		$productType = $_POST["bagCategory"];
		$id = $_POST["id"];
		$select = $_POST["selectedCategory$id"];

		$updatequery = mysql_query("UPDATE products  SET  image ='$imagePath', name = '$productName' ,price = '$productPrice' , category = '$select' WHERE id = '$id'");



	}

	/*for dlt*/

	if (isset($_POST['dlt'])){

		$id = $_POST["id"];
		$updatequery = mysql_query("DELETE FROM products  WHERE id = '$id'");		
	}


		/*dld category*/

		if (isset($_POST['dltCategory'])){

			$categoryName = $_POST["selectedCategory"];
			$dltQuery = mysql_query("SELECT * FROM products WHERE category ='$categoryName'");
			while ($rows = mysql_fetch_array($dltQuery)) {
				$bagname = $rows['name'];
			}
			
			if (isset($bagname)) {
				echo "<h5>Not an empty category</h5>";
			}
			elseif(!isset($bagname)){
				$updatequery = mysql_query("DELETE FROM categories  WHERE category = '$categoryName'");	

			}
		}



	?>
		<?php   

		$Categoryquery = mysql_query("SELECT * FROM categories");
		
		echo "<form action= 'displayproducts.php' method='POST'>";
		echo "<select name='selectedCategory'>";
		while ($rows = mysql_fetch_array($Categoryquery)) {
			$bagCategory = $rows['category'];


			echo "<option>$bagCategory</option>";

		}
		echo "<input type = 'submit'name = 'dltCategory' value = 'delete category' class='btn btn-danger btn-xs'>";
		echo "</select>";
		echo "</form>";


		?>

		<br><br>

	<div id="displayProducts">
		<?php
		$query = mysql_query("SELECT * FROM products");
					$queryCategory = mysql_query("SELECT * FROM categories");

			echo "<form action= 'displayproducts.php' method='POST' class = 'container  form-inline'  id= 'product-display'>";
			$categoriesArray = array();
				while ($rows1 = mysql_fetch_array($queryCategory)) {
					$categoriesArray[] = $rows1['category'];
				}
		while ($rows = mysql_fetch_array($query))   {
			
			$id = $rows['id'];
			$image = $rows['image'];
			$name = $rows ['name'];	
			$price = $rows ['price'];
			$category = $rows ['category'];
			$id = $rows['id'];

			echo "<form action= displayproducts.php method=POST class = 'container  form-inline'  id= 'product-display'>";
			echo '<img id = "img-border" "height = 100 width = 100 src='. $image . '>' .'<br>';

				echo  '<li class ="col-md-3 " > <textarea rows = "1" name = "bagImage"  class="form-control " >' . $image  . '</textarea></li>';
				echo  '<li class ="col-md-3"><textarea rows = "1" name = "bagName" class="form-control " >' .  $name  . '</textarea></li>';
				echo  '<li class ="col-md-3"><textarea rows = "1" name = "bagPrice" class="form-control " >' . $price  . '</textarea></li>';
				echo  '<li class ="col-md-3"><textarea rows = "1" name = "bagCategory" class="form-control " >' . $category  . '</textarea></li>';
		
					echo "<select name='selectedCategory$id'>";
				$counter = 0;
				while ($counter<count($categoriesArray)) {
				
					echo "<option>".$categoriesArray[$counter]."</option>";
					$counter++; 
				}	

				
				echo "</select>";
		echo  '<input type = hidden name = id value=' . $id . '>';
		echo "<br>";
		echo '<input type = "submit" name = "update" value = "update" class="btn btn-primary">';
		echo '<input type = "submit" name = "dlt" value = "delete" class="btn btn-danger">';
			
		echo "<br>";	echo "<br>"; 	echo "<br>";

		echo "</form>";	

}

		?>
	</div>

<?php
}
}
else{
	echo "<h1>Restricted Area</h1>";
	echo "<p>You are not allowed to see this page, unless you log in as admin</p>";
	echo '<h3>Login<a href="../login.php"> here.</a></h3>';
	}
	?>
