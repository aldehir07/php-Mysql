<?php
session_start();
include 'db.php';

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Consulta SQL para obtener las transacciones del usuario
$stmt = $pdo->prepare("
    SELECT t.type, t.amount, t.created_at 
    FROM transactions t
    INNER JOIN accounts a ON t.account_id = a.id
    WHERE a.user_id = ?
    ORDER BY t.created_at DESC
");
$stmt->execute([$user_id]);
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verificar si se encontraron transacciones
if (count($transactions) > 0) {
    foreach ($transactions as $transaction) {
        echo "Type: " . $transaction['type'] . "<br>";
        echo "Amount: $" . $transaction['amount'] . "<br>";
        echo "Date: " . $transaction['created_at'] . "<br><br>";
    }
} else {
    echo "No transactions found for this account.";
}
?>