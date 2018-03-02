<?php
include("includes/init.php");

// declare the current location, utilized in header.php
$current_page_id="insurance";

// enrollment form data
if (isset($_GET["submit"])) {
  $name = $_REQUEST["name"];
  $email = $_REQUEST["email"];
  $dob = $_REQUEST["dob"];
  $phone_number = $_REQUEST["phone_number"];
  $dependents = $_REQUEST["dependents"];
  $coverage = $_REQUEST["coverage"];
  $deductible = $_REQUEST["deductible"];
}
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
      <h1 id="article-title">Insurance Application Submission</h1>
      <?php
      $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
      $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
      ?>
      <h2>Application for <?php echo(htmlspecialchars($first_name)." ".htmlspecialchars($last_name)); ?></h2>

      <p>
        <?php
        $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
        $dob = filter_input(INPUT_POST,'dob', FILTER_SANITIZE_STRING);
        $phone_number = filter_input(INPUT_POST,'phone_number', FILTER_SANITIZE_STRING);
        $dependents = filter_input(INPUT_POST,'dependents', FILTER_VALIDATE_INT);
        if ($dependents < 0) {
          $dependents = NULL;
        }
        $coverage = filter_input(INPUT_POST,'coverage', FILTER_SANITIZE_STRING);
        if (!($coverage == 'Basic' || $coverage == 'Full' || $coverage == 'Premium')) {
          $coverage = NULL;
        }
        $deductible = filter_input(INPUT_POST,'deductible',FILTER_VALIDATE_FLOAT);
        if ($deductible < 0) {
          $deductible = NULL;
        }
        echo("<h4>Email Address: " . filter_var($email, FILTER_VALIDATE_EMAIL). "</h4>");
        echo("<h4>Date of Birth: " . htmlspecialchars($dob) . "</h4>");
        echo("<h4>Phone Number: " . htmlspecialchars($phone_number) . "</h4>");
        echo("<h4>Number of Dependents: " . filter_var($dependents, FILTER_VALIDATE_INT) . "</h4>");
        echo("<h4>Coverage Plan: " . htmlspecialchars($coverage) . "</h4>");
        echo("<h4>Current Deductible Rate: " . filter_var($deductible, FILTER_VALIDATE_FLOAT)."%". "</h4>");
        ?>
      </p>

    </article>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
