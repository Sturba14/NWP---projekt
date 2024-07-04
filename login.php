<?php 
	print '
	<h1>Prijava</h1>
	<div id="login">';
	
	if ($_POST['_action_'] == FALSE) {
		print '
		<form action="" name="myForm" id="myForm" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">

			<label for="username">Korisničko ime *</label>
			<input type="text" id="username" name="username" value="" " required>
									
			<label for="password">Lozinka *</label>
			<input type="password" id="password" name="password" value="" " required>				
			<input type="submit" value="Prijavi se">
			<br>
		</form>';

	}
	else if ($_POST['_action_'] == TRUE) {		
		$query  = "SELECT * FROM users";
		$query .= " WHERE username='" .  $_POST['username'] . "'";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if (password_verify($_POST['password'], $row['password'])) {
			$_SESSION['user']['valid'] = 'true';
			$_SESSION['user']['id'] = $row['id'];
			$_SESSION['user']['role'] = $row['role'];
			$_SESSION['user']['firstname'] = $row['firstname'];
			$_SESSION['user']['lastname'] = $row['lastname'];
			$_SESSION['message'] = '<p>Dobrodošao, ' . $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] . '</p>';
			header("Location: index.php?menu=8");
		}
		else {
			unset($_SESSION['user']);
			$_SESSION['message'] = '<p>Unijeli ste krivo korisničko ime ili lozinku!</p>';
			header("Location: index.php?menu=7");
		}
	}
	print '
	</div>';
?>