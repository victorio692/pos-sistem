<?php
// Check current table status in database
$db = new mysqli('localhost', 'root', '', 'pos_restoran');

if ($db->connect_error) {
    die('Connection error: ' . $db->connect_error);
}

echo "=== CURRENT TABLE STATUS ===\n\n";

$result = $db->query("SELECT id, table_number, status, capacity, guest_count FROM tables LIMIT 15");

while ($row = $result->fetch_assoc()) {
    echo "ID: {$row['id']}, Table: T-{$row['table_number']}, Status: {$row['status']}, Capacity: {$row['capacity']}, Guests: {$row['guest_count']}\n";
}

echo "\n=== OCCUPIED TABLES ===\n";
$occupied = $db->query("SELECT id, table_number, status, guest_count FROM tables WHERE status = 'occupied' OR status = 'terisi'");
echo "Total occupied: " . $occupied->num_rows . "\n";

while ($row = $occupied->fetch_assoc()) {
    echo "  Table T-{$row['table_number']}: status={$row['status']}, guests={$row['guest_count']}\n";
}

$db->close();
?>
