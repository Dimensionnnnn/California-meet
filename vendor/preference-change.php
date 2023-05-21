<?php
    session_start();
    require_once ('./connect.php');
    require_once ('../utils/function.php');

    $user_age_from = $_POST['user-age-from'] == $_SESSION['user_preference']['user_age_from'] ? -1 : $_POST['user-age-from'];
    $user_age_to = $_POST['user-age-to'] == $_SESSION['user_preference']['user_age_to'] ? -1 : $_POST['user-age-to'];
    $user_gender = $_POST['user-gender'] == $_SESSION['user_preference']['user_gender'] ? -1 : $_POST['user-gender'];

    $user_preference = [
        'user_id' => $_SESSION['user_id'],
        'user_age_from' => $user_age_from,
        'user_age_to' => $user_age_to,
        'user_gender' => $user_gender
    ];

    change_preference($connect, $user_preference);

    header('Location: ../matches.php');
