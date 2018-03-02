<?php
include("includes/init.php");

// declare the current location, utilized in header.php
$current_page_id="standards";

$standards = array(
  "Follow the standards, conventions and expectations for web site development used in this class",
  "All code is your own work, unless the assignment states otherwise.",
  "Main page is named index.html or index.php.",
  "A multi-page site should be well organized and include proper navigation.",
  "The HTML is well structured for your site’s content (i.e. use of <header>, <main>, <section>, <footer>, <p>, <ul>, <em>, <strong> tags)",
  "Use CSS for positioning and style.",
  'External styling via CSS. No inline or internal styling (i.e. <style> tag or style="" attribute).',
  "Multiple CSS files are okay as long it’s for legitimate structural reasons.",
  "Your code (HTML, CSS) is well written, formatted, properly indented, readable, and well-documented.",
  "No broken or dead links. Remember that some computers use case sensitive file and folder names!",
  "Validated HTML5 and CSS3. You must have 0 errors; warnings are permitted.",
  "Images are located in an images directory. Scripts in the scripts directory. PHP includes in the includes directory. CSS in the styles directory.",
  "You have tested your website in Firefox and Chrome.",
  "External content is cited. See the syllabus for details.",
  "Have effective information organization and navigation structures.",
  "Use design principles well, and have an engaging, pleasing design.",
  "Have interactive elements using both client side (e.g., jQuery/Javascript) and server-side (e.g., PHP) technologies that meet client needs.",
  "Work on different screen sizes and display reasonably well across different browsers.",
  "Follow the rules of good usability from the user’s perspective.",
  "Designed and implemented effectively for the target audience of the site."
);

//a_standard should be a string
function print_standard($a_standard){
  echo "<li>" . htmlspecialchars($a_standard) . "</li>\n";
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Standards - <?php echo $title;?></title>
</head>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <article id="content">
      <h1 id="article-title">Assignment Standards</h1>
      <section>
        <p><strong>This web page is an example of the standards you are expected follow this semester. This example web page follows the guidelines below.</strong></p>

        <p>Coding and design guidelines:</p>
        <ul>
          <?php
          foreach($standards as $s){
            print_standard($s);
          }
          ?>
        </ul>

      </section>
    </article>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
