<?php
include("includes/init.php");

session_start();
$email = $_SESSION['email'];
unset($_SESSION['email']);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Mailing List - <?php echo $title;?></title>
</head>

<body>
  <?php include("includes/header.php"); ?>

  <div id="content-wrap">
    <article id="content">
      <h1 id="article-title">Mailing List Request</h1>

      <p><?php echo( htmlspecialchars($email) ); ?> has been successfully subscribed to our mailing.</p>
    </article>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
