<form action="updatepet.php" method='post' name="editpet" onSubmit="return check(this)">

	<table>
	<tr>
	<input type="hidden" name='petid' value="<?php echo $petid;?>"/>
		<td>Pet Name</td>
		<td>
		<input type="text" value="<?php echo $row['petname']?>" name="petname"/></td>
		
		<td>Group Name</td>
		<td>
			 <select name="group" id="">
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
		<td>Weight</td>
			<td><input type="text" name='weight' value="<?php echo $row['weight']?>"/></td>
	</tr>
	<tr>
		<td>Date of birth</td>
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
					<option value="2006">2006</option>
					<option value="2007">2007</option>
					<option value="2008">2008</option>
					<option value="2009">2009</option>
					<option value="2010">2010</option>
					<option value="2011">2012</option>
					<option value="2013">2013</option>
					<option value="2014">2014</option>
					<option value="2015">2014</option>
					<option value="2016">2016</option>
				</select>
			</td>
			
			
	</tr>
	<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	
	<td><input type="submit" name="updatepet" value="Update pet details"/></td>
	<td></td>
	</tr>
	</table>
</form>
<form action="updatepet.php" method="post" class="canceledit">
    <table>
        <tr>
            <td>
                <input type="submit" name="cancel" value="Cancel"/>
            </td>
            
        </tr>
    </table>
</form>