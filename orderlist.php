<?php 
session_start();
$today=date('Y-m-d',time());
$year=date('Y',time());
$con=mysqli_connect("localhost","root","","march17");

$email=$_SESSION['email'];

 $id="select customerno from customerreg where email='$email'";
        $customerno=mysqli_query($con,$id);
        
        if($customerno){
            $row=mysqli_fetch_array($customerno);
            $idno=$row['customerno'];
        }



$lucypet="select postcode from lucyspet";
    $result=mysqli_query($con,$lucypet);
    if($result){
        $row=mysqli_fetch_array($result);
    }
 $shopaddress=$row['postcode'];

$customer="select postcode from customerreg where customerno='$idno'";
        $result=mysqli_query($con,$customer);
        if($result){
            $row=mysqli_fetch_array($result);
        }
   $customeraddress=$row['postcode'];
        
$customeraddress= urlencode($customeraddress);
$shopaddress = urlencode($shopaddress);

$data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$customeraddress&destinations=$shopaddress&language=en-EN&sensor=false");
$data = json_decode($data);

$distance = 0;

foreach($data->rows[0]->elements as $road) {
    $distance += $road->distance->value;
}
$totaldistance=$distance/1000;
	if(isset($_POST['update'])){
		$orderno=$_POST['orderno'];
		$petname=$_POST['pet'];
		$customerno=$_POST['customerno'];
		$duration=$_POST['duration'];
		$day=$_POST['day'];
		$time=$_POST['ordertime'];
        $servicename=$_POST['servicename'];
        
        if($servicename=="Pet Walking" && $duration>15){
            $price=$duration/15;
           $price*=1;
          
            if($totaldistance>10){
            $extra=$totaldistance-10;
             $price=$extra*.5+$price;
        }
           
        }else if($servicename=="Pet Walking" && $duration<=15) {
            $price=$duration/15;
            if($totaldistance>10){
            $extra=$totaldistance-10;
             $price=$extra*.5+$price;
            
        }
        }
            
        if($servicename=='Play sessions' && $duration>30){
            $price=($duration/30);
            $price*=3;
            if($totaldistance>10){
            $extra=$totaldistance-10;
            $price=$extra*.5+$price;
            
        }
            
        }else if($servicename=='Play sessions' && $duration<=30){
            $price=$duration/10;
             if($totaldistance>10){
            $extra=$totaldistance-10;
             $price=$extra*.5+$price;
            
        }
        }
         
         if($servicename=='Puppy socialisation'){
             $price=8;
            if($totaldistance>10){
            $extra=$totaldistance-10;
            $price=$extra*.5+$price;
        }
             
        }else if($servicename=='Feeding'){
           $price=$duration*3;
        }
		
		$update="Update customerorder set petnames='$petname', duration='$duration', serviceprice='$price',orderdate='$day', ordertime='$time' where orderno='$orderno'";
		$result=mysqli_query($con,$update);
		if($result){
			echo "<script>
                document.getElementById('editorder').innerHTML='Order updated!!';
            </script>";
            echo "<meta http-equiv='refresh' content='0'>";
		}
        
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lucy's Pet</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>

     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
  
        
  $(document).ready(function () {
    
    var dbDate = "";
    var date2 = new Date(dbDate);
    $("#datepicker").datepicker({ 
    dateFormat: 'yy-mm-dd',
     minDate:0
    }).datepicker('setDate', date2)


});
  
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
            width: 50%;
            float: right;
            margin-right: 25%
        }
        table{
            width: 100%;
            margin-right: 30%;
			border: 1px solid black;
			
        }
		#t01 th {
    background-color: #75AAD6;
    color:black;
	}
		th, td{
			
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
		.requirements{
			width:100%;
		}
    
         #ordereditform{
            width: 100%;   
        }
        #warning{
            color: red;
            
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
                        echo "Welcome $name<a href='index.html'> Logout</a>";
						
                    ?>
          </div>
           <div class="right">
              
               <ul>
                <li><a class="active" href="toppage.php">Home</a></li>
                <li><a href="petdetails.php">Your pets</a></li>
                <li><a href="orderlist.php">Recent orders</a></li>
                <li><a href="perviousorder.php">Previous orders</a></li>
                <li><a href="table.php">Service Calender</a></li>
                <li><a href="about.html">About</a></li>
            </ul>
           </div>
            
        </div>
        <div class="body">
        
        <div class="top">
            
        </div>
        
        <div class="requirements">
         <?php
            $query="select orderno,petnames,duration,service_name ,serviceprice,orderdate,ordertime,orderday from 
            customerorder cod,service s,customerreg creg where 
            s.serviceid=cod.serviceid and
            creg.customerno=cod.customerno 
            and creg.customerno='$idno' and orderdate>='$today'";
            
            $result=mysqli_query($con,$query);
           
            $rowcount=mysqli_num_rows($result);
            
            if($rowcount==0){
                echo "<h2 id='warning'>You have not booked any service!!</h2>";
                echo "<h2 id='warning'>Go to <a href='servicebook.php'>book service </a> to book service!</h2>";
                
            }else{
            
            ?>
          <div class="heading">
            <h2>Services you booked recently</h2>
          </div>
          
           <form action="" method="post" class="editform">
		  
               <table id="t01">
                     <tr>
                         <th>Pet name</th>
                         <th>Service name</th>
                         <th>Service cost</th>
                         <th>Duration</th>
                         <th>Date</th>
                         <th>Time</th>
                         <th>Day</th>
                         <th>Modify</th>
                         
                     </tr>
                     
                     <?php while($row=mysqli_fetch_array($result)){
    
                    ?>
                     <tr>
						
                         <td><?php echo $row['petnames'];?></td>
                         <td><?php echo $row['service_name'];?></td>
                         <td>£ <?php echo $row['serviceprice'];?></td>
                         <td><?php 
                            if($row['duration']<15) {
                                echo $row['duration'].' Times';
                            }else{
                                echo $row['duration'].' Minutes';
                            }
                            ?></td>
                         <td><?php echo $row['orderdate'];?></td>
                         <td><?php echo $row['ordertime'];?></td>
                         <td><?php echo $row['orderday'];?></td>
                         <td bgcolor="green"><form action="" method="post">
                         <input type="hidden" value="<?php echo $row['orderno']?>" name='orderid'/>
                         <input type="submit" name='idsubmit' value='Edit' onClick="window.location.reload()"/>
                         </form></td>
                     </tr>
                     <?php }
            }
                   ?>
               </table>
			    </form>

        </div>
        
        <div>
            <?php
            $query="SELECT Name, SUM(serviceprice) as 'Total cost'FROM customerorder cod,
  customerreg creg where creg.customerno=cod.customerno and orderdate>='$today' and
   cod.customerno='$idno'";
            $result=mysqli_query($con,$query);
            $numrows=mysqli_num_rows($result);
            
            ?>
            <h2>Total cost</h2>
              <table>
                 <tr>
                <th>Customer Name</th>
                <th>Total cost</th>
                <th>Distance</th>
                <th>Projected cost (1 month)</th>
                 </tr>
                 <?php
                  if($result){
                  while($row=mysqli_fetch_array($result)){
                  ?>
                 <tr>
                     <td><?php echo $row['Name']?></td>
                     <td> <?php  
                      if($row['Total cost']<=0){
                          echo "N/A";
                      }else{
                          echo '£ '. $row['Total cost'];
                      }
                         ?>
                     </td>
                     <td>
                         <?php
                            if($row['Total cost']<=0){
                                echo 'N/A';
                            }else{
                                echo $totaldistance;
                            }
                         ?>
                     </td>
                     
                     <td>
                         <?php
                            if($row['Total cost']<=0){
                                echo 'N/A';
                            }else{
                                echo '£ ' .($row['Total cost']*30);
                            }
                         ?>
                     </td>
                 </tr>
                  <?php }
                  }
                  ?>
              </table>

        </div>
        
        
        	    
        <div class="editorderform">
        <?php if(isset($_POST['idsubmit'])){
            
        $orderno=$_POST['orderid'];
        $service_name="Select service_name from customerorder cod, service s where s.serviceid=cod.serviceid and orderno='$orderno'";
		$result=mysqli_query($con,$service_name);
        $row1=mysqli_fetch_array($result);
    
        $dateandtime="select orderdate,ordertime from customerorder where orderno='$orderno'";
        $result=mysqli_query($con, $dateandtime);
		
        $row2=mysqli_fetch_array($result);
        
            echo"<h2>Update your service order</h2>";
            include ("include/editorder.php");
        }
    
        ?>
        </div>
        <div><h2 id="editorder"></h2></div>
  
        <div class="bottom">
           
        </div>
        </div>
    </div>
</body>
</html>

   


