<?php
  $hostname = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
  $page = 'home.php';
  if (isset($_GET['page'])) {
      $page = $_GET['page'];
  }

  // Enforce HTTPS
  // $use_sts = TRUE;
  // if ($use_sts && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    // header('Strict-Transport-Security: max-age=3600');
  // } elseif ($use_sts && (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on')) {
    // header('Status-Code: 301');
    // header('Location: https://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);
  // }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--link rel="shortcut icon" href="../../docs-assets/ico/favicon.png"-->

    <title>ReCon | ReCon.sg</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="style.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">ReCon | ReCon.sg</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li <?php if ($page === 'home.php') echo 'class="active"'; ?>><a href="?page=home.php">Home</a></li>
            <li <?php if ($page === 'programme.php') echo 'class="active"'; ?>><a href="?page=programme.php">Programme</a></li>
            <li <?php if ($page === 'categories.php') echo 'class="active"'; ?>><a href="?page=categories.php">Categories</a></li>
            <li <?php if ($page === 'aboutus.php') echo 'class="active"'; ?>><a href="?page=aboutus.php">About Us</a></li>
            <li <?php if ($page === 'register.php') echo 'class="active"'; ?>><a href="?page=register.php">Register</a></li>
            <li <?php if ($page === 'contactus.php') echo 'class="active"'; ?>><a href="?page=contactus.php">Contact Us</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
      <div class="content">

            <?php 
                define('__ROOT__', dirname(__FILE__)); 
                include_once(__ROOT__ . "/$page");
            ?>

            <div id="sidebar" class="col-md-4">
                <h3>Spread the Word!</h3>
                <ul>
                    <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $hostname; ?>">Facebook</a></li>
                    <li><a href="https://twitter.com/share" class="twitter-share-button">Tweet</a></li>
                    <li><div class="g-plus" data-action="share"></div></li>
                </ul>
                <h3>Our Sponsors</h3>
                <ul>
                    <li><a target="_blank" href="#"><img src="Whitehats_Logo.png" /></a></li>
                    <li><a target="_blank" href="#">My Sponsor</a></li>
                    <li><a target="_blank" href="#">My Sponsor</a></li>
                </ul>
            </div>
        </div>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js" defer async></script>
  </body>
</html>