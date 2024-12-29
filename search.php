<?php
// Include your database connection
include 'db.php';

// Get the query from the request
$query = isset($_GET['q']) ? $_GET['q'] : '';

if (!empty($query)) {
    try {
        $stmt = $pdo->prepare("SELECT name FROM products WHERE name LIKE :query LIMIT 10");
        $stmt->execute(['query' => "%$query%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($results);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Query failed: ' . $e->getMessage()]);
    }
} else {
    echo json_encode([]);
}
?>
