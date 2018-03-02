<?php
include("includes/init.php");

// declare the current location, utilized in header.php
$current_page_id="zoo";

if ( isset($_REQUEST["animal"]) ) {
  $in_zoo = htmlspecialchars($_REQUEST["animal"]);

  // Convert string to lowercase since all our animals are stored in lower case.
  $in_zoo = strtolower( $in_zoo );
}

$zoo_animals = array("tiger", "monkey", "snake");

function check_in_zoo($zoo_animals, $animal) {
  foreach($zoo_animals as $a) {
    if ($a == $animal) {
      return TRUE;
    }
  }
  return FALSE;
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Zoo - <?php echo $title;?></title>
</head>

<body>
  <?php include("includes/header.php"); ?>

  <div id="content-wrap">
    <h2>The Cornell Zoo</h2>
    <?php
    if ( isset($in_zoo) ) {
      if (check_in_zoo($zoo_animals, $in_zoo)) {
        echo "<p>" . $in_zoo . " is in zoo.</p>";
        echo "<p><img class=\"small\" src=\"images/" . $in_zoo . ".svg\"/></p>";
      } else {
        echo "<p>" . $in_zoo . " is <strong>not</strong> in zoo.</p>";
      }
      echo "<hr/>";
    }
    ?>

    <p>Check to see if the animal you want to see is in our zoo!</p>
    <form id="animalForm" action="zoo.php" method="get">
      <div>
        <label for="animal">Animal:</label>
        <input type="text" name="animal" required/>
      </div>

      <button type="submit">Check</button>
    </form>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
