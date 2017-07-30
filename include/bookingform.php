<h2>Select requirements for <b>pet walking</b> service</h2>
               <form action="" method="post" onSubmit="return check(this)" name='bookform' class='bookform'>
			   
                <table>
              
                   <tr>
				   
                       <td>
					   
                           <label for="">Select your pet : </label>
                       </td>
                       <td>
					   <div id="error7"></div>
                <select style="width:200px;" name="pet" >
                     <option value="">--Select Your Pet--</option>
                     <?php
                        $query="SELECT petname FROM customerpet where customerno='$idno'";
                        $result=mysqli_query($con,$query);
                        while($row=mysqli_fetch_array($result)){

                    ?>
                     <option value="<?php echo $row['petname'];?>"><?php echo $row['petname'];?></option>
                        
                    <?php
                       
                    } ?>
                </select>
                       </td>
					   <td>Select service duration: </td>
					   <td>
					    <select name="duration" id="">
						<option value="15">15 minutes</option>
						<option value="30">30 minutes</option>
						<option value="45">45 minutes</option>
						<option value="60">1 hour</option>
						<option value="75">1.15 hours</option>
						<option value="90">1.30 hours</option>
						<option value="105">1.45 hours</option>
						<option value="120">2 hours</option>
					   </select>
					   </td>
					   
					   

					<td>
					<?php
						$sid="Select serviceid from service where service_name='Pet Walking'";
						$result=mysqli_query($con,$sid);
						if($result){
							$row=mysqli_fetch_array($result);
						}
					?>
					<input type="hidden" value="<?php echo $row['serviceid'];?>" name='packageid'/>
						
					</td>
                   </tr>
                    
                    <tr>
				   <td><label for="">Select Date</label> </td>
				   <td>

        <input id="datepicker" name='day'>
			</td>	
		
                       <td><label for="">Select Time</label> </td>
                       <td>
                       <div id="error5"></div>
                       <input type="text" name="time"/></td>
                    
                    </tr>
                    
                    
              <tr>
			  
             <td>Select Day</td>
			
			<td><input type="checkbox" name="dayname[]" value="saturday" />Saturday</td> 
			<td><input type="checkbox" name="dayname[]" value="sunday" />Sunday</td> 
			 <td> <input type="checkbox" name="dayname[]" value="monday" />Monday</td> 
			 <td> <input type="checkbox" name="dayname[]" value="tuesday" />Tuesday</td> 
			<td>  <input type="checkbox" name="dayname[]" value="wednesday" />Wednesday</td> 
			 <td> <input type="checkbox" name="dayname[]" value="thursday" />Thursday</td> 		
			</tr>
                    
                    
                </table>
                        <input type="submit" name="orderbook" value="Book service" class='book' id="book1">
            </form>