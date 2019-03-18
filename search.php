<?php
// DO NOT REMOVE!
include("includes/init.php");
// DO NOT REMOVE!

$title = "SEARCH";
$keywords = filter_input(INPUT_POST, "keywords", FILTER_SANITIZE_STRING);

if (isset($_POST['submits'])) {
    $genre = $_POST['genre'];
    $rating = filter_input(INPUT_POST, "rating",FILTER_VALIDATE_FLOAT)/10;
    $length = $_POST['length'];
    if (isset($genre)) {
        $genre_query = "(" . genre_query($genre) . ") AND ";
    } else {
        $genre_query = "";
    }
    if (isset($length)) {
        $length_range = length_range($length);
        $length_min = $length_range[0];
        $length_max = $length_range[1];
    } else {
        $length_min = 0;
        $length_max = 1000;
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <?php include("includes/header.php"); ?>
</head>

<body>
<div class="content">


<!-- Code for the form was adapted from https://www.w3schools.com/html/html_form_input_types.asp -->
<div class="search-box">
    <h1>Search</h1>
    <form method="post" action="search.php">

        <div class="form-input">
            <label for="keywords">Key Words:</label>
            <input id="keywords" type="text" name="keywords" value="<?php echo htmlspecialchars($keywords)?>"/>
            <input class="submit" type="submit" name="submits" value="Find your AniMatch!"/>
        </div>

    <div class="search-box"><h2><a href="?advanced=1" name="advanced" class="advanced-title">Advanced Search</a></h2>
        <div id="advanced-form">
        <!-- Code for hiding the Advanced Search is based on code found on
        https://stackoverflow.com/questions/12205307/php-check-if-link-has-been-clicked -->
        <?php
            $advanced = $_GET['advanced'];
            if ($advanced==1) {
        ?>
            <div class="form-input checkbox">
                <label for="genre">Genre:</label>
                    <div class="column">
                        <div class="check"><input type="checkbox" name="genre[]" value="Action">Action</input></div>
                        <div class="check"><input type="checkbox" name="genre[]" value="Comedy">Comedy</input></div>
                        <div class="check"><input type="checkbox" name="genre[]" value="Drama">Drama</input></div>
                        <div class="check"><input type="checkbox" name="genre[]" value="Fantasy">Fantasy</input></div>
                    </div>
                    <div class="column">
                        <div class="check"><input type="checkbox" name="genre[]" value="Horror">Horror</input></div>
                        <div class="check"><input type="checkbox" name="genre[]" value="Mystery">Mystery</input></div>
                        <div class="check"><input type="checkbox" name="genre[]" value="Sports">Sports</input></div>
                    </div>
            </div>

            <div class="form-input">
                <label for="rating">Minimum Rating:</label>
                0<input type="range" name="rating" value="0">10
            </div>

            <div class="form-input checkbox">
                <label for="length">Length:</label>
                <div class="check"><input type="radio" name="length" value="00-15">Less than 15 episodes</input></div>
                <div class="check"><input type="radio" name="length" value="15-30">15-30 episodes</input></div>
                <div class="check"><input type="radio" name="length" value="30-50">30-50 episodes</input></div>
                <div class="check"><input type="radio" name="length" value="50-100">50-100 episodes</input></div>
                <div class="check"><input type="radio" name="length" value="100-1000">Over 100 episodes</input></div>
            </div>
        </div>
        <h2><a href="?advanced=2" name="advanced" class="advanced-title">Close Advanced Search</a></h2>

        <?php }  ?>

    </div>

    </form>
</div>


<?php if (isset($_POST['submits'])) {?>

    <div class="search-box">
        <h2>You searched:</h2>
        <li>Keywords: <?php echo htmlspecialchars($keywords) ?></li>
        <li>Genre(s): <?php echo htmlspecialchars(join(", ",$genre)) ?></li>
        <li>Minimum Rating: <?php if ($rating>0) echo htmlspecialchars($rating) . "/10"?></li>
        <li>Length: <?php if (isset($length)) echo htmlspecialchars($length_min) . " to " . htmlspecialchars($length_max) . " episodes"?></li>
    </div>

    <div class="search-box">
    <h1>Results</h1>
    <?php
        if (isset($genre) || $rating > 0 || !empty($length)) {
            $sql = "SELECT * FROM anime WHERE
            (name LIKE '%$keywords%' OR description LIKE '%$keywords%') AND
            $genre_query
            (rating BETWEEN $rating and 10) AND
            (length BETWEEN $length_min AND $length_max);";
        } else {
            $sql = "SELECT * FROM anime WHERE name LIKE '%$keywords%' OR description LIKE '%$keywords%';";
        }
        $params = array();
        $result = exec_sql_query($db, $sql, $params);

    ?>

    <table>
      <tr class="table-titles">
        <th>Name</th>
        <th>Genre</th>
        <th>Length</th>
        <th>Rating</th>
        <th>Description</th>
      </tr>
      <?php
        if ($result) {
            $records = $result->fetchAll();
            foreach($records as $record) {
                print_record($record);
            }
        }
      ?>
    </table>
    </div>

<?php } ?>

</div>
</div>

<?php include("includes/footer.php")?>

</body>
</html>
