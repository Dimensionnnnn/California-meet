<?php 
    session_start();
    require ('./connect.php');
    require('../utils/function.php');

    $decodedDataRequest = json_decode(file_get_contents('php://input'), true);

    // Получаем идентификаторы пользователей
    $user_id = $decodedDataRequest['user_id'];
    $liked_user_id = $decodedDataRequest['liked_user_id'];

    $query = "DELETE FROM `likes` WHERE userId = $liked_user_id AND likedUserId = $user_id";

    $result = mysqli_query($connect, $query);

    if (!$result) {
        $response = array(
            'success' => false,
            'error' => 'Ошибка удаления записми из таблицы лайков: ' . mysqli_error($connect)
        );
    } else {
        $response = array(
            'success' => true,
            'message' => 'Лайк успешно удален',
        );
    }

    // Отправляем ответ клиенту в формате JSON
    header('Content-Type: application/json');
    echo json_encode($response);

    // Закрываем соединение с базой данных
    mysqli_close($connect);