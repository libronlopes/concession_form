<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="navbar.css">
</head>
<body>

<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="welcome.php"><i class="fa fa-fw fa-home">Home</i> </a>
  <a href="concessionform.php"><i class="fa fa-file-o">Apply</i></a>
  <a href="edit_profile.php" ><i class="fa fa-edit">Edit Profile</i></a>
  <a href="change_pass.php"><i class="fa fa-lock">Change Password</i></a>
  <a href="logout.php"style="color: red"><i class="fa fa-fw fa-sign-out">Logout</i></a>
</div>

<?php
//session started
	session_start();

	$con=mysqli_connect("localhost","root","",'rail_concession');

	mysqli_select_db($con,'rail_concession');

	$Prn_no=$_SESSION['prn_no'];
	$query1=mysqli_query($con,"SELECT *from reg_data where prn_no='$Prn_no' ");
	$row=mysqli_fetch_array($query1);
	$query=mysqli_query($con,"SELECT *from reg_data where prn_no='$Prn_no' ");
	$rowcount=mysqli_num_rows($query);
	
	for ($i=1; $i <=$rowcount ; $i++) 
	{ 
		$row=mysqli_fetch_array($query);

$rev_dob=$row['dob'];
$new_dob = date("d-m-Y", strtotime($rev_dob));

//userwise data fetch
	if ($_SESSION["prn_no"]==true) 
	{?>
		<div id="main">
        <h1 align="left" style="margin-top: 0;margin-bottom:.5rem;font-size: 2.5rem"><a  style="text-decoration:none;color:#2c0975;font-weight:lighter;font-family: timesnewroman" href="https://www.mldcc.com/">M.L.DAHANUKAR COLLEGE OF COMMERCE</a></h1> 
            <button style="text-align: left;font-style: italic;" class="openbtn" onclick="openNav()">☰ 
                <?php echo ucwords("Welcome"." ".$row['name']."!");?></button>
		
		<br>
	<?php }
	else
	{
		header('location:login.php');
	}
	
?>


<!DOCTYPE HTML>
<html> 
<head> 
 	<title>Apply</title>
 	<link rel="stylesheet" type="text/css" href="navbar.css">
 	
    
</head> 
<body> 
	
	<div align="center" id="Sign-Up">
 	
	<h2 align="center">Railway Concession Application</h2> 
 	
 	<h3>Once saved cannot be edited or deleted at student level.</h3>	
 			
 		
 			
 			<table style="background-color:#97ccf7"  border="2px" cellspacing="5" cellpadding="4" > <tr> 
 				

				<tr style="background-color: #2190eb"><td colspan="0"  style="border:1;">Prn No.:
 					<b style="text-transform: uppercase;font-weight: bolder;"><?php echo $row['prn_no'];?></td>
 				
 				<td colspan="2" style="border:1">Name:
 					<b style="text-transform: uppercase;font-weight: bolder;"><?php echo $row['name'];?></td>
 				
 				<td colspan="2" style="border:1">Class:
 					<b style="font-weight: bolder;"><?php echo $row['class'];echo $row['stream'];?></td>
 				
 				<td style="border:1">Division:
					<b style="text-transform: uppercase;font-weight: bolder;"><?php echo $row['division'];?></td></tr>
				
				<tr><td style="">Date of Birth:
 					<?php echo $new_dob;?></td>
 					
 					
				
				
<?php

	} 
date_default_timezone_set('Asia/Kolkata');
$today = date( 'd-m-Y ', time () );

?>
		<form method="POST" action="formdata.php">

			<td colspan="2" style="border:1">Age:
 				<input type="number" min="17" max="25" name="age" required=""></td>
				
			<td>Gender:
				<label><input type="radio" name="gender" value="Male" onchange="genderCheck()">Male</label>
				<label><input type="radio" name="gender" value="Female" checked="" onchange="genderCheck2()">Female</label>
	

			<tr>
				<td>Class:
					<select name="rclass">
					<option value="I">I</option>
					<option value="II">II</option>
					</select></td>

				<td colspan="2">Period:
					<select name="rperiod" id="period">
					<option value="Quarterly">Quarterly</option>
					<option value="Monthly">Monthly</option>
					</select></td>

				<td>Old Pass Expiry Date:
					<input type="Date" style="width:50%" name="expdate" format="dd-mm-YYYY" required=""></td></tr>

			<tr>
				<td>Address:</td>
				<td><textarea placeholder="DO NOT USE SINGLE QUOTES ('')" name="raddress" rows="4" cols="40" required="" pattern="[^"']*"></textarea>
						
				<td>Station Name:
					<input type="text" name="rstation" style="text-transform: uppercase;" required="" pattern="^[a-zA-Z\s]+$"></td>

				<td>Application date:<input type="text" style="width:35%" value="<?php echo $today; ?>" class="form-control" 
					id="date" name="rdate" readonly></td>
			</tr>
			</tr> 

 		</table>
 				
 				<br>
 				<input type="submit" style="font-size: 20px;" name="submit1" value="submit"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 				
 				<input type="reset" name="cancel" style="font-size: 20px;border-radius: 4px;border:0px" value="Cancel">
 				</form> 
 		
 	</div> 
 	
 	<script type="text/javascript">
 	
		function genderCheck(){
			
			document.getElementById("period").disabled=false;
 			const date = document.getElementById('date').value;
 			//const date = "0200-03-04"
 			console.log("date:  " +date);
 			const month = date.slice(5,7);	
 			console.log(month);

 			if (month != "04" || month != "03") 
 			{
 				console.log("quarterly hidden");
 				document.getElementById("period").options[1].hidden = true;
 				document.getElementById("period").value = "Quarterly";
 			}
 			if (month == "04" || month == "03") 
 			{
 				console.log("in else")
 				document.getElementById("period").options[1].hidden = false;
 			}
 		}

 		function genderCheck2()
 		{
 			document.getElementById("period").disabled=false;
 			const date = document.getElementById('date').value;
 			//const date = "0200-03-04"
 			console.log("date:  " +date);
 			const month = date.slice(5,7);	
 				document.getElementById("period").options[1].hidden = false;
 			console.log(month);
 		
 		}
 	</script>

 	<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
</body> 
</html>