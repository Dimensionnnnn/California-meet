<?php
    session_unset();
    session_destroy();
    setcookie('user', $login, time() - 3600, '/');
    