<?php
    session_start();
    require_once('./connect.php');
    require_once('../utils/function.php');

    $login = $_POST['login'];
    $password = md5($_POST['password']);

    $stmt = mysqli_prepare($connect, "SELECT * FROM `user` WHERE `login` = ? AND `password` = ?");
    mysqli_stmt_bind_param($stmt, "ss", $login, $password);
    mysqli_stmt_execute($stmt);
    $check_user = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($check_user) == 0) {
        echo('Такой пользователь не найден или введен неверный пароль!');
        exit();
    }

    $check_user = mysqli_fetch_array($check_user);

    header('Location: ../matches.php');

    $_SESSION['user_id'] = get_user_id($connect, $login);

    $tmp_obj = get_user_info($connect, $_SESSION['user_id']);

    if ($tmp_obj) {
        $_SESSION['user_info'] = $tmp_obj;
    }

    setcookie('user', $login, time() + 3600, "/");