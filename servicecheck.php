
		   <h2>Select and book service for Your Pet</h2>
            
             <form action="" method="post" name='frm'>
               <table>
                   <tr>
                       <td>
                           <label for="">Select Service for Your Pet : </label>
                       </td>
                       <td>

                <select style="width:100%;" name="service">
                     <option>--Select Service for your Pet--</option>
                     <?php
                        $query="SELECT * FROM service";
                        $result=mysqli_query($con,$query);
                        while($row=mysqli_fetch_array($result)){

                    ?>
                     <option value="<?php echo $row['service_name'];?>"><?php echo $row['service_name']?></option>
                    <?php
                        
                    } 
                   
                    ?>
                </select>
                       
                       </td>
                   
                   </tr>
                   <tr>
                       <td></td>
                        <td><input type="submit" name="services" value="Select service"></td>
                   </tr>
               </table>
               
            </form>
	
            
            
             <div class="packagelist">
            <?php
                           echo "<h2>Available service details</h2>";
                            $query="select * from service";
                            $result=mysqli_query($con,$query);
                          
                            if($result->num_rows>0){
                                   echo "<table border='1'>
                                    <tr>
                                        <th>Service Code</th>
                                        <th>Service name</th>
                                        <th>Duration</th>
                                        <th>Price</th>
                                    </tr>";
                                
                                while($row=mysqli_fetch_array($result)){
								
								   
                                    echo "<tr>
										
                                        <td>".$row['serviceid']."</td>
                                        <td>".$row['service_name']."</td>
                                        <td>".$row['serviceduration']."</td>
                                        <td>£ ".$row['price']."</td>
                                        
                                    </tr>";
                                    
                                }
                                  echo "</table>";
                            
                         
                            }
                        
                    ?>
                    
        </div>