<?php
    include("db.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, password) 
                              VALUES (?, ?)");
        $stmt->execute([$username, $password]);

        header("Location: login.php");
    }

?>
<h2>Registrate </h2>
<form action="register.php" method="post">
    <input type="text" name="username" placeholder="Username" require>
    <input type="password" name="password" placeholder="Password" require>
    <input type="submit" value="Register">
</form>