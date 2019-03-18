<?php
// vvv DO NOT MODIFY/REMOVE vvv

// check current php version to ensure it meets 2300's requirements
function check_php_version()
{
  if (version_compare(phpversion(), '7.0', '<')) {
    define(VERSION_MESSAGE, "PHP version 7.0 or higher is required for 2300. Make sure you have installed PHP 7 on your computer and have set the correct PHP path in VS Code.");
    echo VERSION_MESSAGE;
    throw VERSION_MESSAGE;
  }
}
check_php_version();

function config_php_errors()
{
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 0);
  error_reporting(E_ALL);
}
config_php_errors();

// open connection to database
function open_sqlite_db($db_filename)
{
  $db = new PDO('sqlite:' . $db_filename);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $db;
}

function exec_sql_query($db, $sql, $params = array())
{
  $query = $db->prepare($sql);
  if ($query and $query->execute($params)) {
    return $query;
  }
  return null;
}

// open connection to database
$db = open_sqlite_db('secure/data.sqlite');

// ^^^ DO NOT MODIFY/REMOVE ^^^

// You may place any of your code here.

function print_record($record) {
  ?>
  <tr>
    <td><?php echo htmlspecialchars($record["name"]);?></td>
    <td><?php echo htmlspecialchars($record["genre"]);?></td>
    <td><?php echo htmlspecialchars($record["length"]);?></td>
    <td><?php echo htmlspecialchars($record["rating"]);?></td>
    <td><?php echo htmlspecialchars($record["description"]);?></td>
  </tr>
  <?php
}

function length_range($length) {
  $length_ints = explode("-",$length);
  $min_length = min($length_ints);
  $max_length = max($length_ints);
  $length_range = [$min_length,$max_length];

  return $length_range;
}

function genre_query($genres) {
  $final = count($genres);
  $i = 0;
  foreach ($genres as $genre) {
    $genre_list[$i] = "genre LIKE '%$genre%'";
    $i = $i + 1;
    if ($i < $final) {
      $genre_list[$i-1] = $genre_list[$i-1] . " OR ";
    }
  }
  $genre_string = join(" ",$genre_list);
  return $genre_string;
}

?>

<link rel="stylesheet" href="styles/all.css">
