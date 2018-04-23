<?php

$title = 'Photo Gallery';
//asscociate array mapping page 'id' to page title

$pages = array(
  'index' => 'Home',
  'mypage' => 'My Page'
);

//An array to deliver messages to the user.
$messages = array();

//Record a message to display to the user.
function record_message($message) {
  global $messages;
  array_push($messages, $message);
}

//write out any message to the user.
function print_messages() {
  global $messages;
  foreach ($messages as $message) {
    echo "<p class='message'><strong>".htmlspecialchars($message)."</strong></p>\n";
  }
}
// show database errors during development.
function handle_db_error($exception) {
  echo '<p><strong>' . htmlspecialchars('Exception : ' . $exception->getMessage()) . '</strong></p>';
}

// execute an SQL query and return the results.
function exec_sql_query($db, $sql, $params = array()) {
  try {
    $query = $db->prepare($sql);
    if ($query and $query->execute($params)) {
      return $query;
    }
  } catch (PDOException $exception) {
    handle_db_error($exception);
  }
  return NULL;
}

// open connection to database
function open_or_init_sqlite_db($db_filename, $init_sql_filename) {
  if (!file_exists($db_filename)) {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db_init_sql = file_get_contents($init_sql_filename);
    if ($db_init_sql) {
      try {
        $result = $db->exec($db_init_sql);
        if ($result) {
          return $db;
        }
      } catch (PDOException $exception) {
        handle_db_error($exception);
      }
    }
  } else {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  }
  return NULL;
}

//open connection to database
$db = open_or_init_sqlite_db("photo.sqlite","init/init.sql");

function check_login() {
  global $db;
  global $author_id;
  if (isset($_COOKIE["session"])) {
    $session = $_COOKIE["session"];
    $sql = "SELECT * FROM users WHERE session = :session";
    $params = array(
      ':session' => $session
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      // Username is UNIQUE, so there should only be 1 record.
      $account = $records[0];
      $author_id = $account['id'];
      return $account['username'];
    }
  }
  return NULL;
}
function log_in($username, $password) {
  global $db;
  if ($username && $password) {
    $sql = "SELECT * FROM users WHERE username = :username;";
    $params = array(
      ':username' => $username
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      // Username is UNIQUE, so there should only be 1 record.
      $account = $records[0];
      // Check password against hash in DB
      if ( password_verify($password, $account['password']) ) {
        // Generate session
        // Warning! Not a secure method for generating session IDs!
        // TODO: secure session
        $session = uniqid();
        $sql = "UPDATE users SET session = :session WHERE id = :user_id;";
        $params = array(
          ':user_id' => $account['id'],
          ':session' => $session
        );
        $result = exec_sql_query($db, $sql, $params);
        if ($result) {
          // Success, we are logged in.
          // Send this back to the user.
          setcookie("session", $session, time()+3600);  /* expire in 1 hour */
          record_message("Logged in as $username.");
          return TRUE;
        } else {
          record_message("Log in failed.");
        }
      } else {
        record_message("Invalid username or password.");
      }
    } else {
      record_message("Invalid username or password.");
    }
  } else {
    record_message("No username or password given.");
  }
  return FALSE;
}
function log_out() {
  global $current_user;
  global $db;
  if ($current_user) {
    $sql = "UPDATE users SET session = :session WHERE username = :username;";
    $params = array(
      ':username' => $current_user,
      ':session' => NULL
    );
    if (!exec_sql_query($db, $sql, $params)) {
      record_message("Log out failed.");
    }
  }
  // Remove the session from the cookie and force it to expire.
  setcookie("session", "", time()-3600);
  $current_user = NULL;
}
// Check if we should login the user
if (isset($_POST['login'])) {
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $username = trim($username);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  $current_user = log_in($username, $password);
  echo "<meta http-equiv='refresh' content='0'>";
}
// check if logged in
$current_user = check_login();

function display_image($image) {
 // var_dump($image);
 global $db;
 $sql = "SELECT * FROM tag_photo INNER JOIN tags ON tags.id = tag_photo.tag_id WHERE photo_id = :image_id";
 $params = array(
   ":image_id" => $image["id"]
 );
 $tags = exec_sql_query($db, $sql, $params)->fetchAll();
 echo "<div class =\"holder\">";
 echo "<a href = image.php?".$image["id"].".".$image["ext"].">";
 echo "<img alt=".$image["photo_name"]. " src=\"../uploads/photos/".$image["id"].".".$image["ext"]."\""."/>";
 echo "</a>";
 echo "<ul>";
 foreach ($tags as $tag) {
   echo "<li>";
   echo htmlspecialchars($tag['tag_name']);
   echo "</li>";
 }
 echo "<li>";
 echo htmlspecialchars($image['description']);
 echo "</li>";
 echo "</ul>";
 echo "</div>";
}
?>
