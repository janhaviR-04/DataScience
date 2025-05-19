<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $units = (int)$_POST['units'];

    // Insert consumer
    $stmt = $conn->prepare("INSERT INTO Consumer (name, address) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $address);
    $stmt->execute();
    $consumer_id = $stmt->insert_id;
    $stmt->close();

    // Calculate bill
    function calculateBill($units) {
        $amount = 0;
        if ($units <= 50) {
            $amount = $units * 3.50;
        } elseif ($units <= 150) {
            $amount = (50 * 3.5) + (($units - 50) * 4.00);
        } elseif ($units <= 250) {
            $amount = (50 * 3.5) + (100 * 4.00) + (($units - 150) * 5.20);
        } else {
            $amount = (50 * 3.5) + (100 * 4.00) + (100 * 5.20) + (($units - 250) * 6.50);
        }
        return $amount;
    }

    $total_amount = calculateBill($units);

    // Insert billing
    $stmt = $conn->prepare("INSERT INTO Billing (consumer_id, units, total_amount) VALUES (?, ?, ?)");
    $stmt->bind_param("iid", $consumer_id, $units, $total_amount);
    $stmt->execute();
    $stmt->close();

    echo "<h3>Bill Generated</h3>";
    echo "Name: $name<br>";
    echo "Units Consumed: $units<br>";
    echo "Total Amount: Rs. " . number_format($total_amount, 2);
}
?>
