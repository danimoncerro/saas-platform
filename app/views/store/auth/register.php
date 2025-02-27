<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Înregistrare Client Magazin</title>
</head>
<body>
    <h2>Înregistrare Clientul Magazin</h2>
    <form action="/ShopOnline/MagazinOnline/saas/saas-platform/public/store/auth/register" method="POST">
        <label for="name">Nume:</label>
        <input type="text" name="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="password">Parolă:</label>
        <input type="password" name="password" required>
        <br>
        <label for="store_id">ID Magazin:</label>
        <input type="number" name="store_id" required>
        <br>
        <button type="submit">Înregistrare</button>
    </form>
    <p>Ai deja cont? <a href="/ShopOnline/MagazinOnline/saas/saas-platform/public/store/auth/login">Autentifică-te aici</a></p>
</body>
</html>

