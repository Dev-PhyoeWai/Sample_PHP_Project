<?php
require("../functions.php");
require("../database.php");
const BASE_PATH = __DIR__ . '/../';
//session_start();

if(!isLoggedIn()) {
	header('location: /sample-php-project/notes/notes.php');
	exit();
}

$user_id = $_SESSION['user']['id'];
$errors = [];
global $conn;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$title = $_POST['title'];
	$body = $_POST['body'];
	
	if (strlen($title) > 0 && strlen($body) > 0) {
		$insert = sprintf("INSERT INTO notes (title, body, user_id) VALUES ('%s', '%s', %d)",
			mysqli_real_escape_string($conn, $title),
			mysqli_real_escape_string($conn, $body),
			mysqli_real_escape_string($conn, $user_id)
		);
		
		$result = mysqli_query($conn, $insert);
		if (!$result) {
			$errors['body'] = "Error occurred.";
		} else {
			// $message = "Note has been created.";
			header('location: /sample-php-project/notes/notes.php');
			exit();
		}
	} else {
		$errors['body'] = "No valid inputs.";
	}
}
?>

<?php view('header.view.php'); ?>
<?php view('nav.view.php'); ?>
<?= $message ?? '' ?>
	<h1>Create Note </h1>
	<form action="note-create.php" method="POST">
		<div class="mb-3">
			<label for="title" class="form-label">Title</label>
			<input type="text" name="title" class="form-control" id="title" required>
		</div>
		<div class="mb-3">
			<label for="exampleInputPassword1" class="form-label">Body</label>
			<textarea name="body" class="form-control" id="body" required></textarea>
		</div>
		<?php if (!empty($errors)) : ?>
			<div><?= $errors['body'] ?></div>
		<?php endif; ?>
		<button type="submit" class="btn btn-primary">Create</button>
	</form>

<?php view('footer.view.php'); ?>