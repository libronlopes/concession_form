<?php
	session_start();
	$con=mysqli_connect("localhost","root","",'rail_concession');

	mysqli_select_db($con,'rail_concession');

	if (isset($_REQUEST["submit"])) 
	{
		$Prn_no=$_REQUEST['prn_no'];
		$Pass=$_REQUEST['password'];
		$hashed_password=md5($Pass);
		$result=mysqli_query($con,"SELECT * from reg_data where prn_no='$Prn_no'and password='$hashed_password'") or die("Failed to query database".mysqli_connect_error());

		$row=mysqli_num_rows($result);
		if ($row==true) 
		{
			$_SESSION['prn_no']=$Prn_no;
			header('location:concession_history.php');
		}
		else
		{
			echo "Username or Password is Incorrect!";
		}

	}
	
?>

<!DOCTYPE HTML>
 <html> 
 <head> 
 	<title>Login</title>
 </head> 
 <body id="body-color"> 
 	<div align="center" id="Login"> 
 		
 		<h1 align="center" style="color:#2c0975"><a style="text-decoration: none;" href="https://www.mldcc.com/">M.L.DAHANUKAR COLLEGE OF COMMERCE</a></h1>
		
		<h3 align="center">Railway Concession Application Login</h3> 
 		
 		<fieldset style="width:30%">
 			
 			<legend>Login</legend> 
 			
 			<table border="0"> <tr> 
 				
 				<form method="POST"> 
 				
 				<tr><td>PRN No.:</td>
 					<td> <input type="text" name="prn_no" required="" autofocus="" autocomplete=""></td> 
 				</tr> 
 				
 				<tr><td>Password:</td>
 					<td> <input type="password" name="password" ></td> 
 				</table>
 				
 				<input style="font-size: 20px;" id="button" type="submit" name="submit" value="Login">
 				
 				<a href="register.html">Register!</a>
 				</form> 
 		</fieldset>
 	</div> 
</body> 
</html>
 