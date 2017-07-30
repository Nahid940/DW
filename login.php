<?php
session_start();
	$email=$_POST['emailvalue'];
	$password=$_POST['password'];
	$con=mysqli_connect("localhost","root","","march17");
	$query="select * from customerreg where email='$email'";
	$result=mysqli_query($con,$query);
	$num=mysqli_num_rows($result);
	if($num==0){echo "No user with this email found,Try to <a href='login.html'>Login</a> again";
	}
	else{
		$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
		$dbpassword=$row['password'];
		$usertype=$row['usertype'];
		if($password==$dbpassword && $usertype=='user'){
			$_SESSION['email']=$email;
			$_SESSION['login']=TRUE;
			header('location:toppage.php');
		}else if($password==$dbpassword && $usertype=='admin'){
            $_SESSION['email']=$email;
			$_SESSION['login']=TRUE;
            header('location:admin/admin.php');
        } else{
			echo "Password or use type doesn't match, Try to <a href='login.html'>Login</a> again";
		}
	}
?>

