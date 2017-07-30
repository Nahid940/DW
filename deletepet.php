<?php
	$con=mysqli_connect("localhost","root","","march17");
	if(isset($_POST['delete'])){
        $petname=$_POST['petname'];
        $customerno=$_POST['idno'];
        $deleteorder="Delete from customerorder where petnames='$petname' and customerno='$customerno'";
        mysqli_query($con,$deleteorder);
        
		$id=$_POST['petid'];
		$delete="delete from customerpet where petid='$id'";
		$deletequery=mysqli_query($con,$delete);
		if($deletequery){
			header("location:petdetails.php");
		}
		
	}
?>