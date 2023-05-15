<?php
    session_start();
    require_once('./connect.php');
    require_once('../utils/function.php');

    $user_id = $_SESSION['user_id'];

    $user_name = $_POST['user-name'];
    $user_age = $_POST['user-age'];
    $user_gender = $_POST['user-gender'];
    $user_info = $_POST['user-info'];

    $path = "uploads/users-photo" . time() . $_FILES['user-img']['name'];
    $path_img = '../' . $path;
    move_uploaded_file($_FILES['user-img']['tmp_name'], $path_img);

    set_user_config_reg($connect, $user_id, $user_name, $user_age, $user_gender, $path, $user_info);

    $_SESSION['user_info'] = [
        'user_name' => $user_name,
        'user_age' => $user_age,
        'user_gender' => $user_gender,
        'user_info' => $user_info,
        'user_img' => $path_img
    ];

    header('Location: ../profile-preferences.php');