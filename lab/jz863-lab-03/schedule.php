<?php
include("includes/init.php");

// declare the current location, utilized in header.php
$current_page_id="schedule";

// array for the days of the week
$days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

// function to create the schedule for a day
function print_schedule_for_day($day) {
  // $day is a key for $schedule

  // create an array of all the lectures and lab
  $schedule = array(
    "Tuesday" => "Lecture (9:05AM - 9:55AM)",
    "Thursday" => "Lecture (9:05AM - 9:55AM)",
    "Friday" => "Lab (12:20PM - 1:10PM)"
  );

  // print the schedule in a column for each day
  if ( isset($schedule[$day]) ) {
    $event = $schedule[$day];
  } else {
    $event = '';
  }
  echo "<td>" . $event . "</td>";
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Schedule - <?php echo $title;?></title>
</head>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <article id="content">
      <h1 id="article-title">Schedules</h1>

      <h2>Class Schedule</h2>
      <!-- create table for schedule -->
      <table>
        <!-- create a row for the days of the week -->
        <tr>
          <?php
          // put each day of the week in the table header
          foreach ($days as $day) {
            echo "<th>" . $day . "</th>";
          }
          ?>
        </tr>

        <!-- create a row of for the actual schedule -->
        <tr>
          <?php
          // function that prints the schedule for each day
          foreach ($days as $day) {
            print_schedule_for_day($day);
          }
          ?>
        </tr>
      </table>

      <h2>Class Schedule (Bonus)</h2>
      <!-- create table for schedule -->
      <table>
        <!-- create a row for the days of the week -->
        <tr>
          <?php
          // create a counter so we color every other column
          $counter = 0;
          // put each day of the week in the table header
          foreach ($days as $day) {
            // When the counter is even, so when the column is odd...
            if ( $counter % 2 == 0) {
              // make that column the darker blue
              echo "<th class='dark_col'>" . $day . "</th>";
            } else {
              // else make that column the lighter blue
              echo "<th class='light_col'>" . $day . "</th>";
            }
            // increase the counter so that we alternate
            $counter++;
          }
          ?>
        </tr>

        <!-- create a row of for the actual schedule -->
        <tr>
          <?php
          // function that prints the schedule for each day
          foreach($days as $day){
            print_schedule_for_day($day);
          }
          ?>
        </tr>
      </table>

    </article>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
