<?php require('header.php'); ?>

    <main class="main">
        <div class="container">
            <div class="main__wrapper">
                <div class="main__text">Присоединиться</div>
                <button class="main__button" id="button-reg" onclick="showModalRegWindow()">
                    <div class="main__button-text">
                        Создать аккаунт
                    </div>
                </button>
            </div>
        </div>
        <div class="container">
            <div class="main__wrapper-info">
                <div class="main__info-text">
                    <?php require('./php-components/index-components/index-slider.php') ?>
                </div>
            </div>
        </div>
    </main>
<?php
    require('footer.php');
    require('authorization-form.php');
    require('registration-form.php');
?>