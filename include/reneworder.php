<form action="reneworderlist.php" method="post" id='ordereditform' name="reneworder" onSubmit="return check(this)">
	
	<table>
	<input type="hidden" name='customerno' value="<?php echo $idno?>"/>
	<input type="hidden" name='orderno' value="<?php echo $orderno?>"/>
	<input type="hidden" name='servicename' value="<?php echo $sname?>"/>
	<input type="hidden" name='serviceprice' value="<?php echo $serviceprice?>"/>
	<input type="hidden" name='serviceid' value="<?php echo $serviceid?>"/>
	<tr>
		<td>Select pet</td>
		<td>
		<select style="width:200px;" name="pet" >
						
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
		
		<td>Select service duration</td>
		<td>
		<?php
			if($row1['service_name']=='Pet Walking'){
				echo  "<select name='duration' id=''>
						<option value='15'>15 minutes</option>
						<option value='30'>30 minutes</option>
						<option value='45'>45 minutes</option>
						<option value='60'>1 hour</option>
						<option value='75'>1.15 hours</option>
						<option value='90'>1.30 hours</option>
						<option value='105'>1.45 hours</option>
						<option value='120'>2 hours</option>
					   </select>";
			}else if($row1['service_name']=='Feeding'){
				echo  "<select name='duration' id=''>
					<option value='1'>Once a day</option>
                    <option value='2'>Twice a day</option>
                    <option value='3'>Three times a day</option>
                    <option value='4'>Four times a day</option>
					</select>";
			}else if(($row1['service_name']=='Puppy socialisation')){
				echo  "<select name='duration' id=''>
					<option value=120>2 hours</option>
					</select>";
			}else{
				echo "<select name='duration' id=''>
						<option value='30'>30 minutes</option>
						<option value='60'>1 hour</option>
						<option value='90'>1.30 hours</option>
						<option value='120'>2 hours</option>
						<option value='150'>2.30 hours</option>
					   </select>";
			}
		?>
		</td>
	</tr>
	<tr>
	
		<td>Select service date</td>

        <td><input  id="datepicker" name='day'></td>
		
		<td>Select Time</td>
		<td>
		<div id="error5"></div>
		<input type="text" value="<?php echo $row1['ordertime'];?>" name='ordertime'/></td>
		<td>Select Day</td>
		<td>
		    <select name="dayname" id="">
		        <option value="Saturday">Saturday</option>
		        <option value="Sunday">Sunday</option>
		        <option value="Monday">Monday</option>
		        <option value="Tuesday">Tuesday</option>
		        <option value="Wednesday">Wednesday</option>
		        <option value="Thursday">Thursday</option>
		    </select>
		</td>
	</tr>
	
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>
			<input type="submit" name='reneworder' value='Renew order'/>
			<input type="submit" name='cancel' value='Cancel'/>
		</td>
	</tr>
	</table>
</form>