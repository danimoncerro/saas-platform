<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editare Magazin</title>
    <link rel="stylesheet" href="/ShopOnline/MagazinOnline/saas/saas-platform/public/assets/style.css">
</head>
<body>

    <div class="container">
        <h1>Editează Magazinul</h1>

        <form action="/ShopOnline/MagazinOnline/saas/saas-platform/public/store/update/<?= $store['id'] ?>" method="POST">
            <input type="hidden" name="store_id" value="<?= $store['id'] ?>">

            <label for="name">Nume Magazin:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($store['name']) ?>" required>

            <label for="domain">Domeniu Magazin:</label>
            <input type="text" id="domain" name="domain" value="<?= htmlspecialchars($store['domain']) ?>" required>

            <button type="submit">Salvează Modificările</button>
        </form>
        
        <a href="/ShopOnline/MagazinOnline/saas/saas-platform/public/store/list">Înapoi la magazine</a>
    </div>

</body>
</html>
