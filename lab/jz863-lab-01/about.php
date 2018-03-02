<?php
include("includes/init.php");
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <script type="text/javascript" src="scripts/jquery-3.2.1.js"></script>
  <script type="text/javascript" src="scripts/site.js"></script>
  <title>About - <?php echo $title;?></title>
</head>

<body>
  <?php include("includes/header.php"); ?>

  <div id="content-wrap">
    <article id="content">
      <h1>Course Resources</h1>

      <ul>
        <li><a href="https://github.coecis.cornell.edu/info2300-sp2018/info2300-documents">Course Web Site</a></li>
        <li><a href="https://piazza.com/cornell/spring2018/infocs2300">Discussion Q & A</a></li>
        <li><a href="https://cmsx.cs.cornell.edu">Grades</a></li>
      </ul>
    </article>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
