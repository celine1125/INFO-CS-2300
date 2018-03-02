<?php
include("includes/init.php");
?>
<?php
  $current_page_id = "index";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Home - <?php echo $title;?></title>
</head>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <article id="content">
      <figure id="database">
        <!-- Image source: https://openclipart.org/detail/94723/database-symbol -->
        <img alt="Database" src="images/db.svg"/>
        <figcaption>
          <span class="citation">(source: <a href="https://openclipart.org/detail/94723/database-symbol">https://openclipart.org/detail/94723/database-symbol</a></span>)
        </figcaption>
      </figure>

      <h1 id="article-title">INFO/CS 2300; NBA 5301</h1>

      <p>This semester you'll author your front-end content in HTML, CSS, and Javascript. You'll author your back-end content in PHP.</p>

      <section>
        <h2>PHP</h2>

        <p>You're running PHP version: <strong><?php echo htmlspecialchars(phpversion());?></strong>.</p>
        <p><strong>If you're not running at least version 7.1, please ask a TA for help.</strong></p>
      </section>

      <section>
        <h2>SQLite</h2>

        <p>You'll also learn how to utilize databases to store data for your web pages. We'll be using the development database, SQLite for the first half of the semester.</p>
      </section>
    </article>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
