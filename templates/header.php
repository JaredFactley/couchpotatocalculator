<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
        <?php if (isset($title)): ?>
            <title>Index Invest Canada: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Index Invest Canada</title>
        <?php endif ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/indexinvest.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script src="js/jquery-2.1.1.js"></script>
    <script type="text/javascript" src="js/indexinvest.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="js/etflist.js"></script>
    <script src="js/jquery-ui.js"></script>
</head>
<body id="page">
<!--     <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only"> Toggle navigation </span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    Index Investing
                </a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Link</a></li>
                    <li><a href="calculator.php">Calculator</a></li/>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                      </ul>
                    </li>
                  </ul>
                  <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Quick quote">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
        </div>
    </nav> -->

<div container-fluid>
    <div id="help" class="btn-group popHelpDiv" role="group">
        <a href="#" id="triggerHelp" class="btn btn-danger btn-sm" data-trigger="focus">
            <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Help
        </a>
        <a href="#" id="triggerAbout" class="btn btn-danger btn-sm" data-trigger="focus">
            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> About
        </a>
        <a href="#" id="triggerContact" class="btn btn-danger btn-sm" data-trigger="focus">
            <span class="glyphicon glyphicon-envelope"> Contact</span>
        </a>
    </div>
    <div id="popContents" class="hide">
        <div id="headHelp">
            Help
        </div>
        <div id="contentHelp">
            <small><p>The Couch Potato Calculator is an index investment calculator.</p>
            <p>Use the <b>Add</b> and <b>Remove</b> buttons to add investment rows as desired.</p>
            <p>Use the dropdowns to select the <b>Index</b> and specific <b>ETF</b> to invest in for each.</p>
            <p>If the ETF you would like to invest in is not listed, choose <b>OTHER</b> from the <b>Index</b> menu and enter the <b>ETF</b> symbol manually. (For TSX listed securities, be sure to add the .TO suffix.)</p>
            <p>Assign desired allocations to each index using the sliders or text box. Allocations must total 100%.</p>
            <p>Input the total cash amount to be invested. If you are rebalancing and not investing additional funds, leave this box blank or enter '0'.</p>
            <p>After pressing <b>Calculate</b> you will be presented with three tabs - (1) your <b>Current Portfolio</b>, (2) your <b>Final Portfolio</b>, and (3) the <b>Transactions</b> to process to achieve this.</p></small>
        </div>
        <div id="headAbout">
            About
        </div>
        <div id="contentAbout">
            <small><p>The Couch Potato Calculator is an index investment calculator.</p>
            <p>Its goal is to make index investing easier for people creating a new portfolio, investing additional funds or rebalancing their current investments.</p>
            <p>You can read more about index investing at the <a href="http://www.canadiancouchpotato.com/">Canadian Couch Potato</a> website.</p>
            <p>Prices are up to date and accurate within approximately 15 minutes as per Yahoo Finance.</p>
            <p>Prices of US ETFs have been converted to CAD from USD using realtime exchange rates also from Yahoo Finance.</p></small>
        </div>
        <div id="headContact">
            Contact
        </div>
        <div id="contentContact">
            <small><p>The Couch Potato Calculator was created by <a href="http://www.jaredfactley.com">Jared Factley</a></p>
            <p>Please email me at <a href="mailto:jaredfactley@gmail.com">jaredfactley@gmail.com</a> with any comments, questions or feedback.</p></small>
        </div>
    </div>
    <a href="/" id="couchLogo"></a>
</div>


<!-- The Couch Potato Calculator is an index investment calculator. To use, simply add as many investment rows as desired, choosing the index you wish to invest in for each from the dropdown. After the index is chosen, choose the specific ETF you will purchase from the second dropdown. Assign desired allocations to each index using the sliders or text box. Ensure that allocations total 100%, else you will not be able to submit the form. Finally, input the total dollar value you will invest at this time. If you are rebalancing and not investing additional funds, leave this box blank or enter '0'. Upon submission, you will be presented with three tabs. The first tab shows your current portfolio, including value and allocations. Prices indicated are the last traded value recorded with ~15 minute delay. The second tab shows how your portfolio will look after. The final tab will detail which transactions you need to make with your broker in order to achieve your desired portfolio. This will include whether you need to buy or sell shares, and the appropriate quantity. * For US listed ETFs, prices quoted have been converted from USD to CAD using current FX rates. -->