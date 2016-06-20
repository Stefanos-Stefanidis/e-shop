<?php require("header.php"); ?>




<h3>Welcome</h3>
<form action="login.php" method="post">

	<div class="container">
    <label >username</label>
    <input  class="form-control"  id ="textField" name="usernameInput">

    <br>
    <br>
    <label for="exampleInputPassword1">password</label>
    <input type="password" class="form-control"  id ="textField" name="passwordInput" >
  	<br>
  	<button type="submit" name="login" class="btn btn-default">log in</button>
  	
</div>
</form>


<?php

if (isset($_POST['login'])){

	$username = $_POST['usernameInput'];
	$password = $_POST['passwordInput'];	


	
	$query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
	$result = mysql_query($query) ;
	
	$count = mysql_num_rows($result);
	
	if ($count == 1)
	{
		$_SESSION['loggedIn'] = "trueAdmin";
		header("Location: admin/index.php");
		return;
	}
	
	$checklogin = mysql_query("SELECT * FROM users WHERE Username = '".$username."' AND Password = '".$password."'");
    
    if(mysql_num_rows($checklogin) == 1)
    {
        $row = mysql_fetch_array($checklogin);
        $email = $row['EmailAddress'];
         
        $_SESSION['Username'] = $username;
        $_SESSION['EmailAddress'] = $email;
        $_SESSION['LoggedIn'] = 1;
         
        echo "<h1>Success</h1>";
        echo "<p>We are now redirecting you to the member area.</p>";
        header("Location: index.php");
        
    }

	else
	{
		$_SESSION['loggedIn'] = "false";
		echo "<p>Wrong username or password.</p>";
	}

}

?>
	<br>
  	<br>
  	<br>
  	 <h3 class = "container">Do not have an account? <br>register<a href="register.php"> here.</a></h3>
</body>
</html>
