<div id="bigbox" class="container">
	<div id="content">
		<ul id="pills" class="nav nav-pills nav-justified" data-pills="pills">
		  <li class="active"><a href="#current" data-toggle="tab">Current Portfolio</a></li>
		  <li><a href="#after" data-toggle="tab">Final Portfolio</a></li>
		  <li><a href="#transactions" data-toggle="tab">Required Transactions</a></li>
		</ul>
		<div id="my-tab-content" class="tab-content">
	        <div class="tab-pane active" id="current">
				<table id="investmentBefore" class="table table-hover">
				<tr>
					<td><h4>Index Name</h4></td>
					<td><h4>ETF Name</h4></td>
					<td><h4>Symbol</h4></td>
					<td><h4>Current Holding</h4></td>
					<td><h4>Current Allocation</h4></td>
					<td><h4>Price</h4></td>
					<td><h4>Holding Value</h4></td>
				</tr>
<?php
	$currentValue = 0;
	$newValue = 0;
	foreach ($investmentList as $investment) {
		$currentValue += $investment["price"] * $investment["holding"];
	}
   	$totalValue = $cash + $currentValue;
   	foreach ($investmentList as $investment) {
   		print ("<tr>");
   		print ("<td>" . $investment["index"] . "</td>");
   		print ("<td>" . $investment["name"] . "</td>");
   		print ("<td>" . $investment["symbol"] . "</td>");
   		print ("<td>" . $investment["holding"] . " shares</td>");
   		if ($currentValue > 0) {
   			print ("<td>" . round($investment["price"] * $investment["holding"] / $currentValue * 100, 2) . "%</td>");
   		}
   		else {
   			print ("<td>No current investment.</td>");
   		}
   		if ($investment["cad"] == true) {
   			print ("<td>$" . $investment["price"] . "</td>");
   		}
   		elseif ($investment["cad"] == false) {
   			print ("<td>$" . $investment["price"] . " *(FX from USD)</td>");
   		}
   		print ("<td>$" . $investment["price"] * $investment["holding"] . "</td>");
   		print ("</tr>");
   	}
	print ("<tr>");
	print ("<td><b>Total Value of Investments</b></td><td></td><td></td><td></td><td></td><td></td>");
	print ("<td><b>$" . $currentValue . "</b></td>");
	print ("</tr>");
	print ("<tr>");
	print ("<td><b>Available cash</b></td><td></td><td></td><td></td><td></td><td></td>");
	print ("<td>$" . $cash . "</td>");
	print ("</tr>");
	print ("</table>");
?>
			</div>

	    	<div class="tab-pane" id="after">
				<table id="investmentAfter" class="table table-hover">
					<tr>
						<td><h4>Index Name</h4></td>
						<td><h4>ETF Name</h4></td>
						<td><h4>Symbol</h4></td>
						<td><h4>New Holding</h4></td>
						<td><h4>Target Allocation</h4></td>
						<td><h4>Real Allocation</h4></td>
						<td><h4>Price</h4></td>
						<td><h4>Holding Value</h4></td>
					</tr>
<?php
	for ($i = 0; $i < count($investmentList); $i++) {
		print ("<tr>");
   		print ("<td>" . $investmentList[$i]["index"] . "</td>");
   		print ("<td>" . $investmentList[$i]["name"] . "</td>");
   		print ("<td>" . $investmentList[$i]["symbol"] . "</td>");
   		// variable for new shares
   		$investmentList[$i]["newHolding"] = floor($totalValue / 100 * $investmentList[$i]["allocation"] / $investmentList[$i]["price"]);
   		print ("<td>" . $investmentList[$i]["newHolding"] . " shares</td>");
   		print ("<td>" . $investmentList[$i]["allocation"] . "%</td>");
   		if ($totalValue > 0) {
   			print ("<td>" . round($investmentList[$i]["newHolding"] * $investmentList[$i]["price"] / $totalValue * 100, 2) . "%</td>");
   		}
   		else {
   			print ("<td>No investment.</td>");
   		}
   		
   		if ($investmentList[$i]["cad"] == true) {
   			print ("<td>$" . $investmentList[$i]["price"] . "</td>");
   		}
   		elseif ($investmentList[$i]["cad"] == false) {
   			print ("<td>$" . $investmentList[$i]["price"] . " *(FX from USD)</td>");
   		}
   		print ("<td>$" . $investmentList[$i]["newHolding"] * $investmentList[$i]["price"] . "</td>");
   		print ("</tr>");
		$newValue += $investmentList[$i]["price"] * $investmentList[$i]["newHolding"];
	}
	print ("<tr>");
	print ("<td><b>Total Value of Investments</b></td><td></td><td></td><td></td><td></td><td></td><td></td>");
	print ("<td><b>$" . $newValue . "</b></td>");
	print ("</tr>");
	print ("<tr>");
	print ("<td><b>Available cash</b></td><td></td><td></td><td></td><td></td><td></td><td></td>");
	print ("<td>$" . round($totalValue - $newValue, 2) . "</td>");
	print ("</tr>");
?>
				</table>
			</div>

			<div class="tab-pane" id="transactions">
				<table id="investmentTransactions" class="table table-hover">
					<tr>
						<td><h4>Index Name</h4></td>
						<td><h4>ETF Name</h4></td>
						<td><h4>Symbol</h4></td>
						<td><h4>Buy/Sell</h4></td>
						<td><h4>Shares</h4></td>
						<td><h4>Price</h4></td>
						<td><h4>Transaction Value</h4></td>
					</tr>
<?php
	foreach ($investmentList as $investment) {
   		print ("<tr>");
   		print ("<td>" . $investment["index"] . "</td>");
   		print ("<td>" . $investment["name"] . "</td>");
   		print ("<td>" . $investment["symbol"] . "</td>");
   		if ($investment["holding"] > $investment["newHolding"]) {
   			print ("<td>Sell</td>");
   		}
   		else {
   			print ("<td>Buy</td>");
   		}
   		print ("<td>" . round($investment["newHolding"] - $investment["holding"]) . "</td>");
		if ($investment["cad"] == true) {
   			print ("<td>$" . $investment["price"] . "</td>");
   		}
   		elseif ($investment["cad"] == false) {
   			print ("<td>$" . $investment["price"] . " *(FX from USD)</td>");
   		}
   		print ("<td>$" . -1 * (round(($investment["newHolding"] - $investment["holding"]) * $investment["price"], 2)) . "</td>");
   		print ("</tr>");
   	}
?>
				</table>
			</div>
		</div>
	</div>
</div>