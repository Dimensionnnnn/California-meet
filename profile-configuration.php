<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/profile-configuration.css">
    <title>Настройка профиля</title>
</head>
<body>
    <div class="form__container">
        <div class="form__wrapper">
            <form action="./vendor/profile-config.php" class="form__configuration" method="post">
                <label class="form__label">Имя</label>
                <input class="form__input" type="text" name="user-name">
                <label class="form__label">Возраст</label>
                <input class="form__input" type="number" name="user-age" placeholder="Вы должны быть старше 18 лет!">
                <label class="form__label">Фото</label>
                <input class="form__input" type="file" name="user-img" accept="image/png, image/gif, image/jpeg">
                <label class="form__label">Информация о себе</label>
                <input class="form__input" type="text" name="user-info" placeholder="Напишите что-нибудь интересное!">
                <button class="form__button" type="submit">Сохранить</button>
            </form>
        </div>
    </div>
</body>
</html>