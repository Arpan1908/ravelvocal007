<?php 
   require_once "config.php";
   $username = $password = "";
   $username_err = $password_err = "";

   if($_SERVER['REQUEST_METHOD']=="POST"){
       
     if(empty(trim($_POST["username"]))){
         $username_err = "email cant be blank";
     }
     else{
         $sql = "SELECT id FROM details WHERE username = ?";
         $stmt = mysqli_prepare($conn, $sql);
         
         if($stmt)
         {
             mysqli_stmt_bind_param($stmt, "s", $param_username);
 
             
             $param_username = trim($_POST['username']);
 
             
             if(mysqli_stmt_execute($stmt)){
                 mysqli_stmt_store_result($stmt);
                 if(mysqli_stmt_num_rows($stmt) == 1)
                 {
                     $username_err = "This username is already taken"; 
                 }
                 else{
                     $username = trim($_POST['username']);
                 }
             }
             else{
                 echo "Something went wrong";
             }
         }
     }
 
     mysqli_stmt_close($stmt);
 
 
 
 if(empty(trim($_POST['password']))){
     $password_err = "Password cannot be blank";
 }
 elseif(strlen(trim($_POST['password'])) < 5){
     $password_err = "Password cannot be less than 5 characters";
 }
 else{
     $password = trim($_POST['password']);
 }
 
 
 if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
     $password_err = "Passwords should match";
 }
 
 
 
 if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
 {
     $sql = "INSERT INTO details (username, password) VALUES (?, ?)";
     $stmt = mysqli_prepare($conn, $sql);
     if ($stmt)
     {
         mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
 
         // Set these parameters
         $param_username = $username;
         $param_password = password_hash($password, PASSWORD_DEFAULT);
 
         
         if (mysqli_stmt_execute($stmt))
         {
             header("location: login.php");
         }
         else{
             echo "Something went wrong......";
         }
     }
     mysqli_stmt_close($stmt);
 }
 mysqli_close($conn);
 }
 
 ?>
 

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
      
</head>
<body>

<header>
	
<nav>
	<div class="logo"> <h1 style="font-size: 20px;"> Ravel Vocal </h1> </div>
	<div class="menu">
		<a href="index.php">Home</a>
		
		<a href="register.php">Register</a>
		<a href="login.php">Login</a>
	</div>
</nav>

<div class="container">
	<!-- code here -->
	<div class="card">
		
		<form class="card-form">
			<div class="input">
				<input type="email" class="input-field" name="username" placeholder="email" id="inputEmail4" required/>
				
			</div>
						<div class="input">
				<input type="password" class="input-field" name="password" placeholder="password" id="inputPassword4" required/>
				
			</div>
						<div class="input">
				<input type="password" class="input-field" name="confirm_password" placeholder="Confirm password" id="inputP assword" required/>
				
			</div>
            
			<div class="action">
				<button class="action-button">Get started</button>
			</div>
		</form>
		<div class="card-info">
			<p>By signing up you are agreeing to our <a href="#">Terms and Conditions</a></p>
		</div>
	</div>
</div>











</body>
</html>