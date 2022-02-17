<?php 
	require('database.php');

	$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

	if($id) {
		$query = 'Delete from todoitems
				  Where ItemNum = :id';
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id);
		$success = $statement->execute();
		$statement->closeCursor();
	}

	$deleted = true;

	include('index.php');
?>