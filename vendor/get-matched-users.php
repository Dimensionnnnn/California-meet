<?php
    require('./connect.php');

    $response = array();

    $decodedDataRequest = json_decode(file_get_contents('php://input'), true);

    if (isset($decodedDataRequest['user_id'])) {
        $user_id = $decodedDataRequest['user_id'];

        $stmt = mysqli_prepare($connect, "SELECT userInfo.userId, userInfo.userName, userInfo.userPhoto, userInfo.userAge
                                        FROM matches 
                                        INNER JOIN userInfo ON matches.user1Id = userInfo.userId OR matches.user2Id = userInfo.userId
                                        WHERE (matches.user1Id = ? OR matches.user2Id = ?) 
                                        AND userInfo.userId <> ?");
        mysqli_stmt_bind_param($stmt, "iii", $user_id, $user_id, $user_id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if ($result) {
            $response['success'] = true;
            $response['users'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            $response['success'] = false;
            $response['error'] = 'Ошибка получения пользователей из таблицы matches: ' . mysqli_error($connect);
        }
    } else {
        $response['success'] = false;
        $response['error'] = 'Данные не были получены корректно';
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response, JSON_UNESCAPED_UNICODE);