<?php
// DO NOT REMOVE!
include("includes/init.php");
// DO NOT REMOVE!

$title = "FULL LIST";
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

<h1>Full List</h1>

<!-- Database code based on Lab 5 -->
    <?php
        $sql = "SELECT * FROM anime;";
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

<?php include("includes/footer.php")?>

</body>
</html>
