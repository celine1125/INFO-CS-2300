<?php
include("includes/init.php");

// declare the current location, utilized in header.php
$current_page_id="insurance";

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Insurance - <?php echo $title;?></title>
</head>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <article id="content">
      <h1 id="article-title">2300 Insurance Company</h1>
      <p>Welcome to the 2300 Insurance Company!</p>

      <h2>2300 Insurance Plan Application</h2>

      <form id="insurance_form" method="post" action="submit.php">
        <fieldset>
          <legend>Insurance Application 2018</legend>

          <ul>
            <li class="app_order">
              First Name:
              <input type="text" name="first_name" placeholder="First Name"required/>
            </li>
            <li class="app_order">
              Last Name:
              <input type="text" name="last_name" placeholder="Last Name" required/>
            </li>
            <li class="app_order">
              Email Address:
              <input type="text" name="email" required/>
            </li>
            <li class="app_order">
              Date of Birth:
              <input type="date" name="dob" min="1900-01-01" required/>
            </li>
            <li class="app_order">
              Phone Number:
              <input type="text" name="phone_number" required/>
            </li>
            <li class="app_order">
              Number of Dependents:
              <input type="number" name="dependents" min="0" max="50" required/>
            </li>
            <li class="app_order">
              Coverage Plan:
              <select name="coverage" required>
                <option value="" selected disabled>Choose Your Plan</option>
                <option value="Basic">Basic Coverage</option>
                <option value="Full">Full Coverage</option>
                <option value="Premium">Premium Coverage</option>
              </select>
            </li>
            <li class="app_order">
              Deductible Rate:
              <input type="float" name="deductible" min="0" max="100" required/>
            </li>
          </ul>

          <input id="app_button" type="submit" name="submit" value="Submit Application"/>
        </fieldset>
      </form>

    </article>
  </div>
  <?php include("includes/footer.php");?>
</body>

</html>
