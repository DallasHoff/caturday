<?php 

/*

Dallas Hoffman
Feb. 4, 2021
Lab - Attacking Authentication

The password abc123 only took a couple of seconds 
to brute force since it is one of the top
most used passwords.

To make brute forcing the password much more difficult, 
I changed the password to !X9yLVgDaR5Nx%v%&e and hashed 
it. A strong password like this is virtually impossible 
to guess quickly, making it very resilient against brute 
forcing. Hashing it helps defend against insider attacks 
and timing attacks.

I also made it so that the request sleeps for about 
half a second if the login is not successful. This 
makes brute forcing it much slower without really 
affecting regular users.

*/

$login = False;
$username = "";
$password = "";

$passwordHash = '$2y$10$OQ9J8BSCbQPmGc62Obl.Jeusw/EGTc8WoT6yaJEFfArydZ4GAwPou'; // Password hash should be stored and fetched from database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = $_POST['username'];
	$password = $_POST['password'];
	if ($username === 'ansible' && password_verify($password, $passwordHash) === true) {
		$login = True;
	} else {
		usleep(600000); // Sleep for 600 ms
	}
}

?>
<!doctype html>
<html lang="en-US">
	<head>
		<title>Login page</title>
		<meta name="description" content="Login page">
		<meta name="author" content="Russell Thackston">
		
		<style>
			body {
			  background-color: linen;
			  padding: 10px;
			}

			fieldset{
				max-width: 300px;
				border-radius: 10px;
			}
			
			label{
				width: 75px;
				display: inline-block;
				padding: 5px;
			}
		</style>
		
	</head>
	<body>
		<?php if ($login) { ?>
			<div>
				Login successful.
			</div>
		<?php } ?>
		<form action="index.php" method="post">
			<fieldset>
				<legend>Login</legend>
				<label for="username">Username</label>
				<input name="username" id="username" type="text" value="<?php echo $username; ?>">
				<br>
				<label for="password">Password</label>
				<input name="password" id="password" type="password" value="<?php echo $password; ?>">
				<br>
				<input type="submit" value="Login">
			</fieldset>
		</form>
	</body>
</html>