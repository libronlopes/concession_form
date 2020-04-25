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
	$Stream=$_POST['stream'];
	$Class=$_POST['class'];
	$Name=$_POST['name'];
	$RollNo=$_POST['rollno'];
	$Division=$_POST['division'];
	$Prn_no=$_POST['prn_no'];
	$Pass=$_POST['password'];
	$Dob=$_POST['dob'];
	$hashed_password = md5($Pass);

//storing data in database from registration form.
	$sql="INSERT INTO reg_data(stream, class, name, rollno, division, prn_no, password, dob) VALUES('$Stream', '$Class', '$Name', '$RollNo', '$Division', '$Prn_no', '$hashed_password','$Dob');";
	
//if condition to check if user already exists.	
	if(!mysqli_query($con,$sql))
	{?>
		<p>Prn No. Already Exists<br>
			Redirecting to Login Page in <span id="counter">3</span> second(s).</p>
				
	<?php }
	else
	{?>
		<p>Registered Successfully.<br>
			Redirecting to Login Page in <span id="counter">3</span> second(s).</p>
				
	<?php }
	
?>

<!-- js code to display countdown seconds during redirection -->
<script type="text/javascript">

function countdown() 
{
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=0) 
    {
        location.href = 'login.php';
    }
if (parseInt(i.innerHTML)!=0) 
{
    i.innerHTML = parseInt(i.innerHTML)-1;
}
}
setInterval(function(){ countdown(); },1000);
</script>