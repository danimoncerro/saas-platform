<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Utilizatori</title>
</head>
<body>
    <h1>Lista Utilizatorilor</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nume</th>
            <th>Email</th>
            <th>Creat la</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user["id"] ?></td>
                <td><?= $user["name"] ?></td>
                <td><?= $user["email"] ?></td>
                <td><?= $user["created_at"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Adaugă un utilizator nou</h2>
    <form method="POST" action="/public/home/store">
        <input type="text" name="name" placeholder="Nume" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Parolă" required>
        <button type="submit">Adaugă</button>
    </form>
</body>
</html>
