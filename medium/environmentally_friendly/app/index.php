<?php
    $flag = getenv('FLAG');
    if (!isset($flag) or empty($flag)) die('Missing flag!');

    if (isset($_GET['file']) and !empty($_GET['file'])) {
        $file = $_GET['file'];
        system("cat '$file'");
    }
?>
<html>
<head>
</head>
<body>
    <p>Allow me to read you a story:</p>
    <form method="GET">
        <input type="text" name="file">
        <input type="submit" value="Read">
    </form>
</body>
</html>