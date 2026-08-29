<?php
header("Content-Type: text/plain");
$host = getenv("DB_HOST") ?: "jnyeedpleoyrnjvlrcbu.supabase.co";
$port = getenv("DB_PORT") ?: "5432";
$database = getenv("DB_DATABASE") ?: "postgres";
$username = getenv("DB_USERNAME") ?: "postgres";
$password = getenv("DB_PASSWORD") ?: "";
echo "Testing connection to $host:$port...\n";
try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$database";
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_TIMEOUT => 5];
    $pdo = new PDO($dsn, $username, $password, $options);
    echo "SUCCESS: Connected to database!\n";
    $stmt = $pdo->query("SELECT COUNT(*) FROM menu_items");
    echo "Menu items count: " . $stmt->fetchColumn() . "\n";
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

