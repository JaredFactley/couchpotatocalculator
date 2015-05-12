<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $index = $_POST["index"];
        $etf = $_POST["etf"];
        $currentShares = $_POST["currentShares"];
        $allocText = $_POST["allocText"];
        $cash = $_POST["cash"];
        $usd = usdExchange();
        $investmentList = [];

        // check that cash contains numeric content
        if (preg_match("/\D/", $cash)) {
                render("alert.php", ["warning" => "Money to invest can only contain numeric values. Please return to the previous page and try again."]);
                exit;
            }        

        // check that each index and etf input contained a valid selection, alert if not
        for ($i = 0; $i < count($index); $i++) {
            $price;
            $cad;
            if ("$index[$i]" === "none") {
                render("alert.php", ["warning" => "You must select an index for each investment. Please return to the previous page and try again."]);
                exit;
            }
        // check that each index and etf input contained a valid selection, alert if not
            else if ("$etf[$i]" === "none") {
                render("alert.php", ["warning" => "You must select an ETF for each investment. Please return to the previous page and try again."]);
                exit;
            }
        // check that each current share input contained numeric values, alert if not
            else if (preg_match("/\D/", $currentShares[$i])) {
                render("alert.php", ["warning" => "Current shares can only contain numeric values. Please return to the previous page and try again."]);
                exit;
            }
            else {            
                if ($currentShares[$i] == "") {
                    $currentShares[$i] = 0;
                }
                $stockInfo = lookup($etf[$i]);
            if (preg_match("/\.TO$/" ,"$etf[$i]")) {
                $price = $stockInfo["price"];
                $cad = true;
            }
            else {
                $price = round($stockInfo["price"] / $usd["price"], 2);
                $cad = false;
            }

        // put all investments into array to pass to calculation.php
                $investmentList[] = [
                    "index" => "$index[$i]",
                    "name" => $stockInfo["name"],
                    "symbol" => "$etf[$i]",
                    "holding" => "$currentShares[$i]",
                    "allocation" => "$allocText[$i]",
                    "price" => $price,
                    "cad" => $cad
                ];
            }
        }

        render("calculation.php", ["title" => "Calculation", "investmentList" => $investmentList,"usd" => $usd, "index" => $index, "etf" => $etf, "currentShares" => $currentShares, "allocText" => $allocText, "cash" => $cash]);
    }
    else
    {
        // else render form
        render("calculator_form.php", ["title" => "Couch Potato Calculator"]);
    }

?>
