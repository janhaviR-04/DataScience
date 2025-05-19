<?php
if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin') {
    echo "Login successful. <a href='catalogue.php'>Go to Catalogue</a>";
} else {
    echo "Invalid credentials.";
}
?>
