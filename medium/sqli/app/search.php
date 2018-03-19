<?php
	/*
		CREATE TABLE IF NOT EXISTS `product` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `type` varchar(100) NOT NULL,
		  `brand` varchar(100) NOT NULL,
		  `name` varchar(100) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

		INSERT INTO `product` (`id`, `type`, `brand`, `name`) VALUES
		(1, 'Car', 'Honda', 'Civic'),
		(2, 'Bread', 'Gardenia', 'White Bread'),
		(3, 'Bread', 'Gardenia', 'Wholemeal Bread');
	*/

	session_start();
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = 'mysql';
	$db_name = 'vuln';

	$search_listing = array();

	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die('Could not connect to mysql server.');
    $search_query = isset($_GET['search']) ? $_GET['search'] : '';

    $result = mysqli_query($link, "SELECT `type`, `brand`, `name` FROM `product` WHERE `type` LIKE '%{$search_query}%' OR `brand` LIKE '%{$search_query}%' OR `name` LIKE '%{$search_query}%'");
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $search_listing[] = array(
                'type' => $row['type'],
                'brand' => $row['brand'],
                'name' => $row['name']
            );
        }
    }
	if ($result) {
		mysqli_free_result($result);
	}
	mysqli_close($link);
?>
<html>
	<body>
		<center>
			<form method="get" action="">
				<p>
					Search: <input type="text" name="search">
					<input type="submit">
				</p>
			</form>
			<table border="1">
				<tr>
					<th>Type</th>
					<th>Brand</th>
					<th>Name</th>
				</tr>
				<?php foreach($search_listing as $search_item): ?>
					<tr>
						<td><?php echo $search_item['type']; ?></td>
						<td><?php echo $search_item['brand']; ?></td>
						<td><?php echo $search_item['name']; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</center>
	</body>
</html>