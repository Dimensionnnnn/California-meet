<?php session_start();?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,500&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,500&family=Unbounded:wght@200;300;400;500;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./styles/matches.css">
    <link rel="stylesheet" href="./styles/normalize.css">
    <title>California</title>
</head>

<body class="matches__body">
    <?php if (empty($_COOKIE['user'])) header('Location: /'); ?>
    <div class="matches__container">
        <aside class="matches__wrapper">
            <nav class="matches__user-info">
                <a class="matches__user-link" onclick="showCurrentUser(`<?= htmlspecialchars(json_encode($_SESSION['user_info'])) ?>`)">
                    <img class="matches__user-img" src="<?= $_SESSION['user_info']['user_img'] ?>" alt="">
                    <h2 class="matches__user-label">
                        <span class="matches__user-name">
                            <?= $_SESSION['user_info']['user_name'] ?>
                        </span>
                    </h2>
                </a>
            </nav>
            <nav class="matches__users-chat">
                <div class="matches__height">
                    <div class="matches__users-wrapper">    
                        <div class="matches__users-buttons">
                            <div class="matches__users-tablist" role="tablist">
                                <div class="matches__users-pair">
                                    <button class="matches__users-button" id="button-pair" role="tab">Пары</button>
                                    <hr class="matches__users-line --active" id="line-pair">
                                </div>
                                <div class="matches__users-message">
                                    <button class="matches__users-button" id="button-message" role="tab">Сообщения</button>
                                    <hr class="matches__users-line" id="line-message">
                                </div>
                            </div>
                        </div>
                        <div class="matches__menu">
                            <div class="matches__menu-wrapper"></div>
                            <div class="matches__messages-wrapper">
                                <div class="matches__messages-list-wrapper"></div>
                            </div>
                        </div>
                    </div>
                    <div class="matches__user-profile">
                        <div class="matches__logout-container">
                            <div class="matches__logout-wrapper">
                                <button class="matches__logout" onclick="logout()">Выйти</button>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </aside>
        <main class="matches__main">
            <div class="matches__h">
                <div class="matches__h">
                    <div class="card__container">
                        <?php require ('./php-components/matches-components/matches-card.php'); ?>
                        <div class="matches__button-container">
                            <?php require('./php-components/matches-components/matches__button.php') ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script async src="./components/matces.js"></script>
    <script async src="./components/matched-users-li.js"></script>
    <script async src="./components/matches-user-profile.js"></script>
</body>

</html>