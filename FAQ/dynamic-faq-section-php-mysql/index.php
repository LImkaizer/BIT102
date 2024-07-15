<?php
    // connect with database
    $conn = new PDO("mysql:host=localhost;dbname=test", "root", "");

    // fetch all FAQs from database
    $sql = "SELECT * FROM faqs";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $faqs = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <!-- include CSS -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- include JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            background: linear-gradient(to right, #4CAF50, #2E8B57);
            color: white;
            padding: 70px 0;
            text-align: center;
        }
        .header h1 {
            font-size: 3rem;
            font-weight: 700;
        }
        .header p {
            font-size: 1.5rem;
        }
        .accordion .card {
            border: none;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 5px 5px 0 0;
        }
        .card-header h2 button {
            font-size: 1.25rem;
            font-weight: 600;
            text-align: left;
            color: white;
            width: 100%;
            padding: 0;
        }
        .card-header h2 button:hover {
            text-decoration: none;
            color: #e2e2e2;
        }
        .card-body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .btn-link {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>

<header class="header">
    <div class="container">
        <h1 class="display-4">Frequently Asked Questions</h1>
        <p class="lead">Find answers to the most common questions below.</p>
    </div>
</header>

<div class="container my-5">
    <div class="accordion" id="faqAccordion">
        <?php foreach ($faqs as $index => $faq): ?>
            <div class="card">
                <div class="card-header" id="heading-<?php echo $index; ?>">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $index; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $index; ?>">
                            <?php echo $faq['question']; ?>
                        </button>
                    </h2>
                </div>

                <div id="collapse-<?php echo $index; ?>" class="collapse" aria-labelledby="heading-<?php echo $index; ?>" data-parent="#faqAccordion">
                    <div class="card-body">
                        <?php echo $faq['answer']; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
