<?php
	
	$con=mysqli_connect('localhost','root','','rail_concession');
	if(!$con)
	{
		echo "Not connected to Server";
	}
	else if(!mysqli_select_db($con,'rail_concession'))
	{
		echo "Database not selected";
	}
	
//initializing database variables and names
	$Class=$_POST['class'];
	$RollNo=$_POST['rollno'];
	$Division=$_POST['division'];
	$Prn_no=$_POST['prn_no'];

//storing data in database from registration form.
	$sql="UPDATE reg_data SET class='$Class',rollno='$RollNo',division='$Division' WHERE prn_no='$Prn_no' ";
	
//if condition to check if user already exists.	
	if(!mysqli_query($con,$sql))
	{
		echo "Please Try Again. Record already exists";
		header("refresh:1000;register.html");
	}
	else
	{
		echo "Submitted Successfully!";
		header("refresh:1;edit_profile.php");
	}
	
	

?>