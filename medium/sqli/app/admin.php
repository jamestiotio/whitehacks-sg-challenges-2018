<?php
	session_start();

	if (!isset($_SESSION['isAuthenticated']) || !$_SESSION['isAuthenticated']) {
		header('Location: index.php');
	}
?>
<html>
	<body>
		<center>
			<h1>Super Secret Admin Page</h1>
			<a href="logout.php">Logout</a>
		</center>
	</body>
</html>