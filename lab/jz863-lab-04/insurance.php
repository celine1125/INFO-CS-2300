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
              <input type="text" name="first_name" required/>
            </li>
            <li class="app_order">
              Last Name:
              <input type="text" name="last_name" required/>
            </li>
            <li class="app_note">Please put in a valid email address</li>
            <li class="app_order">
              Email Address:
              <input type="email" name="email" required/>
            </li>
            <li class="app_note">Please put in the mm/dd/yyyy format</li>
            <li class="app_order">
              Date of Birth:
              <input type="text" name="dob" required/>
            </li>
            <li class="app_note">Please put in the (xxx) xxx-xxxx format</li>
            <li class="app_order">
              Phone Number:
              <input type="text" name="phone_number" required/>
            </li>
            <li class="app_note">Please put in a number, if none, put in 0</li>
            <li class="app_order">
              Number of Dependents:
              <input type="number" name="dependents" required/>
            </li>
            <li class="app_note">Please choose from Basic, Full, and Premium</li>
            <li class="app_order">
              Coverage Plan:
              <input type="text" name="coverage" required>
            </li>
            <li class="app_order">
              Current Deductible Rate:
              <input type="text" name="deductible" required/>
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
