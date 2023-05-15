<?php
    setcookie('user', $login, time() - 3600, "/");
    session_unset();
    header('Location: /');
?>