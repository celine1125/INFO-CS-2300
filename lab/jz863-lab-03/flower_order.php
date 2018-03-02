<?php
include("includes/init.php");

// declare the current location, utilized in header.php
$current_page_id="flowershop";

$order_name = filter_input(INPUT_POST, 'order_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// Alternatively, you may also do this:
// $order_name = htmlspecialchars($_REQUEST["order_name"]);

$flower_params = array(
  'red_roses' => 'Red Roses',
  'white_roses' => 'White Roses',
  'gardenias' => 'Gardenias',
  'tulips' => 'Tulips',
  'buttercups' => 'Buttercups',
  'peonies' => 'Peonies',
  'carnations' => 'Carnations',
  'hydrangeas' => 'Hydrangeas',
  'orchids' => 'Orchids',
  'babys_breaths' => 'Baby\'s Breaths'
);

const MAX_FLOWERS = 100;
const PRICE_PER_STEM = 3.0;

// get an HTTP parameter for the flower order. Make sure it's an integer. If no
// value is given, default to 0.
function get_flower_parameter($param) {
  $num = filter_input(INPUT_POST, $param, FILTER_VALIDATE_INT);
  if ( !isset($num) ) {
    // No value was sent as a parameter. Default to 0.
    $num = 0;
  } elseif ( $num < 0 ) {
    // We can't have negative flowers.
    $num = 0;
  } elseif ( $num > MAX_FLOWERS ) {
    $num = MAX_FLOWERS;
  }
  return $num;
}

// Read the HTTP parameters for all the flower types and return them
// in an associative array with the key as the param name and the value as
// the order count.
function process_flower_params() {
  // Access global variable to process flower params.
  global $flower_params;

  // Keep track of the order in an associative array.
  $flower_order = array();

  // Check how many flowers were ordered for each parameter.
  foreach ($flower_params as $param => $name) {
    $num = get_flower_parameter($param);
    $flower_order[$param] = $num;
  }
  return $flower_order;
}
$order = process_flower_params();

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Flower Shop - <?php echo $title;?></title>
</head>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <article id="content">
      <h1 id="article-title">Flower Order Fulfillment Request</h1>

      <h2>Order for <?php echo($order_name); ?></h2>
      <ul>
        <!-- TODO -->
        <?php
          $flowers_order = process_flower_params();
          foreach($flowers_order as $flower => $num) {
            if($num != 0) {
              echo "<li>" . htmlspecialchars($flower_params[$flower]).": ".$num."</li>\n";
            }
          }
        ?>
      </ul>

      <h2>Discount</h2>
      <p>
        <!-- TODO -->
        <?php
        function discount() {
          $num_of_flowers = 0;
          $flowers_order = process_flower_params();
          foreach($flowers_order as $flower => $num) {
            $num_of_flowers = $num_of_flowers + $num;
          }
          if ($num_of_flowers < 50) {
            return No;
          } elseif ($num_of_flowers >= 50 && $num_of_flowers < 100) {
            return 5;
          } elseif ($num_of_flowers >= 100 && $num_of_flowers < 200) {
            return 10;
          } else {
            return 15;
          }
        }
          echo htmlspecialchars(discount())."% discont";
        ?>
      </p>

      <h2>Warehouse Collection</h2>
      <ol>
        <!-- TODO -->
        <?php
          $flowers_order = process_flower_params();
          if ($flowers_order["carnations"] != 0) {
            echo "<li>" . htmlspecialchars($flower_params["carnations"]).":" .htmlspecialchars($flowers_order["carnations"])."</li>\n";
          }
          if ($flowers_order["hydrangeas"] != 0) {
            echo "<li>" . htmlspecialchars($flower_params["hydrangeas"]).": ".htmlspecialchars($flowers_order["hydrangeas"])."</li>\n";
          }
          if ($flowers_order["gardenias"] != 0) {
            echo "<li>" . htmlspecialchars($flower_params["gardenias"]).": ".htmlspecialchars($flowers_order["gardenias"])."</li>\n";
          }
          if ($flowers_order["buttercups"] != 0) {
            echo "<li>" . htmlspecialchars($flower_params["buttercups"]).": ".htmlspecialchars($flowers_order["buttercups"])."</li>\n";
          }
          if ($flowers_order["tulips"] != 0) {
            echo "<li>" . htmlspecialchars($flower_params["tulips"]).": ".htmlspecialchars($flowers_order["tulips"])."</li>\n";
          }
          if ($flowers_order["red_roses"] != 0) {
            echo "<li>" . htmlspecialchars($flower_params["red_roses"]).": ".htmlspecialchars($flowers_order["red_roses"])."</li>\n";
          }
          if ($flowers_order["white_roses"] != 0) {
            echo "<li>" . htmlspecialchars($flower_params["white_roses"]).": ".htmlspecialchars($flowers_order["white_roses"])."</li>\n";
          }
          if ($flowers_order["babys_breaths"] != 0) {
            echo "<li>" . htmlspecialchars($flower_params["babys_breaths"]).": ".htmlspecialchars($flowers_order["babys_breaths"])."</li>\n";
          }
          if ($flowers_order["orchids"] != 0) {
            echo "<li>" . htmlspecialchars($flower_params["orchids"]).": ".htmlspecialchars($flowers_order["orchids"])."</li>\n";
          }
          if ($flowers_order["peonies"] != 0) {
            echo "<li>" . htmlspecialchars($flower_params["peonies"]).": ".htmlspecialchars($flowers_order["peonies"])."</li>\n";
          }
        ?>
      </ol>

      <h2>Invoice</h2>
      <p>
        <!-- TODO -->
        <?php
          $discount = discount();
          $num_of_flowers = 0;
          $flowers_order = process_flower_params();
          foreach($flowers_order as $flower => $num) {
            $num_of_flowers = $num_of_flowers + $num;
          }
          $total = (100-$discount)* $num_of_flowers*3/100;
          if ($total > 0) {
            echo "Total costs is $ ".htmlspecialchars($total).". Thank you for patronage!";
          }
        ?>
      </p>
    </article>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
