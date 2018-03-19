<?php
	/*
		CREATE TABLE IF NOT EXISTS `user` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `username` varchar(100) NOT NULL,
		  `password` varchar(100) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

		INSERT INTO `user` (`id`, `username`, `password`) VALUES
		(1, 'admin', 'password'),
		(2, 'root', 'password');
	*/

	session_start();
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = 'mysql';
	$db_name = 'vuln';

	if (!isset($_SESSION)) {
		$_SESSION = array();
	}

	if (isset($_SESSION['isAuthenticated']) && $_SESSION['isAuthenticated']) {
		header('Location: admin.php');
	}

	if (isset($_POST['username']) && isset($_POST['password'])) {
		$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die('Could not connect to mysql server.');
        $username = preg_replace("/'/", "\\'", $_POST['username']);
        $password = preg_replace("/'/", "\\'", $_POST['password']);
        $result = mysqli_query($link, "SELECT 1 FROM `user` WHERE `username` = '{$username}' AND `password` = '{$password}'");
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['isAuthenticated'] = true;
            header('Location: admin.php');
        }
        mysqli_free_result($result);
		mysqli_close($link);
	}
?>
<html>
	<body>
		<center>
			<form method="post" action="">
				<h1>Login</h1>
				<p>Username: <input type="text" name="username"></p>
				<p>Password: <input type="password" name="password"></p>
				<p><input type="submit"></p>
			</form>
		</center>
	</body>
</html>