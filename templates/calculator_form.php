<form action="calculator.php" method="post">
	<div id="investmentList" class="container-fluid">	
		<div class='row investment'>
			<div class="col-md-2 col-md-offset-2 col-xs-12">
				<label for="defaultIndex">Select an Index</label>
				<select name="index[]" id="defaultIndex" class="form-control index">
					<option value='none'>Choose</option>
				</select>
			</div>
	        <div class="col-md-1 col-xs-6" id="etfDiv">
	        	<label for="defaultEtf">Select an ETF</label>
	        	<select name='etf[]' id="defaultEtf" class='form-control etf'>
					<option value='none'>Choose</option>
				</select>
			</div>
			<div class="col-md-1 col-xs-4">
				<label for="defaultCurrentShares">Currently held</label>
				<input name='currentShares[]' id="defaultCurrentShares" class='form-control currentShares' placeholder='# Shares'/>
			</div>
			<div class="col-md-1 col-xs-5">
				<label for="defaultRange">Allocation</label>
				<div class="allocRange" id='defaultRange'></div>
			</div>
			<div id="allocGroup" class="col-md-1 col-xs-3 input-group">
					<input id='allocTextDefault' name='allocText[]' class='form-control allocText' value="100"/>
					<span id="addonDefault" class="input-group-addon">%</span>
			</div>
			<div class="col-md-1 col-xs-4">
				<label for="addInvestment">Add/remove</label>
				<button type="button" id="addInvestment" class="form-control button"><span class="glyphicon glyphicon-plus"></span> Add</button>
			</div>
		</div>
	</div>
	<div id="controls" class="container-fluid">
		<div class="row">
			<h4><span class="totalLabel col-md-offset-6 col-md-1 col-xs-5 col-xs-offset-4 label label-default">Total allocation:</span></h4>
			<div class="input-group col-md-1">
				<input type="text" id="allocSum" class="form-control">
				<span class="input-group-addon">%</span>
			</div>
		</div>
		<div class="row controlRow">
			<div class="col-md-2 col-md-offset-2 col-xs-6 input-group">
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-usd">
					</span>
				</span>
				<input name="cash" class="form-control" placeholder="Money to invest."/>
				<span class="input-group-addon">.00
				</span>
			</div>
			<div class="col-md-1 col-xs-6">
				<button id="calculate" class="btn btn-primary form-control" type="submit"><span class="glyphicon glyphicon-ok"></span> Calculate</button>
			</div>
		</div>
		<div class="row controlRow">
			<div class="col-md-4 col-md-offset-2 col-xs-offset-1 col-xs-10">
				<div class="alert alert-success" id="alerts"></div>
			</div>
		</div>
	</div>
</form>
