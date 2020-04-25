<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="navbar.css">
</head>
<body>

<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="concession_history.php"><i class="fa fa-fw fa-home">Home</i> </a>
  <a href="concessionform.php"><i class="fa fa-file-o">Apply</i></a>
  <a href="edit_profile.php" ><i class="fa fa-edit">Edit Profile</i></a>
   <a href="change_pass.php"><i class="fa fa-lock">Change Password</i></a>
  <a href="logout.php"style="color: red"><i class="fa fa-fw fa-sign-out">Logout</i></a>
</div>

<?php


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



//userwise data fetch
	if ($_SESSION["prn_no"]==true) 
	{?>
		<div id="main">
		<h1 align="left" style="margin-top: 0;margin-bottom:.5rem;font-size: 2.5rem"><a  style="text-decoration:none;color:#2c0975;font-weight:lighter;font-family: timesnewroman" href="https://www.mldcc.com/">M.L.DAHANUKAR COLLEGE OF COMMERCE</a></h1> 
            <button style="text-align: left;font-style: italic;" class="openbtn" onclick="openNav()">☰ 
                <?php echo ucwords("Welcome"." ".$row['name']."!");?></button>
  
	
</div>
			
				
	
	


<body>
 	<div align="center" id="Edit">
 	
 	
	 
 		
 		<fieldset style="width:35%;">
 			
 			<legend >Edit Profile</legend> 
 			
 			<table border="0" cellspacing="5"> <tr> 
 				
 				<form method="POST" action="edit_profile_db.php" >

 				<td>Stream:
					 <td><input type="text"  style="" name="stream" value="<?php echo $row['stream'] ?>" disabled>
				  	</td>
				

 				<td>Class:</td>
 					<td><select name="class" required="">
				  		<option value="FY">FY</option>
				  		<option value="SY">SY</option>
				  		<option value="TY">TY</option>
					</select></td></tr>
					 
					 
 				<tr><td>Name:</td>
 					<td><input style="text-transform: uppercase;" value="<?php echo $row['name'] ?>" type="text" disabled></td>
 				</tr>

 				<tr><td>Date of Birth:</td>
 					<td><input type="Date" value="<?php echo $row['dob'] ?>"  disabled>
 					
 				
 				<tr><td>Roll No.:</td>
 					<td> <input type="number" name="rollno" value="<?php echo $row['rollno'] ?>" required=""></td> 
 				</tr> 
 				
 				<tr><td>Division:</td>
						<td><input style="text-transform: uppercase;" type="text" value="<?php echo 
						$row['division'] ?>" name="division" required=""></td>
				</tr>
 				
 				<tr><td>PRN No.:</td>
 					<td> <input type="text" style="background-color: #ebebe4 ;border:2px;" value="<?php echo $row['prn_no'] ?>" name="prn_no" readonly></td> 
 				</tr> 
 				
 				
 			</table>
 				
 				<br>
 				<input type="submit" style="font-size: 20px;" id="button" name="submit" 
 				value="Edit">
 				<input type="reset" style="font-size: 20px;" value="Cancel">
 				
 				
 				</tr> 
 				</form> 
 			<?php }
 		}?>
 			
 		</fieldset>
 	</div>


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