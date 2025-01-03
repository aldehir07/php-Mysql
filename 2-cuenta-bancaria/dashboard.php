<?php
session_start();
include 'db.php';

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Consulta para obtener la cuenta del usuario
$stmt = $pdo->prepare("SELECT * FROM accounts WHERE user_id = ?");
$stmt->execute([$user_id]);
$account = $stmt->fetch(PDO::FETCH_ASSOC);

if ($account) {
    echo "Welcome, " . $_SESSION['username'] . "<br>";
    echo "Account Number: " . $account['account_number'] . "<br>";
    echo "Balance: $" . $account['balance'] . "<br>";
} else {
    echo "No account found for this user.";
}
?>

<a href="transfer.php">Make a Transfer</a><br>
<a href="transaction_history.php">Transaction History</a><br>
<a href="logout.php">Logout</a>