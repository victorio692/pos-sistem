<?php
// Add customer_name column to orders table
$db = new mysqli('localhost', 'root', '', 'pos_restoran');

if ($db->connect_error) {
    die('Connection error: ' . $db->connect_error);
}

// Check if column already exists
$result = $db->query("SHOW COLUMNS FROM orders LIKE 'customer_name'");

if ($result->num_rows > 0) {
    echo "✓ Column 'customer_name' already exists\n";
} else {
    echo "Adding 'customer_name' column to orders table...\n";
    $sql = "ALTER TABLE orders ADD COLUMN customer_name VARCHAR(100) NULL AFTER guest_count";
    
    if ($db->query($sql)) {
        echo "✓ Column 'customer_name' added successfully\n";
        
        // Verify
        $result = $db->query("SHOW COLUMNS FROM orders LIKE 'customer_name'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "  Field: {$row['Field']}, Type: {$row['Type']}\n";
        }
    } else {
        echo "✗ Error adding column: " . $db->error . "\n";
    }
}

$db->close();
?>
