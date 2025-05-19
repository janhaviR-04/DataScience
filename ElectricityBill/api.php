<?php
include 'db.php';

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'] ?? '';
$address = $data['address'] ?? '';
$units = (int)($data['units'] ?? 0);

function calculateBill($units) {
    if ($units <= 50) return $units * 3.5;
    elseif ($units <= 150) return (50 * 3.5) + (($units - 50) * 4);
    elseif ($units <= 250) return (50 * 3.5) + (100 * 4) + (($units - 150) * 5.2);
    else return (50 * 3.5) + (100 * 4) + (100 * 5.2) + (($units - 250) * 6.5);
}

$total_amount = calculateBill($units);

// Insert into DB
$stmt = $conn->prepare("INSERT INTO Consumer (name, address) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $address);
$stmt->execute();
$consumer_id = $stmt->insert_id;
$stmt->close();

$stmt = $conn->prepare("INSERT INTO Billing (consumer_id, units, total_amount) VALUES (?, ?, ?)");
$stmt->bind_param("iid", $consumer_id, $units, $total_amount);
$stmt->execute();
$stmt->close();

echo json_encode([
    "message" => "Bill calculated successfully",
    "consumer_name" => $name,
    "units" => $units,
    "total_amount" => number_format($total_amount, 2)
]);
?>
