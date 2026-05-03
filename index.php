<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Оставить заявку</title>
</head>
<body>

<h2>Оставить заявку</h2>

<form action="submit.php" method="POST">
    <input type="text" name="name" placeholder="Имя" required><br><br>

    <input type="email" name="email" placeholder="Email" required><br><br>

    <textarea name="message" placeholder="Сообщение" required></textarea><br><br>

    <button type="submit">Отправить</button>
</form>

<hr>

<h3>Админ вход</h3>

<form method="POST" action="login.php">
    <input type="text" name="login" placeholder="Логин" required><br><br>
    <input type="password" name="password" placeholder="Пароль" required><br><br>
    <button type="submit">Войти</button>
</form>

</body>
</html>