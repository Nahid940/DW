<?php
if(isset($_POST['register'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$address=$_POST['address'];
	$postcode=$_POST['postcode'];
	$contact=$_POST['contact'];
	$password=$_POST['password'];
	$cpassword=$_POST['cpassword'];
	if($email!="" && $password!="" && $cpassword!=""){
	if($password==$cpassword){
		$con=mysqli_connect("localhost","root","","march17");
		$query="select email from customerreg where email='$email'";
		$result=mysqli_query($con,$query);
		$num=mysqli_num_rows($result);
		if($num==0){
			$query="insert into customerreg(name,email,address,postcode,contact,password,usertype) values('$name','$email','$address','$postcode','$contact','$password','user')";
			$result=mysqli_query($con,$query);
			if($result){
				header("location:login.html");
			}else{
                mysqli_error($con);
            }
		}
		else{
			echo "This email is using by another user, Go back to <a href='reg.html'>Registration</a> and give any other email";
		}
	}
	else{
		echo "Password doesn't match,Go back to <a href='reg.html'>Registration</a>";	
	}
	}
	else echo "No field can be emptied, Go back to <a href='reg.html'>Registration</a>";
    }
?>