<?php
include 'db.php';

$result = $conn->query("SELECT * FROM Books");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Catalogue</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h2>Book Catalogue</h2>
  <table class="table table-bordered mt-3">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Price (Rs.)</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['title'] ?></td>
          <td><?= $row['author'] ?></td>
          <td><?= $row['price'] ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>
