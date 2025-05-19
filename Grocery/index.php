<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Online Grocery Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="index.php">Grocery Shop</a>
      <div>
        <?php if(isset($_SESSION['username'])): ?>
          <span>Hello, <?=htmlspecialchars($_SESSION['username'])?></span>
          <a href="logout.php" class="btn btn-sm btn-outline-danger ms-3">Logout</a>
          <a href="catalogue.php" class="btn btn-sm btn-outline-primary ms-2">Catalogue</a>
        <?php else: ?>
          <a href="login.php" class="btn btn-sm btn-outline-primary">Login</a>
          <a href="register.php" class="btn btn-sm btn-outline-success ms-2">Register</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <h1>Welcome to the Online Grocery Shop</h1>
    <p>Shop fresh groceries from the comfort of your home.</p>
  </div>
</body>
</html>
