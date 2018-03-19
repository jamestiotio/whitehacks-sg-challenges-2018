<?php
    $cmd = 'cat content.php # ';
    if (!isset($_COOKIE['cmd'])) {
        setcookie('cmd', $cmd);
    } else {
        $cmd = 'cat content.php # ' . $_COOKIE['cmd'];
        setcookie('cmd', $cmd);
    }
    
    echo shell_exec($cmd);
?>