<?php
	session_start();
	
	$con=mysqli_connect("localhost","root","",'rail_concession');
	mysqli_select_db($con,'rail_concession');

	date_default_timezone_set('Asia/Kolkata');
	$today = date( 'd-m-Y ', time () );

	
	$id=$_POST['id'];
	echo($id);

    $sql="UPDATE con_data SET status=1, issued_on='$today' WHERE id='$id';";

    if(!mysqli_query($con,$sql))
	{
		// echo "Please Try Again. Record already exists";
		header("refresh:1000;register.html");
	}
	else
	{
		// echo "Submitted Successfully!";
	
		header("refresh:0;pending_applications.php");
		
	}

	?>