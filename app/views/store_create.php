<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creare Magazin</title>
    <link rel="stylesheet" href="/ShopOnline/MagazinOnline/saas/saas-platform/public/assets/style.css">
</head>


<body>

    <div class="container">
        <h1>Creare Magazin Nou</h1>
        
        <form action="/ShopOnline/MagazinOnline/saas/saas-platform/public/stores/create" method="POST">
            <label for="name">Nume Magazin:</label>
            <input type="text" id="name" name="name" required>

            <label for="domain">Domeniu Magazin:</label>
            <input type="text" id="domain" name="domain" required placeholder="ex: magazinultau.com">

            <button type="submit">Creează Magazin</button>
        </form>
        
        <a href="/ShopOnline/MagazinOnline/saas/saas-platform/public/stores/list">Vezi magazinele tale</a>
    </div>

</body>
</html>
