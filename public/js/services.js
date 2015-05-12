function etfDropdownLoad()
{
	// get dropdown elements
	var typeDropdown = document.getElementById("indexType");
	var etfDropdown = document.getElementById("etfSelect");

	console.log("etf dropdown length:", etfDropdown.length);

	if (etfDropdown.length !== 1)
	{
		// remove all previous dropdown options
		for (var k = etfDropdown.length; k > 0; k--)
		{
			etfDropdown.remove(k);
			console.log("removed number: ", k)
		}
	}


	// get selected index type
	var selectedIndexType = typeDropdown.options[typeDropdown.selectedIndex].value;

	// // loop through array
	for (var i = 0; i < ETFTYPES.length; i++) 
		{
			// check if type matches selected
			if (selectedIndexType == ETFTYPES[i].name) 
			{
				// loop through corresponding etf array
				for (var j = 0; j < ETFTYPES[i].etf.length; j++)
				{
					// append element to the end of the array list
					etfDropdown[etfDropdown.length] = new Option(ETFTYPES[i].etf[j], ETFTYPES[i].etf[j]);
				}
			}

		}
};