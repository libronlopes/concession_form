<?php
	session_start();
	$con=mysqli_connect("localhost","root","",'rail_concession');
	mysqli_select_db($con,'rail_concession');

	$id=$_POST['id'];
	
	echo($id);

    $sql="UPDATE con_data SET status=0, issued_on=null WHERE id='$id';";

    if(!mysqli_query($con,$sql))
	{
		// echo "Please Try Again. Record already exists";
		header("refresh:1000;register.html");
	}
	else
	{
		// echo "Submitted Successfully!";
		header("refresh:0;approved_applications.php");
		
	}
    ?>