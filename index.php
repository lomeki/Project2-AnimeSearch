<?php
// DO NOT REMOVE!
include("includes/init.php");
// DO NOT REMOVE!

$title = "HOME";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

</head>

<body>
<?php include("includes/header.php"); ?>

<div id="home">
  <div class="home-box"><a href="search.php">
    Find your AniMatch!
  </a></div>

  <div class="home-box"><a href="list.php">
    Explore our entire list of anime!
  </a></div>
</div>


<div class="home-box add-box"><a href="add.php">
  Is there an anime you love that's not on the list? Want to share its greatness with everyone? Add it to the list here!
</a></div>

<?php include("includes/footer.php")?>

</body>
</html>
