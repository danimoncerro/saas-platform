<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazinele Mele</title>
    <link rel="stylesheet" href="/ShopOnline/MagazinOnline/saas/saas-platform/public/assets/style.css">
</head>
<body>

<script>
    document.querySelector("form").addEventListener("submit", (e) => {
        console.log("Formularul a fost trimis!");
    });
</script>

    <div class="container">
        <h1>Magazinele Tale</h1>

        <?php if (!empty($stores)): ?>
            <ul>
                <?php foreach ($stores as $store): ?>
                    <li>
                        <strong><?= htmlspecialchars($store['name']) ?></strong> - 
                        <a href="http://<?= htmlspecialchars($store['domain']) ?>" target="_blank">
                            <?= htmlspecialchars($store['domain']) ?>
                        </a>
                        <br>
                        <<a href="/ShopOnline/MagazinOnline/saas/saas-platform/public/store/edit/<?= $store['id'] ?>">Editează</a> |
                        <a href="/ShopOnline/MagazinOnline/saas/saas-platform/public/store/delete/<?= $store['id'] ?>" onclick="return confirm('Ești sigur că vrei să ștergi acest magazin?')">Șterge</a>

                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nu ai creat încă niciun magazin.</p>
        <?php endif; ?>

        <br>
        <a href="/ShopOnline/MagazinOnline/saas/saas-platform/public/store/create">Adaugă un magazin nou</a>
    </div>

 

</body>
</html>
