<?php include('includes/init.php');
  $current_page_id="index";

  if (isset($_POST["logout"])) {
    log_out();
  }

  if (isset($_GET["search"])) {
    $tag = filter_input(INPUT_GET, 'tags', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM tag_photo INNER JOIN tags ON tag_photo.tag_id = tags.id
    INNER JOIN photos ON photos.id = tag_photo.photo_id WHERE tags.tag_name = :tag";
    $params = array(
      ':tag' => $tag
    );
    global $search_results;
    $search_results = exec_sql_query($db, $sql, $params);
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Home - <?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" type="text/css" href="styles/all.css" media="all"/>
  </head>

  <body>
    <?php
    if ($current_user) {
        include("includes/header.php");
        echo "<form class=\"logout\" method=\"post\" action=\"index.php\">";
        echo "<input class=\"logout_button\" type=\"submit\" name=\"logout\" value=\"logout\"/>";
        echo "</form>";
    } else {
        echo "<h1 id=\"title\">".$title."</h1>";
    }
    ?>
    <?php
    if ($current_user == NULL) {
    echo "<h2>Login</h2>";
      echo "<form class=\"login\" method=\"post\" action=\"index.php\">";
        echo "<fieldset>";
          echo "<legend>Log in</legend>";
          echo "<ul>";
            echo "<li class=\"find\">";
              echo "Username:";
              echo "<input type=\"text\" name=\"username\" maxlength=\"30\" required/>";
            echo "</li>";
            echo "<li class=\"find\">";
              echo "Password:";
              echo "<input type=\"password\" name=\"password\" maxlength=\"30\" required/>";
            echo "</li>";
          echo "</ul>";
          echo "<input class=\"login_button\" type=\"submit\" name=\"login\" value=\"login\"/>";
        echo "</fieldset>";
      echo "</form>";
    }
     ?>
     <form id = "search" action ="index.php" method="get">
       <select name="tags">
         <option value="" selected disabled>Search By Tag</option>
         <?php
         $sql = "SELECT * FROM tags";
         $params = array();
         $tags = exec_sql_query($db, $sql, $params) -> fetchAll();
         if (isset($tags) and !empty($tags)) {
           foreach ($tags as $tag) {
             ?>
             <option value = "<?php echo htmlspecialchars($tag['tag_name']);?>"><?php
             echo htmlspecialchars($tag['tag_name']);?></option>
             <?php
           }
         }
         ?>
       </select>
       <button type = "submit" name = "search">Search</button>
     </form>
     <?php
      if (isset($search_results) and !empty($search_results)) {
        ?>
      <h2>Search Results</h2>
        <?php
        foreach($search_results as $search_result) {
          display_image($search_result);
        }
      } else {
        ?>
      <h2>Whole Gallery</h2>
      <?php
        $sql = "SELECT * FROM photos";
        $params = array();

        $records = exec_sql_query($db, $sql, $params) -> fetchAll();
        if (isset($records) and !empty($records)) {
          foreach($records as $record) {
            //var_dump($records);
            display_image($record);
          }
        }
      }

        if (isset($_POST["delete"])) {
        $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $image_id = substr($url, strpos($url, "?") + 1);
        delete_image($image_id);
        echo "<meta http-equiv='refresh' content='0'>";

      }

      function delete_image($image_id) {
        global $db;
        $sql = "DELETE FROM tag_photo WHERE photo_id = :image_id";
        $params = array(
          ':image_id' => $image_id
        );
        exec_sql_query($db, $sql, $params);
        $sql = "DELETE FROM photos WHERE id = :image_id";
        $params = array(
          ':image_id' => $image_id
        );
        exec_sql_query($db, $sql, $params);
      }
      ?>
    </body>
</html>
