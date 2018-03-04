<?php

// The website's title
$title = "Lab 5 - INFO 2300";

// associative array mapping page 'id' to page title
$pages = array(
  "index" => "Home",
  "about" => "About",
  "standards" => "Standards",
  "schedule" => "Schedule",
  "zoo" => "Zoo",
  "flowershop" => "Flower Shop",
  "insurance" => "Insurance",
  "shoes" => "Shoes",
);

function handle_db_error($exception) {
  echo '<p><strong>' . htmlspecialchars('Exception : ' . $exception->getMessage()) . '</strong></p>';
}

?>
