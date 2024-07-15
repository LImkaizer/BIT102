<?php
    // Initialize the database connection
    try {
        $conn = new PDO("mysql:host=localhost;dbname=test", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit;
    }

    $result = "";

    if (isset($_GET['btn_submit'])) {
        // Sanitize and validate inputs
        $digit = filter_input(INPUT_GET, 'txt_digit', FILTER_VALIDATE_FLOAT);
        $from_currency = filter_input(INPUT_GET, 'from_currency', FILTER_SANITIZE_STRING);
        $to_currency = filter_input(INPUT_GET, 'to_currency', FILTER_SANITIZE_STRING);

        if ($digit !== false && $digit != "" && $from_currency && $to_currency) {
            switch ($to_currency) {
                case "Dollar":
                    $output = $digit * 0.21;
                    $symbol = "$";
                    break;

                case "Euro":
                    $output = $digit * 0.19;
                    $symbol = "&#8364;";
                    break;

                case "Pound":
                    $output = $digit * 0.16;
                    $symbol = "&#163;";
                    break;

                case "Chinese Yuan":
                    $output = $digit * 1.55;
                    $symbol = "&#165;";
                    break;

                case "Japanese Yen":
                    $output = $digit * 33.83;
                    $symbol = "&#165;";
                    break;

                default:
                    $result = "<label class='text-danger' style='font-size:25px;'>Invalid currency selected</label>";
                    exit;
            }
            $result = "<label class='text-success' style='font-size:25px;'>RM$digit = $symbol$output $to_currency</label>";
        } else {
            $result = "<label class='text-danger' style='font-size:25px;'>Invalid input. Please enter a valid amount and select currencies.</label>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #3a6351, #4a7c59);
            margin: 0;
        }
        .converter-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .converter-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .converter-container label, 
        .converter-container select,
        .converter-container input {
            margin: 10px 0;
            font-size: 18px;
            width: 100%;
        }
        .converter-container input[type="text"],
        .converter-container select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .converter-container input[type="submit"] {
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            background-color: #3a6351;
            border: none;
            border-radius: 5px;
            color: #fff;
            transition: background-color 0.3s ease;
        }
        .converter-container input[type="submit"]:hover {
            background-color: #4a7c59;
        }
        .text-success {
            color: #3a6351;
        }
        .text-danger {
            color: red;
        }
        #result {
            margin-top: 20px;
            font-size: 25px;
        }
    </style>
</head>
<body>

<div class="converter-container">
    <h1>Currency Converter</h1>
    <form method="GET" action="">
        <label for="txt_digit">Enter Amount:</label>
        <input type="text" id="txt_digit" name="txt_digit" required><br>

        <label for="from_currency">From Currency:</label>
        <select id="from_currency" name="from_currency" required>
            <option value="RM">RM</option>
        </select><br>

        <label for="to_currency">To Currency:</label>
        <select id="to_currency" name="to_currency" required>
            <option value="Dollar">Dollar</option>
            <option value="Euro">Euro</option>
            <option value="Pound">Pound</option>
            <option value="Chinese Yuan">Chinese Yuan</option>
            <option value="Japanese Yen">Japanese Yen</option>
        </select><br>

        <input type="submit" name="btn_submit" value="Convert">
    </form>

    <div id="result">
        <?php
            if (!empty($result)) {
                echo $result;
            }
        ?>
    </div>
</div>

</body>
</html>
