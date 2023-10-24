<?php
require 'db_connect.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search product by category</title>
</head>
<body>
  <header>
    <form action="product.php" method="get">
      <label for="category">
        <select name="category" id="category">
          <!-- add options hear ex.
          <option value="1">Beverages</option>
          -->
          <?php 
                    $sql = 'select CategoryID, CategoryName from categories order by CategoryName';
                    $result= $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        echo "<option value='{$row['CategoryID']}'>
                        {$row['CategoryName']}
                        </option>";
                    }
                $conn->close(); 
                ?>
        </select>
      </label>
      <input type="submit" value="Search" name="submit">
    </form>
  </header>
</body>
</html>