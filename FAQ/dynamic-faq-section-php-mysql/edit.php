<?php
	// connect with database
	$conn = new PDO("mysql:host=localhost;dbname=test", "root", "");

	// check if FAQ exists
	$sql = "SELECT * FROM faqs WHERE id = ?";
	$statement = $conn->prepare($sql);
	$statement->execute([
		$_REQUEST["id"]
	]);
	$faq = $statement->fetch();

	if (!$faq) {
		die("FAQ not found");
	}

	// check if edit form is submitted
	if (isset($_POST["submit"])) {
		// update the FAQ in database
		$sql = "UPDATE faqs SET question = ?, answer = ? WHERE id = ?";
		$statement = $conn->prepare($sql);
		$statement->execute([
			$_POST["question"],
			$_POST["answer"],
			$_POST["id"]
		]);

		// redirect back to previous page
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	}
?>

<!-- include CSS -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="richtext/richtext.min.css" />

<!-- include JS -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="richtext/jquery.richtext.js"></script>

<!-- layout for form to edit FAQ -->
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
	<div class="row">
		<div class="offset-md-3 col-md-6">
			<h1 class="text-center">Edit FAQ</h1>

			<!-- form to edit FAQ -->
			<form method="POST" action="edit.php">

				<!-- hidden ID field of FAQ -->
				<input type="hidden" name="id" value="<?php echo $faq['id']; ?>" required />

				<!-- question, auto-populate -->
				<div class="form-group">
					<label>Enter Question</label>
					<input type="text" name="question" class="form-control" value="<?php echo $faq['question']; ?>" required />
				</div>

				<!-- answer, auto-populate -->
				<div class="form-group">
					<label>Enter Answer</label>
					<textarea name="answer" id="answer" class="form-control" required><?php echo $faq['answer']; ?></textarea>
				</div>

				<!-- submit button -->
				<input type="submit" name="submit" class="btn btn-warning" value="Edit FAQ" />

				<!-- back button -->
				<a href="add.php" class="btn btn-secondary">Back</a>
			</form>
		</div>
	</div>
</div>

<script>
	// initialize rich text library
	window.addEventListener("load", function () {
		$("#answer").richText();
	});
</script>
