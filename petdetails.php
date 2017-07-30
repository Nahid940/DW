<?php 
session_start();
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
        
        
        
               function day(){
           day=editpet.day.value;
           if(day==""){
               document.getElementById("error3").innerHTML="Select Day!!";
               flag=1;
           }
       }
        function month(){
           month=editpet.month.value;
           if(month==""){
               document.getElementById("error4").innerHTML="Select month!!";
               flag=1;
           }
       } function year(){
           year=editpet.year.value;
           if(year==""){
               document.getElementById("error5").innerHTML="Select year!!";
               flag=1;
           }
       }
        
            function check(form)
        {
            flag=0;
            day();
            month();
            year();
            
            
            
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
            width: 25%;
            float: right;
            margin-right: 42%
        }
        table{
            width: 100%;
            margin-right: 30%;
			border: 1px solid black;
			
        }
		table#t01 th {
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
        #warning{
            text-align: center;
            color: red
        }
          #error2,#error3,#error4,#error5,#error6,#error7{
            color: red
        }
        .canceledit{
            width: 24%;
            float: right;
            border: none;
            background-color: red;
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

			$query="Select * from customerpet where customerno='$idno'";
            $result=mysqli_query($con,$query);
           
            $rowcount=mysqli_num_rows($result);
            
            if($rowcount==0){
                echo "<h2 id='warning'>Your pet list is empty</h2>";
                echo "<h2 id='warning'>Go to <a href='addpet.php'>Add pet</a> to add your pet details in our archive!</h2>";
               
            }else{
            
            
            ?>
           <form action="" method="post" class="editform">
               <table id="t01">
                   <h2>Your Pet list</h2>
                     <tr>
					 
                         <th>Pet name</th>
                         <th>Group name</th>
                         <th>Special requirement</th>
                         <th>Date of Birth</th>
                         <th>Weight</th>
                         <th>Favourite food</th>
                         <th>Edit</th>
                         <th>Delete</th>
                         
                     </tr>
                     <?php while($row=mysqli_fetch_array($result)){
    
                    ?>
                     <tr>
						
                         <td><?php echo $row['petname'];?></td>
                         <td><?php echo $row['groups'];?></td>
                         <td><?php
                                if($row['specialrequirement']==""){
                                    echo "None";

                                }else{
                                    echo $row['specialrequirement'];
                                }
                             ?></td>
                         <td><?php echo $row['dob'];?></td>
                         <td><?php echo $row['weight'];?> Kg</td>
                         <td><?php
                         
                         if($row['favouritefood']==""){
                                    echo "None";

                                }else{
                                    echo $row['favouritefood'];
                                }
                ?>
                         
                         </td>
                         <td>
                          
                           <form action="" method='post'>
                            <input type="hidden" value="<?php echo $row['petid']?>" name='petid'/>
                             <input type="submit" value='Edit' name='edit'/>
                           </form>
                           
                         </td>
                         <td>
                           <form action="deletepet.php" method='post'>
                            <input type="hidden" value="<?php echo $row['petid']?>" name='petid'/>
                            <input type="hidden" value="<?php echo $idno?>" name='idno'/>
                            <input type="hidden" value="<?php echo $row['petname']?>" name='petname'/>
                             <input type="submit" value='Delete' name='delete'/>
                           </form>
                            
                         </td>
                       
                     </tr>
                     <?php }
            }
                   ?>
               </table>
			 </form>

        </div>
        <div class="editorderform">
        <?php if(isset($_POST['edit'])){
            $petid=$_POST['petid'];
            $query="select petname,groups,weight from customerpet where petid='$petid'";
            $result=mysqli_query($con,$query);
            if($result){
                $row=mysqli_fetch_array($result);
            }
            echo "<h2>Edit your pet details</h2>";
            include ("include/editpet.php");
        }
    
        ?>
        </div>
  
        <div class="bottom">
           
        </div>
        </div>
    </div>
</body>
</html>


