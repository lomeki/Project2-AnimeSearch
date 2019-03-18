<?php
// DO NOT REMOVE!
include("includes/init.php");
// DO NOT REMOVE!

$title = "ADD ANIME";
$form_valid = FALSE;

if (isset($_POST['submits'])) {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $genre = $_POST['genre'];
    $genre_string = join("/",$genre);
    $rating = filter_input(INPUT_POST, "rating", FILTER_VALIDATE_FLOAT)/10;
    $length = filter_input(INPUT_POST, "length", FILTER_VALIDATE_INT);
    $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);

    if (isset($name) & !empty($genre) & ($rating>0) & isset($length) & isset($description)) {
        $form_valid = TRUE;
    }
} else {
    $rating = 0;
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
<div class="content" id="add-content">

<?php if (!$form_valid) {?>

<!-- Code for the form was adapted from https://www.w3schools.com/html/html_form_input_types.asp -->
<h1>Add your anime!</h1>
<div id="add">
    <img src="images/drrr.jpg"/>
    <!-- Image Source: https://artfiles.alphacoders.com/109/109498.jpg -->
    <form method="post" action="add.php">

        <div class="form-input">
            <label for="name">Anime Title*:</label>
            <input type="text" name="name" value="<?php echo $name?>"/>
        </div>

        <div class="form-input checkbox">
            <label for="genre">Genre*:</label>
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
            <label for="rating">Rating*:</label>
            0<input type="range" name="rating" value="<?php echo $rating*10 ?>">10
        </div>

        <div class="form-input">
            <label for="length">Number of Episodes*:</label>
            <input type="text" name="length" value="<?php echo $length ?>"/>
        </div>

        <div class="form-input">
            <label for="description">Description*:</label>
            <textarea rows="6" cols="40" name="description"><?php echo $description ?></textarea>
        </div>

        <div class="form-input">*Note: All fields are required!</div>

        <div class="form-input">
            <input class="submit" id="add-submit" type="submit" name="submits" value="Share your anime with the world!"/>
        </div>

    </form>
    <img src="images/drrr2.jpeg"/>
    <!-- Image Source: https://artfiles.alphacoders.com/109/109498.jpg -->
</div>
<?php }else{
    $sql = "INSERT INTO anime (name, genre, rating, length, description) VALUES (\"$name\", \"$genre\", $rating, $length, \"$description\");";
    $params = array();
    $result = exec_sql_query($db, $sql, $params);
?>

<div class="search-box">
    <h3>Thank you for sharing your anime! It'll be added to our list now, and everyone else will be able to find it when they search!</h3><br/>

    <h2>Your Entry:</h2>
    <?php
        echo "Title: " . htmlspecialchars($name) . "<br/>";
        echo "Genre: " . htmlspecialchars($genre_string) . "<br/>";
        echo "Rating: " . htmlspecialchars($rating) . "<br/>";
        echo "Number of Episodes: " . htmlspecialchars($length) . "<br/>";
        echo "Description: " . htmlspecialchars($description) . "<br/>";
    ?>
</div>

<?php } ?>

</div>

<?php include("includes/footer.php")?>

</body>
</html>
