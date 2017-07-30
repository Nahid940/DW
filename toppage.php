<?php 
session_start();
$con=mysqli_connect("localhost","root","","march17");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
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
            width: 50%;
            margin-right: 30%
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
        
        <div class="image">
            <img src="image/transparent-background-dog.png" alt="">
        </div>
        <div class="setrequirements">
          <div class="heading">
               <h2>Lucy’s Pets Service</h2>
            <h3>Extensive pet care</h3>
          </div>
           
               <table>
                 <tr>
                      <td>
                          <a href="addpet.php"><input type="submit" class="button" name='addpet' value="Add pet"></a>
                      </td>
                  </tr>
                  <tr>
                      <td>
                          <a href="servicebook.php"><input type="submit" class="button" name='bookservice' value="Book service"></a>
                      </td>
                  </tr>
               </table>
          
        </div>
  
        <div class="bottom">
           
        </div>
        </div>
  
        
    </div>
</body>
</html>

