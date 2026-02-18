<?php
require 'vendor/autoload.php';
require 'app/Config/Paths.php';

use CodeIgniter\Boot;

$paths = new Config\Paths();
Boot::bootSpark($paths);

$db = \Config\Database::connect();
$password = password_hash('kasir123', PASSWORD_BCRYPT);

$result = $db->table('users')->where('username', 'kasir')->update(['password' => $password]);

if ($result) {
    echo "Password updated successfully!\n";
    echo "Hash: " . $password . "\n";
} else {
    echo "Update failed\n";
}

// Show all users
echo "\nAll users:\n";
$users = $db->table('users')->get()->getResult();
foreach ($users as $u) {
    echo "ID: {$u->id}, Username: {$u->username}, Role: {$u->role}\n";
}
?>
