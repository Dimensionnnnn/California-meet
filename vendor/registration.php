<?php
    session_start();
    require_once('./connect.php');
    require_once('../utils/function.php');

    $login = $_POST['login'];

    $user = mysqli_query($connect, "SELECT * FROM `user` WHERE `login` = '$login'");
    $user = mysqli_fetch_array($user);

    if ($user['login'] == $login) {
        echo("Пользователь с таким логином уже зарегистрирован!");
        exit();
    }

    $password = md5($_POST['password']);

    mysqli_query($connect, "INSERT INTO `user` (`id`, `login`, `password`) VALUES (NULL, '$login', '$password')");

    $_SESSION['user_id'] = get_user_id($connect, $login);

    header('Location: ../profile-config-registr.php');

    setcookie('user', $login, time() + 3600, "/");