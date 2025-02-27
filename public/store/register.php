<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Înregistrare Utilizator Magazin</title>
</head>
<body>
    <h2>Înregistrare Utilizator Magazin</h2>
    <form action="store_register_process.php" method="POST">
        <input type="text" name="name" placeholder="Nume" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Parolă" required><br>
        <input type="password" name="confirm_password" placeholder="Confirmă Parola" required><br>
        <button type="submit">Înregistrează-te</button>
</body>
</html>
