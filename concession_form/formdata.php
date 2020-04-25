<?php
	session_start();

	$con=mysqli_connect("localhost","root","",'rail_concession');
	
	if(!$con)
	{
		echo "Not connected to Server";
	}
	else if(!mysqli_select_db($con,'rail_concession'))
	{
		echo "Database not selected";
	}

	mysqli_select_db($con,'rail_concession');

//fetching values from database reg_data and con_data
	$Prn_no=$_SESSION['prn_no'];
	$query=mysqli_query($con,"SELECT *from reg_data where prn_no='$Prn_no' ");
	$row1=mysqli_fetch_array($query);
	$query1=mysqli_query($con,"SELECT reg_data.*, con_data.* FROM reg_data INNER JOIN con_data ON reg_data.prn_no = con_data.prn_no WHERE reg_data.prn_no = '$Prn_no';");
	$row=mysqli_fetch_array($query1);
	$query2=mysqli_query($con,"SELECT * from con_data WHERE prn_no='$Prn_no' ORDER BY rdate DESC ");
//to select the latest application date of the user.
	$row2=mysqli_fetch_array($query2);
	$num=mysqli_num_rows($query2);
	//echo($num);
	//echo "\n\t";
	//echo($row2[0]);
	
	
//initializing database variables and names
	
	$Gender=$_POST['gender'];
	$Rclass=$_POST['rclass'];
	$Rperiod=$_POST['rperiod'];
	$Expdate=$_POST['expdate'];
	$Raddress=$_POST['raddress'];
	$Rstation=$_POST['rstation'];
	$Age=$_POST['age'];
	$Rdate=$_POST['rdate'];

//latest application date.
	$getdate=$row2['rdate'];

//reversing date formats.
	$rev_rdate=date('Y-m-d',strtotime($Rdate));

	$rev_prevdate=date('d-m-Y',strtotime($getdate));


//incrementing date by 88/28 days to restrict user from applying for duplicate application.

	if ($num=='0') 
	{	
		validate_date();
	}
	else
	{
		if ($row2['rperiod']=='Quarterly') 
		{
			$inc=date('Y-m-d', strtotime($getdate. ' + 88 days'));
			validate_date();
		}
		elseif ($row2['rperiod']=='Monthly') 
		{
			$inc=date('Y-m-d', strtotime($getdate. ' + 28 days'));
			validate_date();
		}
	}

	
	function validate_date()
	{
		global $row2,$Prn_no,$inc,$rev_rdate,$row1,$rev_prevdate;

	//Reversing date of last application.	
		$applyon=date('d-m-Y',strtotime($inc));
		
	//if condition to check if username already exists in table con_data	
 		if ($row2['prn_no']==$Prn_no) 
 		{
 		
		//if condition to check if user has already applied for application in past 88/28 days
			if($inc <= $rev_rdate) 
			{
				
			//if the condition is false user is allowed to apply for new application.
				if($_SESSION["prn_no"]==true) 
				{
					insertdata();
				}
		 		
		 		else
				{
					//if username is wrong user will be redirected to login page.
					header('location:2;login.php');
				}
			}
		
				
			//if user has already applied in past 88/28 days then user will get a message.
			elseif($inc >= $rev_rdate) 
			{
 				?>
				
				<h1 align="left"><a style="text-decoration:none;color:#2c0975;font-weight:lighter;font-family: timesnewroman" href="concession_history.php">M.L.DAHANUKAR COLLEGE OF COMMERCE</a></h1> 
				
				<h3>You Have Already Applied On <?php echo($rev_prevdate); ?>.Please try again on or after <?php echo($applyon); ?>.</h3>

				<p>You will be redirected to Home Page in <span id="counter">10</span> second(s).</p>
				
				<?php
			}
		}
	
	//if username is not present in table con_data then new row will be created of that  user.
		else
		{
			insertdata();
		}
	}
	

//function to insert form data into database
	function insertdata()
	{
		global $Gender,$Prn_no,$Rclass,$Rperiod,$Expdate,$Raddress,$Rstation,$Age,$rev_rdate,$sql;
		$sql="INSERT INTO con_data(gender,prn_no,rclass,rperiod,expdate,raddress,rstation,age,rdate)  VALUES('$Gender','$Prn_no','$Rclass','$Rperiod','$Expdate','$Raddress','$Rstation','$Age','$rev_rdate');";
		chk_sql_query();
	}
	
	
//function to verify sql query
	function chk_sql_query()
	{
		global $con,$sql;
		if(!mysqli_query($con,$sql))
		{
			echo "Please Do Not Use Quotation marks.";
			//header("refresh:3;register.html");
		
		}
		else
		{
			$id1=mysqli_insert_id($con);?>
			
			<h1 align="left"><a style="text-decoration:none;color:#2c0975;font-weight:lighter;font-family: timesnewroman" href="concession_history.php">M.L.DAHANUKAR COLLEGE OF COMMERCE</a></h1> 
				
				<h2 style="font-weight: lighter;">Application Submitted Succesfully. Check <a href="concession_history.php"> home</a> page for the status of your application.
				<br><br><b style="color: red;font-size: 30px">Note:</b><u><i>Application must be submitted to the railway office within 3days from the date of issue. </u></i></h2>

		<?php		
		}
	}		
?>

<!-- js code to display countdown seconds during redirection -->
<script type="text/javascript">

function countdown() 
{
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=0) 
    {
        location.href = 'concession_history.php';
    }
if (parseInt(i.innerHTML)!=0) 
{
    i.innerHTML = parseInt(i.innerHTML)-1;
}
}
setInterval(function(){ countdown(); },1000);
</script>