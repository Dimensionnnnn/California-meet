<?php 
    session_start();
    require ('./connect.php');
    require('../utils/function.php');

    $response = array();

    $decodedDataRequest = json_decode(file_get_contents('php://input'), true);

    $user_id = $decodedDataRequest['user_id'];
    $liked_user_id = $decodedDataRequest['liked_user_id'];

    $stmt = mysqli_prepare($connect, "INSERT INTO likes (userId, likedUserId, likedAt) VALUES (?, ?, NOW())");
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $liked_user_id);
    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        $response['success'] = false;
        $response['error'] = 'Ошибка добавления записи в таблицу лайков: ' . mysqli_error($connect);
    } else {
        $match = false;

        $stmt = mysqli_prepare($connect, "SELECT * FROM likes WHERE userId = ? AND likedUserId = ?");
        mysqli_stmt_bind_param($stmt, "ii", $liked_user_id, $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $stmt = mysqli_prepare($connect, "INSERT INTO matches (user1Id, user2Id, matchedAt) VALUES (?, ?, NOW())");
            mysqli_stmt_bind_param($stmt, "ii", $user_id, $liked_user_id);
            $result = mysqli_stmt_execute($stmt);

            if (!$result) {
                $response['success'] = false;
                $response['error'] = 'Ошибка добавления записи в таблицу матчей: ' . mysqli_error($connect);
                $response['match'] = $match;
            } else {
                $match = true;
                $response['success'] = true;
                $response['message'] = 'Мэтч успешно добавлен';
                $response['match'] = $match;
            }
        } else {
            $response['success'] = true;
            $response['message'] = 'Лайк успешно добавлен';
            $response['match'] = $match;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($response);