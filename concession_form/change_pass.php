<!DOCTYPE html>
<html>
<head>
  <title>Change Password</title>
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



//userwise data fetch
	if ($_SESSION["prn_no"]==true) 
	{?>
		<div id="main">
		<h1 align="left" style="margin-top: 0;margin-bottom:.5rem;font-size: 2.5rem"><a  style="text-decoration:none;color:#2c0975;font-weight:lighter;font-family: timesnewroman" href="https://www.mldcc.com/">M.L.DAHANUKAR COLLEGE OF COMMERCE</a></h1> 
                <button style="text-align: left;font-style: italic;" class="openbtn" onclick="openNav()">☰ 
                <?php echo ucwords("Welcome"." ".$row['name']."!");?></button> </h1>
            </div>
  		<div align="center">
  				<fieldset style="width:30%">
 			
 			<legend>Change Password</legend> 
 			
 			<table border="0"> <tr> 
 				
 				<form method="POST" action="change_pass_db.php"> 
 				
 				<tr><td>Old Password:</td>
 					<td> <input type="password" id="opwd" name="oldpass" required=""></td>  
 				</tr> 
 				<tr><td>New Password:</td>
 					<td> <input type="password" id="npwd" name="newpass" required="" ></td> 
 				
 				<tr><td>Confirm New Password:</td>
 					<td> <input type="password" id="cnpwd" name="connewpass" required=""></td> 
 				</table>
 				
 				<input style="font-size: 20px;" id="button" type="submit" name="submit" value="Change">
 				
 				
 				</form> 
 		</fieldset>
 	</div> 

<?php
	}
		}?>


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

<script type="text/javascript">
 		var pwd = document.getElementById("npwd"), cpwd = document.getElementById("cnpwd");

function validatePassword()
{
  if(npwd.value != cnpwd.value) 
  {
    cnpwd.setCustomValidity("Passwords Don't Match");
  } 
  else 
  {
    cnpwd.setCustomValidity('');
  }
}

npwd.onchange = validatePassword;
cnpwd.onkeyup = validatePassword;
 	</script>
</body>
</html>
