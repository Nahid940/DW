<?php 
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

    <style>

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
            float: left;
            margin-left: 10%;
            
        }
        .paragraph{
            width: 50%;
            float: left;
            overflow: hidden
        }
        .paragraph table td,tr,th{
            border: solid 1px black;
            
        }
        .paragraph table{
            width: 100%;
            text-align: center;
            border-collapse: collapse;
            
        }
        .rightsp{
            float: right;
            width: 20%;
            height: 200px;
            
        }
        .rightsp button{
            width: 60%;
            height: 30px;
            background-color: darkseagreen;
            cursor: pointer;
            
        }
        .rightsp button a{
            text-decoration: none;
            color: black;
            font-size: 15px
        }
        
        .top,.bottom{
            height: 200px;
            width: 100%;
            background-color: #79B849;
            height: 30px;
            overflow: hidden
        }
        
    </style>
</head>
<body>
    <div class="main">
       
        <div class="mainmenu">
           <div class="right">
              
               <ul>
                <li><a class="active" href="index.html">Home</a></li>
                <li><a href="">Service packages</a></li>
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
          <div class="paragraph">
              <?php
                $query="Select * from service";
                $result=mysqli_query($con,$query);
               
              ?>
              <table>
                  <tr>
                      <th>Service Name</th>
                      <th>Duration</th>
                      <th>Price</th>
                      
                  </tr>
                   <?php while($row=mysqli_fetch_array($result)){
    
                    ?>
                     <tr>
						
                         <td><?php echo $row['service_name'];?></td>
                         <td><?php echo $row['serviceduration'];?></td>
                         <td>£ <?php echo $row['price'];?></td>
                     </tr>
                     <?php }?>
              </table>
          </div>

        <div class="rightsp">
            <h3>To get our service</h3>
            <a href="reg.html"><button>Sign up</button></a>
            <br/>
            Or
            <br/>
             <a href="login.html"><button>Log in</button></a>
        </div>
          
        </div>
       
       
  
        <div class="bottom">
           
        </div>
        </div>
  
    </div>
</body>
</html>

