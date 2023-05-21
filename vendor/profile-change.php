<?php
    session_start();
    require_once ('./connect.php');
    require_once ('../utils/function.php');
    
    $user_id = $_SESSION['user_id'];

    $user_name = $_POST['user-name'] == $_SESSION['user_info']['user_name'] ? -1 : $_POST['user-name'];
    $user_age = $_POST['user-age'] == $_SESSION['user_info']['user_age'] ? -1 : $_POST['user-age']; 
    $user_info = $_POST['user-info'] == $_SESSION['user_info']['user_info'] ? -1 : $_POST['user-info'];

    print_r($_FILES['user-img']['name']);

    $path = -1;
    $path_img = '';

    if (!empty($_FILES['user-img']['name'])) {
        $path = "uploads/users-photo" . time() . $_FILES['user-img']['name'];
        $path_img = '../' . $path;
        move_uploaded_file($_FILES['user-img']['tmp_name'], $path_img);
    }

    $user_profile = [
        'user_id' => $user_id,
        'user_name' => $user_name,
        'user_age' => $user_age,
        'user_info' => $user_info,
        'user_img' => $path
    ];

    change_profile($connect, $user_profile);
    header('Location: ../matches.php');