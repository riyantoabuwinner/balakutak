<?php
$host = '127.0.0.1';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Dropping database db_prodi...\n";
    $pdo->exec("DROP DATABASE IF EXISTS db_prodi");

    echo "Creating database db_prodi...\n";
    $pdo->exec("CREATE DATABASE db_prodi CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

    echo "Database db_prodi successfully dropped and recreated.\n";
}
catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
