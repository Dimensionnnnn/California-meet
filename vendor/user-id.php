<?php 
    session_start();
    $user = ['user_id' => $_SESSION['user_id']];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($user, JSON_UNESCAPED_UNICODE);