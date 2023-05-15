<?php
    session_start();
    require_once ('./connect.php');
    require_once ('../utils/function.php');

    $user_id = $_SESSION['user_id'];

    $user_age_from = $_POST['user-age-from'];
    $user_age_to = $_POST['user-age-to'];
    $user_gender = $_POST['user-gender'];

    set_user_preference($connect, $user_id, $user_age_from, $user_age_to, $user_gender);

    header('Location: ../matches.php');