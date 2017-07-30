<?php
	$con=mysqli_connect("localhost","root","");
	$query="drop database if exists march17";
	if(mysqli_query($con,$query)){
		echo "Database Dropped </br>";
	} 
	
	$query="create database march17";
	mysqli_query($con,$query);
	$con=mysqli_connect("localhost","root","","march17");
	
$table1="CREATE TABLE customerreg (
      customerno int(5) NOT NULL AUTO_INCREMENT,
      name varchar(25) NOT NULL,
      email varchar(25) NOT NULL,
      address varchar(150) NOT NULL,
      postcode varchar(20) NOT NULL,
      contact varchar(15) NOT NULL,
      password varchar(50) NOT NULL,
      usertype varchar(10) NOT NULL,
      PRIMARY KEY (customerno))";
    if(mysqli_query($con,$table1)) echo "customerreg Table Created </br>";
    else echo mysqli_error($con);
	
	
	$table2="CREATE TABLE service (
  serviceid int(5) NOT NULL AUTO_INCREMENT,
  service_name varchar(25) NOT NULL,
  serviceduration varchar(20) NOT NULL,
  price float(10) NOT NULL,
  PRIMARY KEY (serviceid))";
  
  if(mysqli_query($con,$table2)) echo "service Table Created </br>";
	else echo mysqli_error($con);
	
$query="CREATE TABLE customerpet (
  petid int(5) NOT NULL AUTO_INCREMENT,
  customerno int(10) NOT NULL,
  petname varchar(20) NOT NULL,
  groups varchar(50) NOT NULL,
  specialrequirement varchar(100) NOT NULL,
  dob varchar(50) NOT NULL,
  weight varchar(20) NOT NULL,
  favouritefood varchar(20) NOT NULL,
  PRIMARY KEY (petid),
  FOREIGN KEY (customerno) REFERENCES customerreg (customerno) ON DELETE CASCADE ON UPDATE CASCADE)";


   if(mysqli_query($con,$query)) echo " customerpet Table Created </br>";
	else echo mysqli_error($con);



$query="CREATE TABLE customerorder (
  orderno int(5) NOT NULL AUTO_INCREMENT,
  petnames varchar(20) NOT NULL,
  customerno int(10) NOT NULL,
  duration varchar(20) NOT NULL,
  serviceprice float(5,2) DEFAULT NULL,
  orderdate varchar(20) NOT NULL,
  ordertime varchar(20) NOT NULL,
  orderday varchar(20) NOT NULL,
  serviceid int(5) NOT NULL,
  PRIMARY KEY (orderno),
FOREIGN KEY (customerno) REFERENCES customerreg (customerno)  ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (serviceid) REFERENCES service (serviceid)  ON DELETE CASCADE ON UPDATE CASCADE)";

 if(mysqli_query($con,$query)) echo " Customerorder Table Created </br>";
	else echo mysqli_error($con);

$query="CREATE TABLE lucyspet (
shopno int(5) NOT NULL,
address varchar(100) NOT NULL,
postcode varchar(15) NOT NULL)";


 if(mysqli_query($con,$query)) echo " Lucyspet Table Created </br>";
	else echo mysqli_error($con);

$query="INSERT INTO lucyspet values(1,'40 A4, London WC2N, UK','WC1A 1BL')";
mysqli_query($con,$query);


$query="INSERT INTO service values(1,'Pet Walking','15 minute',1),
(2,'Feeding','N/A',3),
(3,'Puppy socialisation','2 hours',8),
(4,'Play sessions','30 minutes',3)
";
mysqli_query($con,$query);
?>