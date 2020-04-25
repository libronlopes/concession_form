<?php 
	session_start();

	$con = new mysqli('localhost', 'root','','rail_concession');
    mysqli_select_db($con,'rail_concession');
    
    $Prn_no=$_SESSION['prn_no'];
    $query1=mysqli_query($con,"SELECT * FROM reg_data WHERE prn_no='$Prn_no' ");
    $row=mysqli_fetch_array($query1);
	
	$Opwd=$_POST['oldpass'];
	$Npwd=$_POST['newpass'];
	$Cnpwd=$_POST['connewpass'];
	$hashed_password=md5($Opwd);
	$hashed_password1=md5($Cnpwd);
	
	if ($hashed_password==$row['password']) 
	{
		$sql= ("UPDATE reg_data SET password='$hashed_password1' WHERE prn_no='$Prn_no' ");

		if(!mysqli_query($con,$sql))
		{
			echo "Error in Changing Password";
			header("refresh:3;change_pass.php");
		}
		else
		{
			echo "Password Changed Successfully!";
			header("refresh:2;change_pass.php");
		}
	}
	else
	{
		echo "Old Password is Incorrect";
		header("refresh:2;change_pass.php");
	}

    

?>