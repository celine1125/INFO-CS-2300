<?php
include("includes/init.php");

// declare the current location, utilized in header.php
$current_page_id="flowershop";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="scripts/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="scripts/slideshow.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Flower Shop - <?php echo $title;?></title>
</head>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <article id="content">
      <h1 id="article-title">2300 Flower Shop</h1>
      <p>Welcome to the 2300 Flower Shop!</p>

      <div>
        <h2>Flower Samples</h2>
        <img id="current_img" alt="Baby's Breaths" src="images/babys_breaths.jpg" />
        <!--Images from 1-800-flowers, Gardenerdy and Bloomsbythebox-->
        <span id="caption">Baby's Breaths</span>
        <button class="button" type="button" id="change">Next Sample</button>
      </div>

      <h2>Order Form</h2>
      <p>Each stem is $3.</p>

      <form id="flower_order" method="post" action="flower_order.php">
        <fieldset>
          <legend>Flower Stem Order Form</legend>

          <span id="order_note">Note: Maximum of 100 stems per flower type.</span>

          <p>
            <label for="name_field">Name on Order:</label>
            <input id="name_field" type="text" name="order_name" required/>
          </p>

          <ul>
            <li class="order">
              Red Roses:
              <input type="number" name="red_roses" min="0" max="100" value="0"/>
            </li>
            <li class="order">
              White Roses:
              <input type="number" name="white_roses" min="0" max="100" value="0"/>
            </li>
            <li class="order">
              Gardenias:
              <input type="number" name="gardenias" min="0" max="100" value="0"/>
            </li>
            <li class="order">
              Tulips:
              <input type="number" name="tulips" min="0" max="100" value="0"/>
            </li>
            <li class="order">
              Buttercups:
              <input type="number" name="buttercups" min="0" max="100" value="0"/>
            </li>
            <li class="order">
              Peonies:
              <input type="number" name="peonies" min="0" max="100" value="0"/>
            </li>
            <li class="order">
              Carnations:
              <input type="number" name="carnations" min="0" max="100" value="0"/>
            </li>
            <li class="order">
              Hydrangeas:
              <input type="number" name="hydrangeas" min="0" max="100" value="0"/>
            </li>
            <li class="order">
              Orchids:
              <input type="number" name="orchids" min="0" max="100" value="0"/>
            </li>
            <li class="order">
              Baby's-breaths:
              <input type="number" name="babys_breaths" min="0" max="100" value="0"/>
            </li>
          </ul>

          <input type="submit" value="Place Order"/>
        </fieldset>
      </form>
    </article>
  </div>
  <?php include("includes/footer.php");?>
</body>

</html>
