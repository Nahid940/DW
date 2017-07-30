<?php
	$con=mysqli_connect("localhost","root","","march17");
	
	if(isset($_POST['reneworder'])){
		//$orderno=$_POST['orderno'];
        $petname=$_POST['pet'];
        $customerno=$_POST['customerno'];
        $duration=$_POST['duration'];
        $price=$_POST['serviceprice'];
        $date=$_POST['day'];
        $time=$_POST['ordertime'];
        $dayname=$_POST['dayname'];
        $packageid=$_POST['serviceid'];
        
		$query="insert into customerorder(petnames,customerno,duration,serviceprice,orderdate,ordertime,orderday,serviceid) values('$petname','$customerno','$duration','$price','$date','$time','$dayname','$packageid')";
		$result=mysqli_query($con,$query);
		if($result){
			header("location:orderlist.php");
            
		}else{
            echo mysqli_error($con);
        }
    }
if(isset($_POST['cancel'])){
    header("location:perviousorder.php");
}
?>