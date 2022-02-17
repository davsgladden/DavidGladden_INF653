<?php 
	$newTitle = filter_input(INPUT_POST, "newTitle", FILTER_SANITIZE_STRING);
	$newDescription = filter_input(INPUT_POST, "newDescription", FILTER_SANITIZE_STRING);

	$title = filter_input(INPUT_GET, "title", FILTER_SANITIZE_STRING);
	$description = filter_input(INPUT_GET, "description", FILTER_SANITIZE_STRING);
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="UTF-8">
	<meta http-equix="X-UA-Compatible" content="IE=edge">
	<meta name="viewpoint" content="width=device-width, initial-scale-1.0">
	<title>ToDo List Assignment</title>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
<main>
	<header>

	</header>
	<?php { ?>
		<?php require("database.php") ?>
		<?php 
			if($newTitle && $newDescription){
				$query = 'Insert into todoitems (Title, Description)
						  Values (:title, :description)';
				$statement = $db->prepare($query);
				$statement->bindValue(':title', $newTitle);
				$statement->bindValue(':description', $newDescription);
				$statement->execute();
				$statement->closeCursor();
			}
		?>
		<?php 
			{
				$query = 'Select * from todoitems 
						  Order by ItemNum';
				$statement = $db->prepare($query);
				$statement->execute();
				$results = $statement->fetchAll();
				$statement->closeCursor();
			}
		?>
		<?php 
			if(!empty($results)) { ?>
				<section id="display">
					<h2>ToDo List</h2>
					<?php foreach($results as $result) {
						$id = $result["ItemNum"];
						$title = $result["Title"];
						$description = $result["Description"];
					?>
					<ul>
					<fieldset>
						<input type="hidden" name="id" value="<?php echo $id ?>">
						<form class="delete" action="delete_record.php" method="POST">
							<label id="title" name="title"><?php echo $title?></label><br>
							<label id="description" name="description"><?php echo $description?></label>
							<input type="hidden" name="id" value="<?php echo $id ?>">
							<button id="delete" class="red">X</button>
						</form>
						
						</fieldset>
					</ul>
					


					<?php } ?>
				</section>
			<?php } else { ?>
				<p>No to do list items exist. You're all caught up!</p><br><br>
			<?php } ?>
		<section id="add">
			<h2>Add Item</h2>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
				<fieldset>
				<input type="text" id="newTitle" name="newTitle" placeholder="Title:" required>
				<br>
				<input type="text" id="newDescription" name="newDescription" placeholder="Description:" required>			
				<button>Add Item</button>
				</fieldset>
				<br>
			</form>
			<br>
		</section>
	<?php } ?>
</main>
</body>
</html>
