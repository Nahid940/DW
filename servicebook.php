<?php 
session_start();
date_default_timezone_set("Asia/Dhaka");
    $con= mysqli_connect("localhost","root","","march17");
    $email= $_SESSION['email'];
    $price;
	$year=date('Y',time());
    $month=date('m',time());


$id="select customerno from customerreg where email='$email'";
        $customerno=mysqli_query($con,$id);
       
        if($customerno){
            $row=mysqli_fetch_array($customerno);
            $idno=$row['customerno'];
        }
        
        $petid="Select petid from customerpet where customerno='$idno'";
      
        $petiD=mysqli_query($con,$petid);
       
         if($petiD){
            $row=mysqli_fetch_array($petiD);
            $petidno=$row['petid'];
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
           function time(){
           time=bookform.time.value;
           if(time==""){
               document.getElementById("error5").innerHTML="Select time!!";
               flag=1;
           }
       } 
	   function pet(){
           pet=bookform.pet.value;
           if(pet==""){
               document.getElementById("error7").innerHTML="Select your pet!!";
               flag=1;
           }
       }
        
        function check(form)
        {
            flag=0;
            time();
			pet();
            
            if(flag==1)
                return false;
            else
                return true;
        }
  </script>

<style>
    .right-option{
        float: right
    }
    .top,.bottom{
        width: 100%;
        background-color: #79B849;
        height: 30px
    }
     #error5,#error7{
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
        <div class="setrequirements">
            <?php
            $query="select petid from customerpet where customerno='$idno'";
            $result=mysqli_query($con,$query);
            $num=mysqli_num_rows($result);
            if($num>0){
                include("servicecheck.php");

            }else{
                echo "<h2>Sorry you have not added any pet in our archive!!</h2>";
                echo "<h2 id='warning'>Add a pet from here <a href='addpet.php'>Add pet</a></h2>";
            }
            
            ?>
        </div>
        
            <div class="form">
            
            <?php if(isset($_POST['services'])){
            $service=$_POST['service'];
            $_SESSION['serv']=$_POST['service'];
    
    
            if($service=="Pet Walking"){
                include("include/bookingform.php");
              
            }else if($service=="Play sessions"){
                include("include/bookform2.php");
            }else if($service=="Puppy socialisation"){
                include("include/bookform4.php");
            }
            else {
                include("include/bookform3.php");
            }
            
            }
            if(isset($_POST['orderbook'])){
                echo "<h2>Service is booked!</h3>";
            }
        
            ?>
            
            </div>
            
        <div class="bottom">
            
        </div>
        </div>

    </div>
</body>
</html>

                    
<?php
     if(isset($_POST['orderbook'])){
        
        $duration=$_POST['duration'];
        $day=$_POST['day'];
        
        $time=$_POST['time'];
        $pet=$_POST['pet'];
        $packageid=$_POST['packageid'];
        
        $servicename= $_SESSION['serv'];
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
        
        $days=$_POST['dayname'];
         for($i=0;$i<sizeof($days);$i++){
            $d=$days[$i];
            $exdate=date('Y-m-d', strtotime("$day +$i day"));
            $query="insert into customerorder(petnames,customerno,duration,serviceprice,orderdate,ordertime,orderday,serviceid) values('$pet','$idno','$duration','$price','$exdate','$time','$d','$packageid')";
             $result=mysqli_query($con,$query);
        if(!$result){
            echo mysqli_error($con);
        }
             
         }

    }
    
?>       



  
 

