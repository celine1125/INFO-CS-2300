<?php
$db = new PDO('sqlite:data.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function exec_sql_query($db, $sql, $params) {
  $query = $db->prepare($sql);
  if ($query and $query->execute($params)) {
    return $query;
  }
  return NULL;
}

$message = array();

if (isset($_GET['search'])) {
  if (isset($_GET['title'])) {
    $search_title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_STRING);
    $search_title = trim($search_title);
  }
  if (isset($_GET['year'])) {
    $search_year = filter_input(INPUT_GET, 'year', FILTER_SANITIZE_NUMBER_INT);
    $search_year = trim($search_year);
  }
  if (isset($_GET['rate'])) {
    $search_rate = filter_input(INPUT_GET, 'rate', FILTER_VALIDATE_FLOAT);
    $search_rate = trim($search_rate);
  }
  if ($search_title || $search_year || $search_rate) {
    $do_search = TRUE;
  } else {
      array_push($message, 'No input for search, all records return.');
      $do_search = FALSE;
  }
} else {
    $do_search = FALSE;
    $search_title = NULL;
    $search_year = NULL;
    $search_rate = NULL;
}

  if (isset($_POST['insert'])) {
    $title = filter_input(INPUT_POST, 'insertTitle', FILTER_SANITIZE_STRING);
    $rating = filter_input(INPUT_POST,'rating', FILTER_SANITIZE_NUMBER_FLOAT);
    $rating = trim($rating);
    $release_date = filter_input(INPUT_POST, 'insertYear', FILTER_SANITIZE_NUMBER_INT);
    $release_date = trim($release_date);
    $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING);
    $number_of_ratings = filter_input(INPUT_POST, 'numOfRatings', FILTER_SANITIZE_NUMBER_INT);
    $number_of_ratings = trim($number_of_ratings);

    $invalid_review = FALSE;
    if ($rating < 0 || $rating > 10) {
      $invalid_review = TRUE;
    }
    if ($release_date < 1800 || $release_date > 2018) {
      $invalid_review = TRUE;
    }

    if ($invalid_review) {
      array_push($message, 'Fail to add review. Invalid rating or release year.');
    } else {
      $sql = 'INSERT INTO top_rated_movies (title, rating, release_date, genre,
        number_of_ratings) VALUES (:title, :rating, :release_date, :genre,
        :number_of_ratings)';
      $params = array(
        ':title' => $title,
        ':rating' => $rating,
        ':release_date' => $release_date,
        ':genre' => $genre,
        ':number_of_ratings' => $number_of_ratings
      );

      $result = exec_sql_query($db, $sql, $params);
      if ($result) {
        array_push($message, "The movie you inserted has been record. Thank you!");
      } else {
        array_push($message, "Failed to add movie.");
      }
    }
  }
  function print_record($record) {
    ?>
    <tr>
      <td><?php echo htmlspecialchars($record['title']);?></td>
      <td><?php echo htmlspecialchars($record['rating'])?></td>
      <td><?php echo htmlspecialchars($record['release_date'])?></td>
      <td><?php echo htmlspecialchars($record['genre'])?></td>
      <td><?php echo htmlspecialchars($record['number_of_ratings'])?></td>
    </tr>
    <?php
  }
  ?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
    <title>Top Rated Movies</title>
  </head>

  <body>
    <h1>Top Rated Movies</h1>
      <?php
        foreach ($message as $element) {
          echo "<p><strong>".htmlspecialchars($element)."</strong></p>\n";
        }
      ?>
    <h2>Search</h2>
    <form id="search" method="get" action="index.php">
      <fieldset>
        <legend>The moive you are looking for</legend>
        <ul>
        <li class="find">
          Title:
          <input type="text" name="title" maxlength="80" placeholder="the movie's name"/>
        </li>
        <li class="find">
          Year Before:
          <input type="number" name="year" min="1954" placeholder="from 1954..."/>
        </li>
        <li class="find">
          Rating Above:
          <input type="number" name="rate" min="0.0" max="9.2" step="0.1" placeholder="under 9.3"/>
        </li>
      </ul>
        <input id="submit_button" type="submit" name="search" value="Search"/>
      </fieldset>
    </form>

    <?php
    if ($do_search) {
      ?>
      <h2>Search Results</h2>
      <?php

      if ($search_title and $search_year and $search_rate) {
        $sql = "SELECT * FROM top_rated_movies WHERE
        title LIKE'%'||:title||'%' AND
        release_date < :release_date AND
        rating >:rating
        ORDER BY rating DESC";
        $params = array(
          ':title' => $search_title,
          ':release_date' => $search_year,
          ':rating' => $search_rate
        );
      } else if ($search_title and $search_year) {
        $sql = "SELECT * FROM top_rated_movies WHERE
        title LIKE'%'||:title||'%' AND
        release_date < :release_date
        ORDER BY rating DESC";
        $params = array(
          ':title' => $search_title,
          ':release_date' => $search_year
        );
      } else if ($search_title and $search_rate) {
        $sql = "SELECT * FROM top_rated_movies WHERE
        title LIKE'%'||:title||'%' AND
        rating > :rating
        ORDER BY rating DESC";
        $params = array(
          ':title' => $search_title,
          ':rating' => $search_rate
        );
      } else if ($search_year and $search_rate) {
        $sql = "SELECT * FROM top_rated_movies WHERE
        release_date < :release_date AND
        rating >:rating
        ORDER BY rating DESC";
        $params = array(
          ':release_date' => $search_year,
          ':rating' => $search_rate
        );
      } else if ($search_title) {
        $sql = "SELECT * FROM top_rated_movies WHERE
        title LIKE'%'||:title||'%'
        ORDER BY rating DESC";
        $params = array(
          ':title' => $search_title
        );
      } else if ($search_year) {
        $sql = "SELECT * FROM top_rated_movies WHERE
        release_date < :release_date
        ORDER BY rating DESC";
        $params = array(
          ':release_date' => $search_year
        );
      } else if ($search_rate) {
        $sql = "SELECT * FROM top_rated_movies WHERE
        rating > :rating
        ORDER BY rating DESC";
        $params = array(
          ':rating' => $search_rate
        );
      }
    } else {
      ?>
      <h2>All the Movies</h2>
      <?php

      $sql = 'SELECT * FROM top_rated_movies ORDER BY rating DESC';
      $params = array();
    }

    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if (isset($records) and !empty($records)) {
      ?>
      <table>
        <tr>
          <th>Title</th>
          <th>Rating</th>
          <th>Release Year</th>
          <th>Genre</th>
          <th>Number of Ratings</th>
        </tr>
      <?php
      foreach($records as $record) {
        print_record($record);
      }
      ?>
    </table>
    <?php
  } else {
    echo '<p>No Record.</p>';
  }
    ?>

    <h2>Insert Movie</h2>
    <form id="insert" method="post" action="index.php">
      <fieldset>
        <legend>Insert movie record</legend>
        <ul>
        <li class="find">
          Title (required):
          <input type="text" name="insertTitle" placeholder="the movie's name"
           maxlength="80" required/>
        </li>
        <li class="find">
          Rating (required):
          <input type="number" name="rating" required/>
        </li>
        <li class="find">
          Release Date (required):
          <input type="number" name="insertYear" required/>
        </li>
        <li class="find">
          Genre:
          <input type="text" name="genre" maxlength="50"/>
        </li>
        <li class="find">
          Number of Ratings:
          <input type="number" name="numOfRatings"/>
        </li>
      </ul>
        <input id="insert_button" type="submit" name="insert" value="Insert"/>
      </fieldset>
    </form>
    <p id="data_source">Data source:IMDb Top Rated Movies</p>
    <a href="http://www.imdb.com/chart/top?ref_=nv_mv_250_6">
        Source Link</a>
  </body>
</html>
