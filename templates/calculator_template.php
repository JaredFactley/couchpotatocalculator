
<form action="calculator.php" method="post">
    <fieldset>
    	<div class ="btn-group" role="group">
	        Index type: 
	        <select id="indexType">
	            <option value="none">Select</option>
	            <script>
					// get dropdown element
					var dropdownTypes = document.getElementById("indexType");

					// loop through array
					for (var i = 0; i < ETFTYPES.length; i++) 
					{
						// append element to the end of the array list
						dropdownTypes[dropdownTypes.length] = new Option(ETFTYPES[i].name, ETFTYPES[i].name);
					}
					indexType.addEventListener("click", etfDropdownLoad);
				</script>
	        </select>
	        <select id="etfSelect">
    			<option value="none">Choose an ETF</option>
    		</select>
    		<div class="slider">		
				<label for=ratio>Split: </label>
				<output for=ratio id=split>25</output>
				<input type=range min=0 max=100 value=99 id=ratio step=1onchange="splitUpdate(value)">
				<script>
					function splitUpdate(vol) {
					document.querySelector('#split').value = spl;
					}
				</script>
		    </div>		
		</div>
		<br><br>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Calculate</button>
        </div>
    </fieldset>
</form>