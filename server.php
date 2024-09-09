<?php
require 'vendor/autoload.php';

use PDO;
use PDOException;

// Database connection settings
$dsn = 'pgsql:host=viaduct.proxy.rlwy.net;port=51094;dbname=railway';
$username = 'postgres';
$password = 'VvphRVaIHGzWXhEwcnPWUbYxfnkbJSaO';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connected to PostgreSQL database!';
} catch (PDOException $e) {
    die('Error connecting to the database: ' . $e->getMessage());
}

// Function for asynchronous-like query execution using Promises in PHP
function asyncQuery($pdo, $sql, $params = [])
{
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception('Query error: ' . $e->getMessage());
    }
}

if ($_SERVER["REQUEST_URI"] == '/stores' || $_SERVER["REQUEST_URI"] == '/') {
    include 'public/templates/main.html';
    exit;
}

http_response_code(404);
echo '<h1>Page not found!<h1>';

?>


