<?php
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$result = $conn->query("SELECT * FROM Items");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Catalogue - Grocery Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <nav class="navbar navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="index.php">Grocery Shop</a>
      <div>
        <span>Hello, <?=htmlspecialchars($_SESSION['username'])?></span>
        <a href="logout.php" class="btn btn-sm btn-outline-danger ms-3">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <h2>Catalogue</h2>
    <div class="row">
      <?php while ($item = $result->fetch_assoc()): ?>
        <div class="col-md-4 mb-3">
          <div class="card">
            <?php if ($item['image']): ?>
              <img src="<?=htmlspecialchars($item['image'])?>" class="card-img-top" alt="<?=htmlspecialchars($item['name'])?>">
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><?=htmlspecialchars($item['name'])?></h5>
              <p class="card-text"><?=htmlspecialchars($item['description'])?></p>
              <p><strong>Price:</strong> $<?=number_format($item['price'], 2)?></p>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</body>
</html>
