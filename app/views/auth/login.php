<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificare</title>
    <link rel="stylesheet" href="/ShopOnline/MagazinOnline/saas/saas-platform/public/assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Autentificare</h2>
        <form action="/ShopOnline/MagazinOnline/saas/saas-platform/public/auth/login" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Parolă" required>
            <button type="submit">Autentificare</button>
        </form>
        <p>Nu ai cont? <a href="/ShopOnline/MagazinOnline/saas/saas-platform/public/auth/register">Înregistrează-te</a></p>
    </div>
</body>
</html>

