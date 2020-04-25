<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="navbar.css">
</head>
<body>

<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="concession_history.php"><i class="fa fa-fw fa-home">Home</i></a> 
  <a href="concessionform.php"><i class="fa fa-file-o">Apply</i></a>
  <a href="edit_profile.php" ><i class="fa fa-edit">Edit Profile</i></a>
  <a href="change_pass.php"><i class="fa fa-lock">Change Password</i></a>
  <a href="logout.php"style="color: red;"><i class="fa fa-fw fa-sign-out">Logout</i></a>
</div>
<?php
    if(!isset($_SESSION)) 
        { 
            session_start();
            $con = new mysqli('localhost', 'root','','rail_concession'); 
            $Prn_no=$_SESSION['prn_no'];
            $query1=mysqli_query($con,"SELECT * FROM reg_data WHERE prn_no='$Prn_no' ");
            $row=mysqli_fetch_array($query1);
?>
            
<?php     
        } 
        
    $con = new mysqli('localhost', 'root','','rail_concession');
    mysqli_select_db($con,'rail_concession');
    
    $Prn_no=$_SESSION['prn_no'];
    $query1=mysqli_query($con,"SELECT * FROM reg_data WHERE prn_no='$Prn_no' ");
    $row=mysqli_fetch_array($query1);
    
    if ($_SESSION["prn_no"]==true) 
    {?>
        <div id="main">
        
            <h1 align="left"><a  style="text-decoration:none;color:#2c0975;font-weight:lighter;font-family: timesnewroman" href="https://www.mldcc.com/">M.L.DAHANUKAR COLLEGE OF COMMERCE</a></h1> 
                <button style="text-align: left;font-style: italic;" class="openbtn" onclick="openNav()">☰ 
                <?php echo ucwords("Welcome"." ".$row['name']."!");?></button> </h1>
            
        
        <?php $sql = "SELECT reg_data.*, con_data.* FROM reg_data INNER JOIN con_data ON reg_data.prn_no = con_data.prn_no WHERE reg_data.prn_no = '$Prn_no';";

        $result = $con->query($sql);

        $arr_users = [];
    
            if ($result->num_rows > 0) 
            {
                $arr_users = $result->fetch_all(MYSQLI_ASSOC);
            } 
            else
            {
                echo $con->error;
            }
    }
 


  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <link rel="stylesheet" type="text/css" href="https:////cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"/>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <table id="usetTable" class="table">
            <thead align="center">
                <th>Application Date</th>
                <th>Class</th>
                <th>Period</th>
                <th>Old Pass Exp.</th>
                <th>Station</th>
                <th>Issued On</th>
                <th>Status</th>
            </thead>
            <tbody>
                <?php if(!empty($arr_users)) 
                        { ?>
                            <?php foreach($arr_users as $user) 
                                    { 
//formatting dates as dd-mm-yyyy.
$rev_expdate=$user['expdate'];
$new_expdate = date("d-m-Y", strtotime($rev_expdate));

    $rev_rdate=$user['rdate'];
    $new_rdate = date("d-m-Y", strtotime($rev_rdate));

$rev_issued=$user['issued_on'];
$new_issued=date("d-m-Y", strtotime($rev_issued));



?>
                                
                                <tr align="center">
                                    <td><?php echo $new_rdate; ?></td>
                                    <td><?php echo $user['rclass']; ?></td>
                                    <td><?php echo $user['rperiod']; ?></td>
                                    <td><?php echo $new_expdate; ?></td>
                                    <td><?php echo $user['rstation']; ?></td>
                                    <td><?php if($user['status']==0)
                                                {
                                                    echo "";
                                                } 
                                                else
                                                {
                                                    echo $new_issued; 
                                                }?></td>
                                    <td style="color: lightgreen;"><?php if ($user['status']==1)
                                            {
                                                echo "Ready";
                                            } 
                                            else
                                            {?>
                                               <b style="color: red"><?php echo "Pending";
                                            }?>
                                    </td>
                                </tr>
                            <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
   
    <script>
        $(document).ready(function() 
        {
            $('#usetTable').DataTable();
        } );
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