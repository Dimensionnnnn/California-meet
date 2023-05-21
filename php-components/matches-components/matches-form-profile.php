<?php session_start(); ?>

<form action="../../vendor/profile-change.php" class="form__configuration" method="POST" enctype="multipart/form-data">
    <label class="form__label">Имя</label>
    <input class="form__input" type="text" name="user-name" value="<?= $_SESSION['user_info']['user_name'] ?>">
    <label class="form__label">Возраст</label>
    <input required class="form__input" type="number" name="user-age" value="<?= $_SESSION['user_info']['user_age'] ?>" placeholder="Вы должны быть старше 18 лет!">
    <label class="form__label">Фото</label> 
    <input class="form__input" type="file" name="user-img" accept="image/png, image/gif, image/jpeg">
    <label class="form__label">Информация о себе</label>
    <input class="form__input" type="text" name="user-info" value="<?= $_SESSION['user_info']['user_info'] ?>" placeholder="Напишите что-нибудь интересное!">
    <button class="form__button" type="submit">Сохранить</button>
</form>