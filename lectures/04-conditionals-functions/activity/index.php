<?php

$filenames = array("images/bird.png", 'images/cat.png', 'images/dog.png');

function html_thumb($filename) {
  echo "<img src=\"" . $filename . "\" alt=\"animal\"/>";
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Image Gallery</title>
</head>

<body>

  <?php
  foreach($filenames as $image) {
    html_thumb($image);
  }
  ?>
  
</body>
</html>
