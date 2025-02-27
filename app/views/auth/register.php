<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Înregistrare</title>
    <link rel="stylesheet" href="/ShopOnline/MagazinOnline/saas/saas-platform/public/assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Înregistrare</h2>
        <form action="/ShopOnline/MagazinOnline/saas/saas-platform/public/auth/register" method="POST">
            <input type="text" name="name" placeholder="Nume" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Parolă" required>
            <button type="submit">Înregistrează-te</button>
        </form>
        <p>Ai deja un cont? <a href="/ShopOnline/MagazinOnline/saas/saas-platform/public/auth/login">Autentificare</a></p>
    </div>
</body>
</html>
