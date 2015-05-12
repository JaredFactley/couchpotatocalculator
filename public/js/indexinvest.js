$(document).ready(function() {
    var max_fields = 10; //maximum input rows allowed
    var x = 1; //initlal row count    
    var investmentList = $("#investmentList"); //table holding rows
    var addButton = $("#addInvestment"); //Add button ID
    var indexDropdown   = $(".index") //variable for the index dropdown class

    //initialize popovers
    $("#popHelp").popover();
    $("#popAbout").popover();

    $('#triggerHelp').popover({
        html : true,
        title: function() {
          return $("#headHelp").html();
        },
        content: function() {
          return $("#contentHelp").html();
        },
        container: 'body',
        placement: 'bottom'
    });

    $('#triggerAbout').popover({
        html : true,
        title: function() {
          return $("#headAbout").html();
        },
        content: function() {
          return $("#contentAbout").html();
        },
        container: 'body',
        placement: 'bottom'
    });

    $('#triggerContact').popover({
        html : true,
        title: function() {
          return $("#headContact").html();
        },
        content: function() {
          return $("#contentContact").html();
        },
        container: 'body',
        placement: 'bottom'
    });

    //populate initial index dropdown on page load
    for (var i = 0; i < ETFTYPES.length; i++) 
    {
        $(indexDropdown).append("<option value='" + ETFTYPES[i].index + "'>" + ETFTYPES[i].index + "</option>")
    }    
    $(indexDropdown).append("<option class='otherOption' value='Other'>OTHER - Specify ETF</option>");

    //initialize default range item
    $(function() {
        $("#defaultRange").slider({
            orientation: "horizontal",
            min: 0,
            max: 100,
            value: 100,
            step: 1,
            animate: true,
            change: updateRangeText,
            slide: updateRangeText,
        })
        updateSum();
    });


    //add new investment row when add button is clicked
    $(addButton).on("click", function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(investmentList).append(templateInvestment); //add input box
            //assign variable to the index dropdown of the newly added investment row
            var newIndex = $("#investmentList .row:last-child").children('div').children('.index');
            //populate options of new index dropdown
            for (var i = 0; i < ETFTYPES.length; i++) 
            {
                $(newIndex).append("<option value='" + ETFTYPES[i].index + "'>" + ETFTYPES[i].index + "</option>")
            }
            $(newIndex).append("<option class='otherOption' value='Other'>OTHER - Specify ETF</option>");
            //initialize slider, set variable for div becoming slider
            var newSlider = $("#investmentList .row:last-child").children().children('.allocRange');
            $(newSlider).slider({
                orientation: "horizontal",
                min: 0,
                max: 100,
                value: 0,
                step: 1,
                animate: true,  
                change: updateRangeText,
                slide: updateRangeText,
            });
            updateRangeText();
        };
        updateSum();
    });

    //remove investment row when remove button is clicked
    $(investmentList).on("click",".removeInvestment", function(e){ //user click on remove button
        //remove the parent(row) of the parent (div) of the button
        e.preventDefault(); $(this).parent().parent().remove(); 
        //decrement row count
        x--; 
        updateSum();
    });

    //populate etf dropdown after index is chosen
    $(investmentList).on("change", ".index", function() {
        //declare variable for the etf dropdown related to clicked index
        var etfDropdownCurrent = $(this).parent().parent().children().children(".etf");
        //get selected index and store in variable
        var selectedIndex = $(this).find(":selected").text();
        // remove all previous dropdown options
        $(etfDropdownCurrent)
            .find('option')
            .remove()
            .end()
            .append("<option value='none'>Choose</option>")
            .val("none");
        // if index selected is other, replace dropdown with text input
        if (selectedIndex == "OTHER - Specify ETF") {
            etfDropdownCurrent.remove();
            $(this).parent().parent().children("#etfDiv").append("<input name='etf[]' class='form-control etf' placeholder='ETF Symbol'></input> ");
            return;
        }
        else if (selectedIndex != "OTHER - Specify ETF") {
            etfDropdownCurrent.remove();
            $(this).parent().parent().children("#etfDiv").append("<select name='etf[]' class='form-control etf'><option value='none'>Choose</option></select>");
        }
        etfDropdownCurrent = $(this).parent().parent().children().children(".etf");
        console.log(etfDropdownCurrent);
        // // loop through array of etfs
        for (var i = 0; i < ETFTYPES.length; i++) 
        {
            // check if type matches selected
            if (selectedIndex == ETFTYPES[i].index) 
            {
                // loop through corresponding etf array
                for (var j = 0; j < ETFTYPES[i].etf.length; j++)
                {
                    // append element to the end of the array list
                    $(etfDropdownCurrent).append("<option value='" + ETFTYPES[i].etf[j] + "'>" + ETFTYPES[i].etf[j] + "</option>")
                }
            }

        }
    });

    //populate alloc text box from range input
    function updateRangeText(event, ui){
        $(this).parent().parent().children().children('.allocText').val(ui.value);
        updateSum();
    };

    //populate allocation sum
    function updateSum() {
        var allocSum = 0;
        for (var i = 1; i <= x; i++){
            allocSum += parseInt($("#investmentList .row:nth-child(" + i + ")").children().children(".allocRange").slider("option", "value"));
        }
        $("#allocSum").val(allocSum);
        if (allocSum > 100) {
            $(".totalLabel").removeClass("label-success");
            $(".totalLabel").addClass("label-danger");
            $("#alerts").removeClass("alert-success");
            $("#alerts").addClass("alert-danger");
            $("#calculate").prop('disabled', true);
            $("#alerts").empty();
            $("#alerts").append("<p><b>Warning!</b> Total allocation cannot be greater than 100%.</p>");
        }
        else if (allocSum < 100) {
            $(".totalLabel").removeClass("label-success");
            $(".totalLabel").addClass("label-danger");
            $("#calculate").prop('disabled', true);
            $("#alerts").removeClass("alert-success");
            $("#alerts").addClass("alert-danger");
            $("#alerts").empty();
            $("#alerts").append("<p><b>Warning!</b> Total allocation cannot be less than 100%.</p>");
        }
        else if (allocSum == 100) {
            $(".totalLabel").removeClass("label-danger");
            $(".totalLabel").addClass("label-success");
            $("#alerts").removeClass("alert-danger");
            $("#alerts").addClass("alert-success");
            $("#calculate").prop('disabled', false);
            $("#alerts").empty();
            $("#alerts").append("<p><b>Ready?</b> Please press calculate to submit.</p>");
        }
    };

    //update slider on text input with enter press
    $("#investmentList").on("keyup focusout", ".allocText", function(e) {
        if (e.keyCode == 13 || e.type == "focusout"){
            ///variable for current value in the text box
            var currBox = $(this).val();
            if (currBox < 0 || currBox > 100) {
                $("#alerts").empty();
                $("#alerts").append("<p>Allocation must be between 0 and 100%.</p>");
            }
            else if ($.isNumeric(currBox) == false) {
                $("#alerts").empty();
                $("#alerts").removeClass("alert-success");
                $("#alerts").addClass("alert-danger");
                $("#alerts").append("<p><b>Warning!</b> Allocations must be numeric values.</p>");
            }
            else {
                $(this).parent().parent().children().children(".allocRange").slider("option", "value", currBox);
                updateSum();
            }

        };
    });

    //check current shares on text input with enter press
    $("#investmentList").on("keyup focusout", ".currentShares", function(e) {
        if (e.keyCode == 13 || e.type == "focusout"){
            ///variable for current value in the text box
            var currBox = $(this).val();
            if ($.isNumeric(currBox) == false && currBox !== "") {
                $("#alerts").empty();
                $("#alerts").removeClass("alert-success");
                $("#alerts").addClass("alert-danger");
                $("#alerts").append("<p><b>Warning!</b> Current share holding must be numeric.</p>");
                $("#calculate").prop('disabled', true);
            }
            else {
                $("#calculate").prop('disabled', false);
                $("#alerts").removeClass("alert-danger");
                $("#alerts").addClass("alert-success");
                $("#alerts").empty();
                $("#alerts").append("<p><b>Great!</b> Current share holding is now numeric.</p>");
                updateSum();
            }

        };
    });

});

//declare html text to be added in new rows as string variable
var templateInvestment = 
    "<div class='row investment'> \
        <div class='col-md-2 col-md-offset-2 col-xs-12'> \
            <select name='index[]' class='form-control index'> \
                <option value='none'>Choose</option> \
            </select> \
        </div> \
        <div class='col-md-1 col-xs-6' id='etfDiv'> \
            <select name='etf[]' class='form-control etf'> \
                <option value='none'>Choose</option> \
            </select> \
        </div> \
        <div class='col-md-1 col-xs-4'> \
            <input name='currentShares[]' class='form-control currentShares' placeholder='# Shares'> \
            </input> \
        </div> \
        <div class='col-md-1 col-xs-5'> \
            <div name='allocRange[]' class='allocRange'> \
            </div> \
        </div> \
        <div class='col-md-1 col-xs-3 input-group'> \
            <input class='form-control allocText' name='allocText[]' value='0'> \
            </input> \
            <span class='input-group-addon'>% \
            </span> \
        </div> \
        <div class='col-md-1 col-xs-4'> \
            <button type='button' class='form-control removeInvestment'> \
                <span class='glyphicon glyphicon-remove'></span> Remove \
            </button> \
        </div> \
    </div>";