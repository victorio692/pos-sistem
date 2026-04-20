<?php
// Check orders table structure
$db = new mysqli('localhost', 'root', '', 'pos_restoran');

if ($db->connect_error) {
    die('Connection error: ' . $db->connect_error);
}

echo "=== ORDERS TABLE COLUMNS ===\n\n";
$result = $db->query("SHOW COLUMNS FROM orders");

while ($row = $result->fetch_assoc()) {
    echo "Field: {$row['Field']}, Type: {$row['Type']}\n";
}

echo "\n=== SAMPLE ORDER DATA ===\n";
$sample = $db->query("SELECT * FROM orders LIMIT 1");
if ($sample->num_rows > 0) {
    $row = $sample->fetch_assoc();
    echo json_encode($row, JSON_PRETTY_PRINT) . "\n";
}

$db->close();
?>
