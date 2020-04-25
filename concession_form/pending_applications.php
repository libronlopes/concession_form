<?php




$connect = new mysqli('localhost', 'root','', 'rail_concession');
    mysqli_select_db($connect,'rail_concession');

    
    $query=mysqli_query($connect,"SELECT *from con_data  ");
    $row1=mysqli_fetch_array($query);
    
        $query1 = "SELECT reg_data.*, con_data.* FROM reg_data INNER JOIN con_data ON reg_data.prn_no = con_data.prn_no WHERE con_data.status = 0 ORDER BY con_data.id ASC ";

        $result = mysqli_query($connect, $query1);

        
  


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pending Applications</title>
    
    <link rel="stylesheet" type="text/css" href="https:////cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"/>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <h1 align="center"  style="text-decoration:none;color:#2c0975;font-family: timesnewroman;font-weight: bold;">M.L.DAHANUKAR COLLEGE OF COMMERCE</a></h1>

   <h3 align="center">Pending Applications</h3>
   <a href="approved_applications.php">Approved Applications</a>
    <div>
        <table width="99%" id="usetTable" class="table" border="1px">
            <thead>
              <th width="3px">id</th>
                <th width="60px">PRN No.</th>
      <th width="17%">Name</th>
      <th width="5px">DoB</th>
      <th width="5px">Age</th>
      <th width="50px">App.Date</th>
                <th width="10px">Class</th>
                <th width="20px">Period</th>
                <th width="25%">Address</th>
                <th width="20px">Gender</th>
                <th width="30px">Station</th>
                <th width="30px">Action</th>
            </thead>
            <tbody>
                 <?php
              if(mysqli_num_rows($result) > 0)
              {
           ?>
                            <?php
                   while($row = mysqli_fetch_array($result))
                  {
                    //formatting dob as d-m-y.
                    $rev_dob=$row['dob'];
                    $new_dob = date("d-m-Y", strtotime($rev_dob));

                    $rev_rdate=$row['rdate'];
                    $new_rdate = date("d-m-Y", strtotime($rev_rdate));


                 ?><tr>
                    <form method="POST" action="update.php">
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row['prn_no']; ?></td>
                            <td><?php echo ucwords( $row['name']);?></td>
                            <td width="90px"><?php echo $new_dob; ?></td>
                            <td align="center"><?php echo $row['age']; ?></td>
                            <td><?php echo $new_rdate; ?></td>
                            <td align="center"><?php echo $row['rclass']; ?></td>
                            <td><?php echo $row['rperiod']; ?></td>
                            <td><?php echo $row['raddress']; ?></td>
                            <td align="center"><?php echo $row['gender']; ?></td>
                            <td><?php echo ucwords($row['rstation']); ?>
                            <input type="" name="id" value='<?php echo $row["id"]; ?>' hidden /></td>
                           <label><td><button type="submit">Approve</button></td></label>
                           </form>
                           </tr>
  
            <?php } ?>
     
      <?php } ?>    
            </tbody>
        </table>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
   
    <script>
        $(document).ready(function() {
            $('#usetTable').DataTable();
        } );
      </script>
 </body>
</html>



