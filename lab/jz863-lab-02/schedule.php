<?php
include("includes/init.php");
// 1.create an array store the day of a week and an another array store the event info.
// 2.using the foreach loop, echo the <th> in the table.
// 3.if the day in array has an event, then change the <td> of the table
?>
<?php
  $current_page_id = "schedule";
  $days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday"
            , "Saturday");
  $event = array("Lecture (9:05AM - 9:55AM)", "Lab (12:20PM - 1:10PM)");
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
      <table>
        <!-- <tr>
          <th>Sunday</th>
          <th>Monday</th>
          <th>Tuesday</th>
          <th>Wednesday</th>
          <th>Thursday</th>
          <th>Friday</th>
          <th>Saturday</th>
        </tr> -->
        <?php
          echo "<tr>";
          $count = 0;
          $color1 = "#A2DDFC";
          $color2 = "#2E88B4";
          foreach($days as $day) {
            if ($count % 2 == 0) {
              echo "<th style = background-color:$color1;>";
            } else {
              echo "<th style = background-color:$color2;>";
            }
            echo "$day</th>";
            $count++;
          }

          echo "</tr>";
        ?>

        <!-- <tr>
          <td></td>
          <td></td>
          <td>Lecture (9:05AM - 9:55AM)</td>
          <td></td>
          <td>Lecture (9:05AM - 9:55AM)</td>
          <td>Lab (12:20PM - 1:10PM)</td>
          <td></td>
        </tr> -->
        <?php
          echo "<tr>";
          foreach($days as $day) {
            if ($day == "Tuesday" || $day == "Thursday") {
              echo "<td>$event[0]</td>";
            } elseif ($day == "Friday") {
              echo "<td>$event[1]</td>";
            } else {
              echo "<td></td>";
            }
          }
          echo "</tr>";
        ?>
      </table>

    </article>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
