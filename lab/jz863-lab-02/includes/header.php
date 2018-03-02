<header>
  <h1 id="title">Lab 2</h1>

  <nav id="menu">
    <ul>
      <!-- <li><a href='index.php'>Home</a></li>
      <li><a href='about.php'>About</a></li>
      <li><a href='standards.php'>Standards</a></li>
      <li><a href='schedule.php'>Schedule</a></li> -->
      <?php
        $current_page = $current_page_id;
        foreach ($pages as $page => $id) {
          if($page == $current_page_id) {
            echo "<li><a id = current_page href = $page.php>$id</a></li>";
          } else {
            echo "<li><a href = $page.php>$id</a></li>";
          }
        }
      ?>
    </ul>
  </nav>
</header>
