<?php
session_start();
$con=mysqli_connect("localhost","root","","march17");
$email= $_SESSION['email'];
$id="select customerno from customerreg where email='$email'";
        $customerno=mysqli_query($con,$id);
        if($customerno){
            $row=mysqli_fetch_array($customerno);
            $idno=$row['customerno'];
        }
        if(isset($_POST['updatepet'])){
        $petname=$_POST['petname'];
        $group=$_POST['group'];
        $day=$_POST['day'];
        $month=$_POST['month'];
        $year=$_POST['year'];

        $dob=$year."-".$month."-".$day;
        $weight=$_POST['weight'];
        $petid=$_POST['petid'];

        $update="update customerpet set petname='$petname',groups='$group',dob='$dob',weight='$weight'
        where petid='$petid'";
        $result=mysqli_query($con,$update);
        if($result){
            header("location:petdetails.php");
        }
        }if(isset($_POST['cancel'])){
            header("location:petdetails.php");
        }
?>