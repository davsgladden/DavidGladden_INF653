<?php
	#declare variables
	$greeting = "Hello, my name is ";
	

	
	$vote = "";


	if(isset($_GET["firstName"]) && isset($_GET["lastName"]) && isset($_GET["age"])) {
		$firstName = htmlspecialchars($_GET["firstName"]);
		$lastName = htmlspecialchars($_GET["lastName"]);
		$age = htmlspecialchars($_GET["age"]);

		#clean input parameters
		$firstName = filter_input(INPUT_GET, 'firstName', FILTER_SANITIZE_STRING);
		$lastName = filter_input(INPUT_GET, 'lastName', FILTER_SANITIZE_STRING);
		$age = filter_input(INPUT_GET, 'age', FILTER_SANITIZE_STRING);

		if(empty($firstName) || empty($lastName) || empty($age)) {
			$greeting = "You are missing some data. <br>Please add all GET parameters to the URL for testing.";
		} else if(!is_numeric($age) || floor($age) != $age) {
			$greeting = "Age is not an int. Please resubmit with an integer for age.";
			} else {
				#Set $vote to not if $age is less than 18
				if ($age < 18) {
					$vote = "not ";
				}

				#concat greeting and print
				$greeting .= "$firstName $lastName. <br>";
				$greeting .= "I am $age years old and I am $vote old enough to ".
							 "vote in the United States.";
			} 
	} else {
		$greeting = "You are missing a parameter. <br>Please add all GET parameters to the URL for testing.";
	}
 ?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale-1.0">
	<title>Get Parameter Assignment</title>
	<link rel="stylesheet" href="css/main.css">
</head>

<body>
	<header>
		<h1>Get Parameter Assignment</h1>
	</header>
	<main>
		<h2>
			<?php #Print greeting
				echo $greeting;
			?>
		<h2>
	</main>
	<footer>
		<h2>
			<?php
				#display current date
				echo "Current date: ". date("m/d/y");
			?>
		</h2>
	</footer>
</body>

</html>