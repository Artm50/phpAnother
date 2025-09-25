<?php 
    require_once("db.php");
    require_once("function.php");
    checkSession();
    // $db = new DB();
    // Регистрация первого пользователя для теста
    // try {
    //     $db->openCon();
    //     $db->addUser($db->getCon(), "artm", "asd");
    // } catch (Error $e) {
    //     logError($e);
    // } 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Авторизация</title>
</head>
<body>
    <form action="" method="post">
        <label for="login" style="margin-right: 30px;">Логин:</label>
        <input type="text" id="login" name="login" placeholder="Введите логин">
        <br><br>
        <label for="password" style="margin-right: 23px;">Пароль:</label>
        <input type="password" id="password" name="password" placeholder="Введите пароль">
        <br><br>
        <button type="submit" name="submit" value="reg">Войти</button>
    </form>
    <?php if ($flag === false): ?>
        <p>Введены не верные данные</p>
    <?php endif ?>
</body>
</html>