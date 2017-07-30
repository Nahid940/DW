<?php 
session_start();
$con=mysqli_connect("localhost","root","","march17");
date_default_timezone_set("Asia/Dhaka");
$today=date('Y-m-d',time());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/style.css" type="text/css"/>
    <script>
        function validateform(form){
            fail=validatePackageCode(form.packageid.value)
            if(fail==""){
                return true;
            }else{
                alert(fail);
                return false;
            }
        }
        
        function validatePackageCode(field){
            if(field=="" || /[a-z]/.test(field) || /[A-Z]/.test(field)) return "Invalid or no package code entered!!\n";
            return ""
        }
        
         $( function() {
            $( "#datepicker" ).datepicker();
          } );
    </script>
    <style>
        body{
            width: 70%
        }
        .image{
            width: 20%;
            float: left;
            
        }
        .image image{
            height: 50px;  
        }
        .button{
            width: 150px;
            height: 40px;
            cursor: pointer;
            background-color: darkseagreen;
            padding: 10px
        }
        .button:hover{
            background-color: darkolivegreen;
            color: aliceblue
        }
        .heading{
            width: 25%;
            float: right;
            margin-right: 42%
        }
        h2{
            background-color: #ABCBE3
        }
        table{
            width: 100%;
            margin-right: 30%
        }
        table, th, td {
   border: 1px solid black;
            border-collapse: collapse
}
        .right-option{
            float: right
        }
        
        .top,.bottom{
            height: 200px;
            width: 100%;
            background-color: #79B849;
            height: 30px
        }
        
    </style>
</head>
<body>
    <div class="main">
       
        <div class="mainmenu">
           <div class="right-option">
                <?php
                $email=$_SESSION['email'];
                if($_SESSION["email"]) {
                    $username="Select name from customerreg where email='$email'";
                    $result=mysqli_query($con,$username);
                    if($result){
                        $row=mysqli_fetch_array($result);
                        $name=$row['name'];
                        
                        } 
                    }
                        echo "Welcome $name<a href='../index.html'> Logout</a>";
						
                    ?>
          </div>
           <div class="right">
              
               <ul>
                <li><a class="active" href="admin.php">Home</a></li>
                
            </ul>
           </div>
            
        </div>
        <div class="body">
        
        <div class="top">
            <h2>Hello Admin</h2>
        </div>
        
        <div class="ordertable">
              <h2>Recent Orders</h2>
              <table>
                 <tr>
                <th>Order No.</th>
                  <th>Pet name</th>
                  <th>Customer name</th>
                  <th>Duration</th>
                  <th>Cost</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Order day</th>
                  <th>Service name</th>
                 </tr>
                 <?php 
                  
                  $query="select orderno,petnames,Name,address,duration,serviceprice,orderdate,ordertime,orderday,service_name from service ser, customerorder cod, customerreg creg where ser.serviceid=cod.serviceid and creg.customerno=cod.customerno and orderdate>='$today'";
                  $result=mysqli_query($con,$query);
                  $numrows=mysqli_num_rows($result);
                  if($numrows==0){
                    echo "Order list is empty";
                  }else{
                while($row=mysqli_fetch_array($result)){
                  ?>
                  
                 <tr>
                     <td><?php echo $row['orderno']?></td>
                     <td><?php echo $row['petnames']?></td>
                     <td><?php echo $row['Name']?></td>
                     <td><?php echo $row['duration']?></td>
                     <td>£ <?php echo $row['serviceprice']?></td>
                     <td><?php echo $row['orderdate']?></td>
                     <td><?php echo $row['ordertime']?></td>
                     <td><?php echo $row['orderday']?></td>
                     <td><?php echo $row['service_name']?></td>
                 </tr>
                 <?php
                }
                  }
                  ?>
              </table>
              
              <h2>Previous Orders</h2>
              
               <table>
                 <tr>
                <th>Order No.</th>
                  <th>Pet name</th>
                  <th>Customer name</th>
                  <th>Duration</th>
                  <th>Cost</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Order day</th>
                  <th>Service name</th>
                 </tr>
                 <?php 
                  
                  $query="select orderno,petnames,Name,address,duration,serviceprice,orderdate,ordertime,orderday,service_name from service ser, customerorder cod, customerreg creg where ser.serviceid=cod.serviceid and creg.customerno=cod.customerno and orderdate<'$today'";
                  $result=mysqli_query($con,$query);
                  $numrows=mysqli_num_rows($result);
                  if($numrows==0){
                    echo "Order list is empty";
                  }else{
                while($row=mysqli_fetch_array($result)){
                  ?>
                  
                 <tr>
                     <td><?php echo $row['orderno']?></td>
                     <td><?php echo $row['petnames']?></td>
                     <td><?php echo $row['Name']?></td>
                     <td><?php echo $row['duration']?></td>
                     <td>£ <?php echo $row['serviceprice']?></td>
                     <td><?php echo $row['orderdate']?></td>
                     <td><?php echo $row['ordertime']?></td>
                     <td><?php echo $row['orderday']?></td>
                     <td><?php echo $row['service_name']?></td>
                 </tr>
                 <?php
                }
                  }
                  ?>
              </table>
              
              
              <h2>Cost of each customer for recent orders</h2>
              
            <?php
            $query="SELECT Name, SUM(serviceprice) as 'Total cost'FROM customerorder cod, customerreg creg where creg.customerno=cod.customerno and orderdate>='$today' group by cod.customerno";
            $result=mysqli_query($con,$query);
            ?>
              <table>
                 <tr>
                <th>Customer Name</th>
                <th>Total cost</th>
                 </tr>
                 <?php
                  while($row=mysqli_fetch_array($result)){
                  ?>
                 <tr>
                     <th><?php echo $row['Name']?></th>
                     <th>£ <?php echo $row['Total cost']?></th>
                 </tr>
                  <?php }?>
              </table>
              
              
              <h2>Cost of each customer for Previous orders</h2>
              
               <?php
            $query="SELECT Name, SUM(serviceprice) as 'Total cost'FROM customerorder cod, customerreg creg where creg.customerno=cod.customerno and orderdate<'$today' group by cod.customerno";
            $result=mysqli_query($con,$query);
            ?>
              <table>
                 <tr>
                <th>Customer Name</th>
                <th>Total cost</th>
                 </tr>
                 <?php
                  while($row=mysqli_fetch_array($result)){
                  ?>
                 <tr>
                     <th><?php echo $row['Name']?></th>
                     <th>£ <?php echo $row['Total cost']?></th>
                 </tr>
                  <?php }?>
              </table>
        </div>
  
        <div class="bottom">
           
        </div>
        </div>
  
        
    </div>
</body>
</html>

