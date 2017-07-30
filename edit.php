<?php 
    session_start();
    $con= mysqli_connect("localhost","root","","march17");
    $email= $_SESSION['email'];

	$epr='';
   

	$cid="select customerno from customerreg where email='$email'";
    $customerno=mysqli_query($con,$cid);
	if($customerno){
            $row=mysqli_fetch_array($customerno);
            $idno=$row['customerno'];
        }
		
    if(isset($_POST['book'])){
        $pet=$_POST['pet'];
        $petid="Select petid from pet where petname='$pet'";
        
        $petiD=mysqli_query($con,$petid);
        
        
	
	$query ="select service_name,price,duration,date from service s, servicepackage spk,customerreg c ,customerorder cod
            where s.serviceid=spk.serviceid and
            spk.packageid=cod.packageid and
             c.customerno=cod.customerno and
            c.customerno='$idno'";
	$queryresult=mysqli_query($con,$query);
	if($queryresult){
		while($row=mysqli_fetch_array($queryresult)){
			
		}
	}
	
	}
    if(isset($_GET['epr']))
    $epr=$_GET['epr'];
    
	
	if(isset($_POST['update'])){
        $pet=$_POST['pet'];
        $petid="select petid from pet where petname='$pet'";
        $petiD=mysqli_query($con,$petid);
        if($petiD){
            $row=mysqli_fetch_array($petiD);
            $petidno=$row['petid'];
        }
       
        
        
        $packagecode=$_POST['packageid'];
        $date=$_POST['date'];
        $servicetime=$_POST['servicetime'];
        $id=$_GET['id'];
       $query="UPDATE customerorder set packageid='$packagecode', date='$date', servicetime='$servicetime',petid='$petidno' where orderid='$id'";
        $update=mysqli_query($con,$query);
        if($update){
            
        }else{
            echo mysqli_error($con);
                
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lucy's Pet</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
	<style type="text/css">
	th, td {
    padding: 15px;
    text-align: center;
	}
	
 table, td, th {    
	border: 1px solid #ddd;
	text-align: left;
	}

	table {
	border-collapse: collapse;
	width: 100%;
	}
	.setrequirements{
		width:100%;
        overflow: hidden
	}
	 td a{
		text-decoration:none;
		color:green
	}
	 td a:hover{
		color:black;
		text-decoration:underline
	}
	
	.right-option{
		float:right
	}
   .edit{
	width: 100%;
    margin-top: 20px
    }
    .edit .editform table{
        width: auto
    }
    .editform{
    width: 100%;
    margin-left: auto;
    margin-right: auto;
        }

	</style>
<!--
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
-->
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
</head>
<body>
    <div class="main">
       
        <div class="mainmenu">
          <div class="right-option">
                <?php
                
                if($_SESSION["email"]) {
                    $username="Select name from customerreg where email='$email'";
                    $result=mysqli_query($con,$username);
                    if($result){
                        $row=mysqli_fetch_array($result);
                        $name=$row['name'];
                        
                        } 
                    }
                        echo "Welcome <h2>$name</h2><a href='mainpage.html'>Logout</a>";
						
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
      <div class="setrequirements">
		
		<?php
		echo "<h1>Services you ordered</h1>";
		//$view="select * from customerorder where customerno='$idno'";
		$view="select orderid,service_name,price,duration,date,servicetime,petname from service s, servicepackage spk,customerreg c ,customerorder cod,pet p
            where s.serviceid=spk.serviceid and
            spk.packageid=cod.packageid and
			p.petid=cod.petid and
			
             c.customerno=cod.customerno and
            c.customerno='$idno'";
        $result=mysqli_query($con,$view);
        if($result->num_rows>0){
            echo "<table class='view'>
                <tr>
                    <th>Order No</th>
                    <th>Service name</th>
                    <th>Price</th>
                   
                    <th>Duration</th>
                    <th>Date</th>
                    <th>Service time</th>
                    <th>Pet name</th>
                    <th>Update</th>

                </tr>"
            ;
            
            while($row=mysqli_fetch_array($result)){
                echo "<tr bgcolor>
                   
                    <td>".$row['orderid']."</td>
                    <td>".$row['service_name']."</td>
                    <td>".$row['price']."</td>
                    <td>".$row['duration']."</td>
                    <td>".$row['date']."</td>
                    <td>".$row['servicetime']."</td>
                    <td>".$row['petname']."</td>
                    
                    <td align='center'><a href='edit.php?epr=update&id=".$row['orderid']."'>Modify</a></td>
                <tr>";
                
            }
            echo "</table>";
        }
        ?>
		
		
		<?php 
        if($epr=='update'){
        $id=$_GET['id'];
        $value="Select packageid,date,servicetime,petid from customerorder where orderid='$id'";
        $result=mysqli_query($con,$value);
		if($result){
			 $rows=mysqli_fetch_array($result,MYSQLI_ASSOC);
		}else {
			echo mysql_error($con);
		}
       
		
    ?>    
        <div class="edit">
        <form method="post" class="editform">    
       <table>
        <tr >
		<td>Package Code:</td>
            <td><input type="text" placeholder="Package code*" name="packageid"  style="width:200px"   value="<?php echo $rows['packageid'];?>"></td>
            <td>Date:</td>
            <td><input type="text" placeholder="Package code*" name="date"  style="width:200px"   value="<?php echo $rows['date'];?>"></td>
            <td>Service Time:</td>
            <td><input type="text" placeholder="Service Time*" name="servicetime"  style="width:200px"   value="<?php echo $rows['servicetime'];?>"></td>
        </tr>
        <tr>
            <td>Select pet</td>
            <td>
                  <select style="width:200px;" name="pet" >
                     <option>--Select Your Pet--</option>
                     <?php
                        $query="SELECT petname FROM customerpet cp, pet p,customerreg c where c.customerno=cp.customerno and p.petid=cp.petid and c.customerno='$idno'";
                        $result=mysqli_query($con,$query);
                        while($row=mysqli_fetch_array($result)){

                    ?>
                     <option value="<?php echo $row['petname'];?>"><?php echo $row['petname'];?></option>

                    <?php

                    } ?>
            </select>
            </td>
            
          
        </tr>
		</table>
        
        <table>
            <tr>
                <td><input type="submit" name="update" style="width:422px;height:50px;font-size:20px;font-weight:bold;cursor:pointer;", value="Modify order"></td>
            </tr>
        </table>
        
   </form>
          </div>  
     
     <?php }
			
            
    ?>
	
       
        
        
	</div>
	</div>
	</div>
</body>
</html>



