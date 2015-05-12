<?php

    require_once("constants.php");
    require_once("classes.php");

    /**
     * Facilitates debugging by dumping contents of variable
     * to browser.
     */
    function dump($variable)
    {
        require("../templates/dump.php");
        exit;
    }

    function queryArray($command)
    {
        // Try to connect to database, catching error and reporting if applicable
        try
        {
            $handler = new PDO("mysql:host=".SERVER.";dbname=".DATABASE, USERNAME, PASSWORD);
            $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            die();
        }
        // Query database with passed in variable $command
        $query = $handler->query($command);
        // Fetch all results and store in class variable $results
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;

    }

    function queryClass($command, $class)
    {
        // Try to connect to database, catching error and reporting if applicable
        try
        {
            $handler = new PDO("mysql:host=".SERVER.";dbname=".DATABASE, USERNAME, PASSWORD);
            $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            die();
        }
        // Query database with passed in variable $command
        $query = $handler->query($command);
        // Fetch all results and store in class variable $results
        $results = $query->fetchAll(PDO::FETCH_CLASS, $class);
        
        return $results;

    }

    function render($template, $values = [])
    {
        // if template exists, render it
        if (file_exists("../templates/$template"))
        {
            // extract variables into local scope
            extract($values);

            // render header
            require("../templates/header.php");

            // render template
            require("../templates/$template");

            // render footer
            require("../templates/footer.php");
        }

        // else err
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }

    function lookup($symbol)
    {
        // reject symbols that start with ^
        if (preg_match("/^\^/", $symbol))
        {
            return false;
        }

        // reject symbols that contain commas
        if (preg_match("/,/", $symbol))
        {
            return false;
        }

        // open connection to Yahoo
        $handle = @fopen("http://download.finance.yahoo.com/d/quotes.csv?f=nl1&s=$symbol", "r");
        if ($handle === false)
        {
            // trigger (big, orange) error
            trigger_error("Could not connect to Yahoo!", E_USER_ERROR);
            exit;
        }

        // download first line of CSV file
        $data = fgetcsv($handle);
        if ($data === false || count($data) == 1)
        {
            return false;
        }

        // close connection to Yahoo
        fclose($handle);

        // ensure symbol was found
        if ($data[1] === "0.00")
        {
            render("alert.php", ["warning" => "The stock symbol for the selected ETF does not exist. Please return to the previous page and reconfirm. Please note that for TSX listed securities you must include the '.TO' suffix (ex. 'XIC.TO')."]);
            die();
            return false;
        }

        // return stock as an associative array
        return [
            "name" => $data[0],
            "price" => $data[1],
        ];
    }

    function usdExchange()
    {
        // open connection to Yahoo
        $handle = @fopen("http://download.finance.yahoo.com/d/quotes.csv?f=anl1&s=CADUSD=X", "r");
        if ($handle === false)
        {
            // trigger (big, orange) error
            trigger_error("Could not connect to Yahoo!", E_USER_ERROR);
            exit;
        }

        // download first line of CSV file
        $data = fgetcsv($handle);
        if ($data === false || count($data) == 1)
        {
            return false;
        }

        // close connection to Yahoo
        fclose($handle);

        // ensure symbol was found
        if ($data[0] === "0.00")
        {
            return false;
        }

        // return stock as an associative array
        return [
            "ask" => $data[0],
            "name" => $data[1],
            "price" => $data[2]
        ];
    }

?>