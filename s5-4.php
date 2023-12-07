<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проверка логина</title>
</head>
<body>

    <form action="" method="post">
        <label for="login">Введите логин:</label>
        <input type="text" id="login" name="login" required>
        <input type="submit" value="Submit">
    </form>

    <?php
        // Проверка логина после отправки формы
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Здесь вы можете добавить ваши зарегистрированные логины и соответствующие имена и фамилии
            $registeredLogins = array("ivan_php", "polyau", "kolyazzz", "maria_ss");
            $userDetails = array(
                "ivan_php" => "Иванов Иван Иванович",
                "polyau" => "Виговская Полина Игоревна",
                "kolyazzz" => "Золин Николай Алексеевич",
                "maria_ss" => "Сафина Мария Сергеевна"
            );

            // Получаем логин из формы
            $userLogin = isset($_POST['login']) ? $_POST['login'] : '';

            // Проверяем, зарегистрирован ли такой логин
            if (in_array($userLogin, $registeredLogins)) {
                // Выводим соответствующее приветствие для зарегистрированного пользователя
                echo "Здравствуйте, " . $userDetails[$userLogin]. "!";
            } else {
                // Выводим сообщение для неизвестного пользователя
                echo "Вы не зарегистрированный пользователь!";
            }
        }
    ?>

</body>
</html>
