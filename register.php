<?php require("header.php"); ?>

<div id="main">
<?php
if(!empty($_POST['username']) && !empty($_POST['password']))
{
    $username =$_POST['username'];
    $password = $_POST['password'];
    $email =$_POST['email'];
     
     $checkusername = mysql_query("SELECT * FROM users WHERE Username = '".$username."'");
      
     if(mysql_num_rows($checkusername) == 1)
     {
        echo "<h1>Error</h1>";
        echo "<p>Sorry, that username is taken. Please  <a href=\"login.php\">go back</a> and try again.</p>";
     }
     else
     {
        $registerquery = mysql_query("INSERT INTO users (Username, Password, EmailAddress) VALUES('".$username."', '".$password."', '".$email."')");
        if($registerquery)
        {
            echo "<h1>Success</h1>";
            echo "<p>Your account was successfully created. Please <a href=\"login.php\">click here to login</a>.</p>";
        }
        else
        {
            echo "<h1>Error</h1>";
            echo "<p>Sorry, your registration failed. Please <a href=\"login.php\">go back</a> and try again.</p>";    
        }       
     }
}
else
{
    ?>
     
   <h1>Register</h1>
     
   <p>Please enter your details below to register.</p>
    <div class="container"> 
        <form method="post" action="register.php" name="registerform" id="registerform">
            <label for="username">Username:</label>
            <input class="form-control" type="text" name="username" id="username" /><br />
            <label for="password">Password:</label>
            <input class="form-control" type="password" name="password" id="password" /><br />
            <label for="email">Email Address:</label>
            <input class="form-control" type="text" name="email" id="email" /><br />
            <input type="submit" name="register" id="register" class="btn btn-default" value="Register" />
        </form>
    </div>
    <?php
}
?>
 
</div>
</body>
</html>
