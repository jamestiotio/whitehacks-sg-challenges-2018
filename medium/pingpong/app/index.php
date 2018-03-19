<?php // WHITEHACKS{1_p1nG_y0u_p0nG} ?>
<html>
    <body>
        <form method="GET" action="">
            <h1>Ping Pong!</h1>
            <p>Enter an IP Address to ping:</p>
            <input type="text" name="ip" placeholder="127.0.0.1" />
            <input type="submit" value="Submit" />
        </form>
        <div id="result">
        <?php if (isset($_GET['ip'])): ?>
            <pre><?php
                $ip = $_GET['ip'];
                $ip = substr($ip, 0, 8);  // Limit input
                system("ping -c4 $ip");
            ?></pre>
        <?php endif; ?>
        </div>
    </body>
</html>