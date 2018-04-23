<?php include('includes/init.php');
$tag_value;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <title>Image - <?php echo $title; ?></title>
</head>

<body>
  <?php
  $current_page_id = 'image';
  if ($current_user) {
      include("includes/header.php");
      echo "<form class=\"logout\" method=\"post\" action=\"index.php\">";
      echo "<input class=\"logout_button\" type=\"submit\" name=\"logout\" value=\"logout\"/>";
      echo "</form>";
  } else {
      echo "<h1 id=\"title\">".$title."</h1>";
      echo "<a id=\"visitor\" href='index.php'>Home</a>";
  }
  ?>
    <?php
    $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $image_path = substr($url, strpos($url, "?") + 1);
    $image_path = str_replace('\\', '', $image_path);
    $image_id = substr($image_path, 0, strpos($image_path, "."));
    global $db;
    $sql = "SELECT * FROM tag_photo INNER JOIN tags ON tags.id = tag_photo.tag_id WHERE photo_id = :image_id";
    $params = array(
      ":image_id" => $image_id
    );
    $tags = exec_sql_query($db, $sql, $params)->fetchAll();
    //echo htmlspecialchars($image_path);
    echo "<div class = \"holder\">";
    echo "<img class = \"photos\" alt=".htmlspecialchars($image_path)." src = \"uploads/photos/".htmlspecialchars($image_path)."\""."/>";
    echo "<ul>";
    foreach ($tags as $tag) {
      echo "<li>";
      echo htmlspecialchars($tag['tag_name']);
      echo "</li>";
    }
    echo "</ul>";
    $sql = "SELECT * FROM photos WHERE id = :image_id";
    $params = array(
      ':image_id' => $image_id
    );
    $record = exec_sql_query($db, $sql, $params) -> fetchAll();
    if ($record) {
      if ($record[0]['author_id'] == $author_id) {
        echo "<form id=\"del_img\" method=\"post\" action=\"index.php?$image_id\">";
        echo "<input id=\"del_img_button\" type=\"submit\" name=\"delete\" value=\"delete image\"/>";
        echo "</form>";
        $sql = "SELECT * FROM tags WHERE tags.id NOT IN
        (SELECT tag_id FROM tag_photo WHERE photo_id = :image_id)";
        $params = array(
          ':image_id' => $image_id
        );
        $tags = exec_sql_query($db, $sql, $params) -> fetchAll();
        ?>
        <h3>Add Tag</h3>
        <form id="add_tag" method="post" action="image.php?<?php echo htmlspecialchars($image_path);?>">
          <select name="tag_list">
            <?php
            foreach($tags as $tag) {
              ?>
              <option value= "<?php echo htmlspecialchars($tag['tag_name']); ?>">
            <?php echo htmlspecialchars($tag['tag_name']); ?></option>
            <?php
        }
        ?>
          <option value = "other">other</option>
        </select>
        <input type="text" name="add_new_tag" id="new_tag" placeholder="new tag" maxlength="30"/>
        <button type="submit" name="add">Add Tag</button>
        </form>

        <?php
        $sql = "SELECT * FROM tags WHERE tags.id IN
        (SELECT tag_id FROM tag_photo WHERE photo_id = :image_id)";
        $params = array(
          ':image_id' => $image_id
        );
        $tags = exec_sql_query($db, $sql, $params) -> fetchAll();
        ?>
        <h3>Delete Tag</h3>
        <form id="delete_tag" method="post" action="image.php?<?php echo htmlspecialchars($image_path);?>">
          <select name="delete_tag_list">
            <?php
            foreach($tags as $tag) {
              ?>
              <option value= "<?php echo htmlspecialchars($tag['tag_name']); ?>">
            <?php echo htmlspecialchars($tag['tag_name']); ?></option>
            <?php
        }
        ?>
      </select>
        <button type="submit" name="delete_tag">Delete Tag</button>
        </form>
        <?php
      }
      echo "</div>";
    }
    ?>

    <?php
    if (isset($_POST["add"])) {
      global $db;
      $tag_value = filter_input(INPUT_POST, 'tag_list', FILTER_SANITIZE_STRING);
      if ($tag_value != "other") {
        $sql = "SELECT * FROM tags WHERE tag_name = :tag_name";
        $params = array(
          ":tag_name" => $tag_value
        );
        $add_tag_id = exec_sql_query($db, $sql, $params)->fetchAll();
        //var_dump($add_tag_id);
        $sql = "INSERT INTO tag_photo(tag_id, photo_id) VALUES (:tag_id, :photo_id)";
        $params = array(
          ":tag_id" => $add_tag_id[0]['id'],
          ":photo_id" => $image_id
        );
        exec_sql_query($db, $sql, $params);
      } else {
        $new_tag = filter_input(INPUT_POST, 'add_new_tag', FILTER_SANITIZE_STRING);
        $sql = "INSERT INTO tags(tag_name,author_id) VALUES (:tag_name, :author_id)";
        $params = array(
          ":tag_name" => $new_tag,
          ":author_id" => $author_id
        );
        exec_sql_query($db, $sql, $params);
        $sql = "SELECT * FROM tags WHERE tag_name = :tag_name";
        $params = array(
          ":tag_name" => $new_tag
        );
        $add_tag_id = exec_sql_query($db, $sql, $params)->fetchAll();
        //var_dump($add_tag_id);
        $sql = "INSERT INTO tag_photo(tag_id, photo_id) VALUES (:tag_id, :photo_id)";
        $params = array(
          ":tag_id" => $add_tag_id[0]['id'],
          ":photo_id" => $image_id
        );
        exec_sql_query($db, $sql, $params);
      }
      echo "<meta http-equiv='refresh' content='0'>";
  }

  if (isset($_POST["delete_tag"])) {
    $delete_tag = filter_input(INPUT_POST, 'delete_tag_list', FILTER_SANITIZE_STRING);
    global $db;
    $sql = "SELECT id FROM tags WHERE tag_name = :tag_name";
    $params = array(
      ":tag_name" => $delete_tag
    );
    $delete_tag_id = exec_sql_query($db, $sql, $params)->fetchAll();
    $sql = "DELETE FROM tag_photo WHERE tag_id = :tag_id AND photo_id = :image_id";
    $params = array(
      ':tag_id' => $delete_tag_id[0]['id'],
      ':image_id'=> $image_id
    );
    exec_sql_query($db, $sql, $params);
    echo "<meta http-equiv='refresh' content='0'>";
  }
    ?>
</body>
</html>
