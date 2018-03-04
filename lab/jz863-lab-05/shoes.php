<?php
include("includes/init.php");

// declare the current location, utilized in header.php
$current_page_id="shoes";

// open connection to database
// TODO: create $db variable by opening the database.
$db = new PDO('sqlite:shoes.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['product'])) {
  $product = filter_input(INPUT_GET, 'product', FILTER_SANITIZE_STRING);
} else {
  // No search provided, so set the product to query to NULL
  $product = NULL;
}
$header = NULL;

function get_db_records($db, $sql, $params) {
  $query = $db->prepare($sql);
  if ($query and $query->execute($params)) {
    $records = $query->fetchAll();
    return $records;
  }
  return NULL;
}

function get_review($product) {
  global $header;
  global $db;
  if ($product != NULL) {
    $header = "Review for".$product;
    $sql = "SELECT * FROM reviews WHERE product_name LIKE '%' || :product || '%';";
    $params = array(':product' => $product);
    $records = get_db_records($db, $sql, $params);
    return $records;

  } else {
    $header = "All Reviews";
    $sql = "SELECT * FROM reviews";
    $params = array();
    $records = get_db_records($db, $sql, $params);
    return $records;
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Shoe Review - <?php echo $title;?></title>
</head>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <h1>2300 Shoe Review</h1>

    <p>Welcome to the 2300 Shoe Review!</p>

    <ul>
      <li><a href="/shoes.php">all reviews</a></li>
      <li><a href="/shoes.php?product=Flyknit">reviews for Flyknit</a></li>
      <li><a href="/shoes.php?product=Air">reviews for Air</a></li>
      <li><a href="/shoes.php?product=Kick%20Jams">reviews for Kick Jams</a></li>
    </ul>

    <!-- TODO: execute SQL query -->
    <?php
      $records = get_review($product)
    ?>

    <table>
      <?php
      echo "<h2>".htmlspecialchars($header)."</h2>";
      if ($records == NULL) {
        echo "No reviews for".$product;
      } else {
        echo "<tr>";
          echo "<th>Reviewer</th>";
          echo "<th>Rating</th>";
          echo "<th>Product</th>";
          echo "<th>Comments</th>";
        echo "</tr>";
        foreach ($records as $record) {
          echo "<tr>";
            echo "<th>".htmlspecialchars($record['reviewer'])."</th>";
            echo "<th>".htmlspecialchars($record['rating'])."</th>";
            echo "<th>".htmlspecialchars($record['product_name'])."</th>";
            echo "<th>".htmlspecialchars($record['comment'])."</th>";
          echo "</tr>";
        }
      }
      ?>


      <!-- TODO: add rows to table -->

    </table>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
