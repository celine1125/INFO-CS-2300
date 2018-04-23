<?php include('includes/init.php');
  $current_page_id="mypage";
  const MAX_FILE_SIZE = 1200000;
  const IMAGE_UPLOAD_PATH = "uploads/photos/";
  $image_id = NULL;

  if (isset($_POST["logout"])) {
    log_out();
  }

  if (isset($_POST["submit_upload"])) {
  $upload_info = $_FILES["image_file"];
  $upload_desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
  if ($upload_info['error'] == UPLOAD_ERR_OK) {
    $upload_name = basename($upload_info["name"]);
    $upload_ext = strtolower(pathinfo($upload_name, PATHINFO_EXTENSION) );
    $sql = "INSERT INTO photos (photo_name, ext, description, author_id) VALUES (:filename, :extension, :description, :author_id)";
    $params = array(
      ':extension' => $upload_ext,
      ':filename' => $upload_name,
      ':description' => $upload_desc,
      ':author_id' => $author_id
    );}
    $result = exec_sql_query($db, $sql, $params);
    if ($result) {
      $image_id = $db->lastInsertId("id");
      if (move_uploaded_file($upload_info["tmp_name"], IMAGE_UPLOAD_PATH . "$image_id.$upload_ext")){
        array_push($messages, "Your image has been uploaded.");
      }
    } else {
      array_push($messages, "Failed to upload image.");
    }
  } else {
    array_push($messages, "Failed to upload image.");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
    <title>My Page - <?php echo htmlspecialchars($title); ?></title>
  </head>

  <body>
    <?php include("includes/header.php");
    echo "<form class=\"logout\" method=\"post\" action=\"index.php\">";
    echo "<input class=\"logout_button\" type=\"submit\" name=\"logout\" value=\"logout\"/>";
    echo "</form>";
    ?>
    <h2>Upload a Image</h2>
    <form id="uploadImage" action="mypage.php" method="post" enctype="multipart/form-data">
     <ul>
       <li>
         <label>Upload Image:</label>
         <!-- MAX_FILE_SIZE must precede the file input field -->
         <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
         <input type="file" name="image_file" required>
       </li>
       <li>
         <label>Description:</label>
       </li>
       <li>
         <textarea name="description" cols="40" rows="5"></textarea>
       </li>
       <li>
         <button name="submit_upload" type="submit">Upload</button>
       </li>
     </ul>
   </form>
     <?php
     if ($image_id != NULL) {
       ?>
       <div id="save">
       <?php
       echo  "<h2>Saved Image</h2>";
       $records = exec_sql_query($db, "SELECT * FROM photos WHERE id = $image_id ")->fetchAll(PDO::FETCH_ASSOC);
       foreach($records as $record){
         display_image($record);
         echo "<a href=\"" . IMAGE_UPLOAD_PATH . $record["id"] . "." . $record["ext"] . "\">".$record["photo_name"]."</a>";
       }
       echo "</div>";
     }
     ?>
     <?php
     $sql = "SELECT * FROM photos WHERE author_id = :author_id";
     $params = array(
       ':author_id' => $author_id
     );
     $images = exec_sql_query($db, $sql, $params) -> fetchAll();
     if (isset($images) and !empty($images)) {
       foreach($images as $image) {
         display_image($image);
       }
     }
     ?>
  </body>
</html>
