<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $account_number = $_POST['account_number'];
    $amount = $_POST['amount'];

    $stmt = $pdo->prepare("SELECT * FROM accounts WHERE account_number = ?");
    $stmt->execute([$account_number]);
    $recipient_account = $stmt->fetch();

    if ($recipient_account) {
        $stmt = $pdo->prepare("UPDATE accounts SET balance = balance - ? WHERE user_id = ?");
        $stmt->execute([$amount, $_SESSION['user_id']]);

        $stmt = $pdo->prepare("UPDATE accounts SET balance = balance + ? WHERE id = ?");
        $stmt->execute([$amount, $recipient_account['id']]);

        $stmt = $pdo->prepare("INSERT INTO transactions (account_id, type, amount) VALUES (?, 'transfer', ?)");
        $stmt->execute([$_SESSION['account_id'], $amount]);

        echo "Transfer successful.";
    } else {
        echo "Recipient account not found.";
    }
}
?>

<form method="POST" action="transfer.php">
    <input type="text" name="account_number" placeholder="Recipient Account Number" required>
    <input type="number" name="amount" placeholder="Amount" required>
    <button type="submit">Transfer</button>
</form>