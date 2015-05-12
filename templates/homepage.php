<div id="bigbox">
	<table id="investmentList">
		<tr>
			<td><h3>Index</h3></td>
			<td><h3>ETF</h3></td>
			<td><h3>Current<br>Holding</h3></td>
			<td><h3>Allocation</h3></td>
			<td><div id="allocSum"></div></td>
		</tr>
		<tr class='investment'>
			<td><select class="index">
				<option value='none'>Choose an Index</option>
			</select></td>
	        <td><select class='etf'>
				<option value='none'>Choose an ETF</option>
			</select></td>
			<td><input class='currentShares' placeholder='# Shares'/></td>
			<td><div id='defaultRange' class='ratioRange'></div></td>
			<td><input id='ratioTextDefault' class='ratioText' value="100"></input> %</td>
		</tr>
	</table>
	<button id="calculate">Calculate</button>
	<button id="addInvestment">Add More</button>
	<br><br><div id="alerts"></div>
</div>