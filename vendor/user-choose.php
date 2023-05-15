<?php 
    session_start();
    require ('./connect.php');
    require('../utils/function.php');

    $decodedDataRequest = json_decode(file_get_contents('php://input'), true);

    // Получаем идентификаторы пользователей
    $user_id = $decodedDataRequest['user_id'];
    $liked_user_id = $decodedDataRequest['liked_user_id'];

    // Добавляем запись в таблицу лайков
    $query = "INSERT INTO likes (userId, likedUserId, likedAt) VALUES ($user_id, $liked_user_id, NOW())";
    $result = mysqli_query($connect, $query);
    $match = false;

    // Проверяем, удалось ли добавить запись в таблицу лайков
    if (!$result) {
        $response = array(
            'success' => false,
            'error' => 'Ошибка добавления записи в таблицу лайков: ' . mysqli_error($connect)
        );
    } else {
        // Проверяем, лайкнул ли пользователь, который был лайкнут, пользователя, который лайкнул его
        $query = "SELECT * FROM likes WHERE userId = $liked_user_id AND likedUserId = $user_id";
        $result = mysqli_query($connect, $query);

        // Проверяем, был ли найден матч
        if (mysqli_num_rows($result) > 0) {
            // Добавляем запись в таблицу матчей
            $query = "INSERT INTO matches (user1Id, user2Id, matchedAt) VALUES ($user_id, $liked_user_id, NOW())";
            $result = mysqli_query($connect, $query);

            // Проверяем, удалось ли добавить запись в таблицу матчей
            if (!$result) {
                $response = array(
                    'success' => false,
                    'error' => 'Ошибка добавления записи в таблицу матчей: ' . mysqli_error($connect),
                    'match' => $match
                );
            } else {
                $match = true;
                $response = array(
                    'success' => true,
                    'message' => 'Мэтч успешно добавлен',
                    'match' => $match
                );
            }
        } else {
            $response = array(
                'success' => true,
                'message' => 'Лайк успешно добавлен',
                'match' => $match
            );
        }
    }

    // Отправляем ответ клиенту в формате JSON
    header('Content-Type: application/json');
    echo json_encode($response);

    // Закрываем соединение с базой данных
    mysqli_close($connect);