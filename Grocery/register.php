<?php
include 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $conn->real_escape_string($_POST['username']);
  $email = $conn->real_escape_string($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  // Check if username or email exists
  $check = $conn->query("SELECT id FROM Consumer WHERE username='$username' OR email='$email'");
  if ($check->num_rows > 0) {
    $message = "Username or Email already exists.";
  } else {
    $conn->query("INSERT INTO Consumer (username, email, password) VALUES ('$username', '$email', '$password')");
    $message = "Registration successful. <a href='login.php'>Login here</a>.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register - Grocery Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5" style="max-width: 400px;">
    <h2>Register</h2>

    <?php if($message): ?>
      <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required />
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required />
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required />
      </div>
      <button type="submit" class="btn btn-success">Register</button>
    </form>

    <p class="mt-3">Already registered? <a href="login.php">Login here</a>.</p>
  </div>
</body>
</html>
