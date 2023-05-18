<?php include 'tree.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>My Tree Visualization</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>My Tree Visualization</h1>
    <div class="tree">
      <?php displayNodeHtml($root); ?>
    </div>
  </body>
</html>
