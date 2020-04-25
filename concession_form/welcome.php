 <?php
	
	session_start();
	$con=mysqli_connect("localhost","root","",'rail_concession');

	
	$Prn_no=$_SESSION['prn_no'];
	$query1=mysqli_query($con,"SELECT reg_data.*, con_data.* FROM reg_data INNER JOIN con_data ON reg_data.prn_no = con_data.prn_no WHERE reg_data.prn_no = '$Prn_no'; ");
	$row1=mysqli_fetch_array($query1);
	$query=mysqli_query($con,"SELECT * FROM reg_data WHERE prn_no='$Prn_no'");
	$row=mysqli_fetch_array($query);

	if ($_SESSION["prn_no"]==true) 
	{?>
		<?php
		include 'concession_history.php';
	}
	else
	{
		header('location:login.php');
	}
	
	

?>

