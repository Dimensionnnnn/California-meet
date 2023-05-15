<?php 
    session_start();
    require ('./connect.php');
    require('../utils/function.php');

    $_SESSION['users'] = load_users($connect, $_SESSION['user_id']);

    $user_id = $_SESSION['user_id'];
    $user_preferences = get_user_preferences($connect, $user_id);

    $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
    $limit = 10; // количество пользователей, которые нужно получить
    $offset = $page * $limit; // смещение
    
    // Формируем запрос к базе данных
    $query = "SELECT * FROM userInfo WHERE userId NOT LIKE $user_id AND userAge BETWEEN {$user_preferences['user_age_from']} AND {$user_preferences['user_age_to']}";

    if ($user_preferences['user_gender'] != 2) {
        $query .= " AND userGender = {$user_preferences['user_gender']}";
    }

    $query .= " LIMIT $offset, $limit";


    $result = mysqli_query($connect, $query);
    $users = array();
    
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    
    // Используем json_last_error() и json_last_error_msg() для проверки ошибок кодирования JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        die(json_last_error_msg());
    }
    
    // Устанавливаем заголовок Content-Type для ответа
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($users, JSON_UNESCAPED_UNICODE);