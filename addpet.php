<?php 
session_start();
$email=$_SESSION['email'];
$con=mysqli_connect("localhost","root","","march17");
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
   <script language="javascript">
        var flag=0;
          
        function petname()
        {
            petname=petform.petname.value;
            if(petname=="")
            {
                document.getElementById("error0").innerHTML="Enter your pet name!!";   
                flag=1;
            }
        }
       function weight(){
           weight=petform.weight.value;
           if(weight==""){
               document.getElementById("error1").innerHTML="Enter your pet weight!!";
               flag=1;
           }
       }  
       function group(){
           group=petform.group.value;
           if(group==""){
               document.getElementById("error2").innerHTML="Select breading group name!!";
               flag=1;
           }
       } 
       function day(){
           day=petform.day.value;
           if(day==""){
               document.getElementById("error3").innerHTML="Select Day!!";
               flag=1;
           }
       }
        function month(){
           month=petform.month.value;
           if(month==""){
               document.getElementById("error4").innerHTML="Select month!!";
               flag=1;
           }
       } function year(){
           year=petform.year.value;
           if(year==""){
               document.getElementById("error5").innerHTML="Select year!!";
               flag=1;
           }
       }
       
         
       
       
            function check(form)
        {
            flag=0;
            petname();
            weight();
            group();
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
            width: 90%
        }
        .image{
            width: 20%;
            float: left;
            
        }
        .image image{
            height: 100px;  
        }
        button{
            width: 150px;
            height: 40px;
            cursor: pointer;
            background-color: darkseagreen;
            padding: 10px
        }
        button:hover{
            background-color: darkolivegreen;
            color: aliceblue
        }
        .heading{
            width: 25%;
            float: right;
            margin-right: 42%
        }
        
        .right-option{
            float: right
        }
        .form{
            width: 80%;
            overflow: hidden
        }
        .form table{
            width: 100%
        }
        .form .button{
            margin: auto;
            width: 20%;
			float:right;
			height:40px;
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: bold;
            background-color: #79B849;
            cursor: pointer
            
        }
        .button:hover{
            background-color: floralwhite
        }
        
        .top,.bottom{
            height: 30px;
            width: 100%;
            background-color: #79B849
        }
        
         #error2,#error3,#error4,#error5,#error6,#error7{
            color: red
        }
        
    </style>
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
               <h2>Add your pet details in our archive</h2>
            
          </div>
         
           
            
            
        </div>
        <div class="form">
              <form action="" method="post" name="petform" onSubmit="return check(this)">
               <table>
                  <tr>
                      <td>
                      <label for="">Pet Name *</label>
                      </td>
                          
                      <td>
                      <div id="error0"></div>
                      <input type="text" name="petname"></td>
                  </tr>
                  <tr></tr>
                  <tr></tr>
                  <tr></tr>
                  <tr>
                      <td><label for="">Breeding group *</label></td>
                      <td>
                         <div id="error2"></div>
                          <select name="group" id="">
                             <option value="">Breading group</option>
                              <option value="Affenpincher">Affenpincher</option>
                              <option value="Afghan hound">Afghan hound</option>
                              <option value="American eskimo">American eskimo</option>
                              <option value="American hairless terrier">American hairless terrier</option>
                              <option value="American-leopard-hound">American-leopard-hound</option>
                              <option value="Anatolian-shepherd">Anatolian-shepherd</option>
                              <option value="Appenzeller-sennenhunde">Appenzeller-sennenhunde</option>
                              <option value="Australian-cattle">Australian-cattle</option>
                              <option value="australian-terrier">Australian-terrier</option>
                          </select>
                      </td>
                      <td><label for="">Special requirement</label></td>
                      <td><input type="text" name="specialrequirement"></td>
                  </tr>
                  <tr></tr>
                  <tr></tr>
                  <tr></tr>
                  <tr>
                      <td>
                          <label for="">Pet BOD *</label>
                      </td>
                      <td>
                      <div id="error3"></div>
				<select name="day" id="">
				
					<option value="">Day</option>
					<option value="01">1</option>
					<option value="02">2</option>
					<option value="03">3</option>
					<option value="04">4</option>
					<option value="05">5</option>
					<option value="06">6</option>
					<option value="07">7</option>
					<option value="08">8</option>
					<option value="09">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
					
				</select>
			</td>
			<td>
			<div id="error4"></div>
				<select name="month" id="">
					<option value="">Month</option>
					<option value="01">January</option>
					<option value="02">February</option>
					<option value="03">March</option>
					<option value="04">April</option>
					<option value="05">May</option>
					<option value="06">June</option>
					<option value="07">July</option>
					<option value="08">August</option>
					<option value="09">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>
			</td>
            <td>
				<div id="error5"></div>
				<select name="year" id="">
				<option value="">Year</option>
					<option value="2000">2000</option>
					<option value="2001">2001</option>
					<option value="2002">2002</option>
					<option value="2003">2003</option>
					<option value="2004">2004</option>
					<option value="2005">2005</option>
					<option value="2006">2006</option>
					<option value="2007">2007</option>
					<option value="2008">2008</option>
					<option value="2009">2009</option>
					<option value="2010">2010</option>
					<option value="2011">2011</option>
					<option value="2012">2012</option>
					<option value="2013">2013</option>
					<option value="2014">2014</option>
					<option value="2015">2015</option>
					<option value="2016">2016</option>
				</select>
			</td>
                      
                  </tr>
                  <tr></tr>
                  <tr></tr>
                  <tr></tr>
                  
                   <tr>
                      <td><label for="">Weight *</label></td>
                      <td>
                      <div id="error1"></div>
                      <input type="text" name="weight"></td>
                      <td>Favourite food</td>
                      <td><input type="text" name="favouritefood" id="favouritefood"></td>
                  </tr>
                  
               </table>
               <input type="submit" name="addpet" class='button'>
            </form>

        </div>
        <div>
            <h2 id='confirm' style="color:green"></h2>
        </div>
        <div class="bottom">
            
        </div>
        </div>
  
    </div>
</body>
</html>


<?php
    if(isset($_POST['addpet'])){
        $petname=$_POST['petname'];
        $group=$_POST['group'];
        $specialrequirement=$_POST['specialrequirement'];
		$day=$_POST['day'];
		$month=$_POST['month'];
		$year=$_POST['year'];
		
		$dob=$year."-".$month."-".$day;
        $weight=$_POST['weight'];
        $favouritefood=$_POST['favouritefood'];
        $query="insert into customerpet (customerno,petname,groups,specialrequirement,dob,weight,favouritefood) values('$idno','$petname','$group','$specialrequirement','$dob','$weight','$favouritefood')";
        $result=mysqli_query($con,$query);
        if(!$result){
            echo mysqli_error($con);
        }else {
            echo "<script>
                 document.getElementById('confirm').innerHTML='Pet details added!!';
                </script> ";
        }
    }
?>
 
