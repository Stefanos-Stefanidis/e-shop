<?php require("header.php"); ?>

<?php 
if (isset($_POST['order'])) {
	$id=$_POST["id"];
	$query = mysql_query("SELECT * FROM products WHERE id = '$id'");
	while ($rows = mysql_fetch_array($query)) {
		$name1 = $rows ['name'];
	}

	$registerquery = mysql_query("INSERT INTO orders (itemName, userName) VALUES('".$name1."', 'stef')");

	
}
?>