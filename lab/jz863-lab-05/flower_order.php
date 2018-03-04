<?php
include("includes/init.php");

// declare the current location, utilized in header.php
$current_page_id="flowershop";

$order_name = filter_input(INPUT_POST, 'order_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// Alternatively, you may also do this:
// $order_name = htmlspecialchars($_REQUEST["order_name"]);

// In-lab demo of code injection
// $order_name = $_POST["order_name"];

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

function print_flower_li($param, $order) {
  global $flower_params;
  $name = $flower_params[$param];
  $count = $order[$param];

  // Don't display flowers that weren't ordered.
  if ($count > 0 ) {
    echo "<li class='collection'>" . $name . ": " . $count . "</li>";
  }
}

function total_stems($order) {
  global $flower_params;

  $total_stems = 0;
  foreach($flower_params as $param => $name) {
    $count = $order[$param];
    $total_stems = $total_stems + $count;
  }
  return $total_stems;
}
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
        <?php
        foreach($flower_params as $param => $name) {
          print_flower_li($param, $order);
        }
        ?>
      </ul>

      <h2>Discount</h2>
      <p>
        <?php
        $stems = total_stems($order);
        $discount_percent = 0.0;

        if ($stems < 50) {
          $discount_percent = 0.0;
        } elseif ($stems >= 50 && $stems < 100) {
          $discount_percent = 0.05;
        } elseif ($stems >= 100 && $stems < 200) {
          $discount_percent = 0.10;
        } else {
          $discount_percent = 0.15;
        }

        if ($discount_percent > 0.0) {
          echo ($discount_percent * 100) . "% discount.";
        } else {
          echo "No discount.";
        }
        ?>
      </p>

      <h2>Warehouse Collection</h2>
      <ol>
        <?php
        print_flower_li('carnations', $order);
        print_flower_li('hydrangeas', $order);
        print_flower_li('gardenias', $order);
        print_flower_li('buttercups', $order);
        print_flower_li('tulips', $order);
        print_flower_li('red_roses', $order);
        print_flower_li('white_roses', $order);
        print_flower_li('babys_breaths', $order);
        print_flower_li('orchids', $order);
        print_flower_li('peonies', $order);
        ?>
      </ol>


      <h2>Invoice</h2>
      <p>
        <?php
        $cost = $stems * PRICE_PER_STEM;
        $discount = $cost * $discount_percent;
        $total_cost = $cost - $discount;

        echo "Total cost is $" . $total_cost . ". Thank you for patronage!"
        ?>
      </p>
    </article>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
