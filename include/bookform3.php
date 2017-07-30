<h2>Select requirements for <b>feeding</b> service</h2>
           <form action="" method="post" onSubmit="return check(this)" class='bookform' name='bookform'>
			   
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
				<td>Select Duration:</td>
				<td>
					<select name="duration" id="">
						<option value="1">Once a day</option>
						<option value="2">Twice a day</option>
						<option value="3">Three times a day</option>
						<option value="4">Four times a day</option>
					 </select>
				</td>
				

                  <input type="hidden" value="<?php echo $serviceid;?>" name="packageid"/>
                   
                   </tr>
                    <tr>
                       <td><label for="">Select Date</label> </td>
                       <td>

        <input  id="datepicker" name='day'>
			</td>

<td>
					<?php
						$sid="Select serviceid from service where service_name='Feeding'";
						$result=mysqli_query($con,$sid);
						if($result){
							$row=mysqli_fetch_array($result);
						}
					?>
					<input type="hidden" value="<?php echo $row['serviceid'];?>" name='packageid'/>
						
					</td>
                        <td><label for="">Select Time</label> </td>
                       <td>
                       <div id="error5"></div>
                       <input type="text" name="time"/></td>
                    
                    </tr>
					
					<td>Select Day</td>
			
			
			<td><input type="checkbox" name="dayname[]" value="saturday" />Saturday</td> 
			<td><input type="checkbox" name="dayname[]" value="sunday" />Sunday</td> 
			 <td> <input type="checkbox" name="dayname[]" value="monday" />Monday</td> 
			 <td> <input type="checkbox" name="dayname[]" value="tuesday" />Tuesday</td> 
			<td>  <input type="checkbox" name="dayname[]" value="wednesday" />Wednesday</td> 
			 <td> <input type="checkbox" name="dayname[]" value="thursday" />Thursday</td>
                    
                </table>
                <input type="submit" name="orderbook" value="Book service" class='book' id="book1">
            </form>