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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lucy's Pet</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
<!--
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
-->
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
        
        
        function time(){
           time=reneworder.ordertime.value;
           if(time==""){
               document.getElementById("error5").innerHTML="Select time!!";
               flag=1;
           }
       }
        
        function check(form)
        {
            flag=0;
            time();
            
            if(flag==1)
                return false;
            else
                return true;
        }
        
        
        
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
        .editorderform{
            width: 100%;
            overflow: hidden;
            margin-top: 20px
        }
         #ordereditform{
            width: 100%;   
        }
        #warning{
            color: red
        }
        #error5{
            color: red
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
        
<!--
        <div class="image">
            <img src="image/transparent-background-dog.png" alt="">
        </div>
-->
        <div class="requirements">
            <?php
            $query="select petnames,service_name,duration,serviceprice,orderdate,ordertime,orderday,s.serviceid from 
            customerorder cod,service s,customerreg creg where 
            s.serviceid=cod.serviceid and
            creg.customerno=cod.customerno 
            and creg.customerno='$idno' and orderdate<'$today'";
            $result=mysqli_query($con,$query);
            $rowcount=mysqli_num_rows($result);
            if($rowcount==0){
                echo "<h2 id='warning'>Previous order list is empty!!</h2>";
            }else {
            ?>
			    <table id="t01">
                    <h2>Your previous orders</h2>
                     <tr>
					     
                         <th>Pet name</th>
                         <th>Service name</th>
                         <th>Duration</th>
                         <th>Service cost</th>
                         <th>Date</th>
                         <th>Time</th>
                         <th>Day</th>
                         <th>Renew Order</th>
                     </tr>
                     <?php while($row=mysqli_fetch_array($result)){
                    ?>
                     <tr>
                         <td><?php echo $row['petnames'];?></td>
                         <td><?php echo $row['service_name'];?></td>
                         <td><?php 
                            if($row['duration']<15) {
                                echo $row['duration'].' Times';
                            }else{
                                echo $row['duration'].' Minutes';
                            }
                            ?></td>
                         <td><?php echo $row['serviceprice'];?></td>
                         <td><?php echo $row['orderdate'];?></td>
                         <td><?php echo $row['ordertime'];?></td>
                         <td><?php echo $row['orderday'];?></td>
                        <td bgcolor="green"><form action="" method="post">
                         <input type="hidden" value="<?php echo $row['orderno']?>" name='orderid'/>
                         <input type="hidden" value="<?php echo $row['service_name']?>" name='servicename'/>
                         <input type="hidden" value="<?php echo $row['serviceprice']?>" name='serviceprice'/>
                         <input type="hidden" value="<?php echo $row['serviceid']?>" name='serviceid'/>
                         
                         <input type="submit" name='renew' value='Renew Order'/>
                         </form></td>
                     </tr>
                     <?php }
            }
                    ?>
               </table>
        </div>
            <div class="editorderform">
                <?php
                if(isset($_POST['renew'])){
                    $orderno=$_POST['orderid'];
                    $sname=$_POST['servicename'];
                    $serviceprice=$_POST['serviceprice'];
                    $serviceid=$_POST['serviceid'];
                    
                    $service_name="Select service_name,ordertime from customerorder cod, service s where s.serviceid=cod.serviceid and orderno='$orderno'";
                    $result=mysqli_query($con,$service_name);
                    $row1=mysqli_fetch_array($result);
                    
                echo"<h2>Renew this order</h2>";
                    include("include/reneworder.php");
                }
                ?>
            </div>
  
        <div class="bottom">
           
        </div>
        </div>
    </div>
</body>
</html>


