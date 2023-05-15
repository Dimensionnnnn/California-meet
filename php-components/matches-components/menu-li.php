<?php session_start();?>

<li class="matches__menu-elem">
    <a class="matches__link" href="#">
        <div class="matches__img-card">
            <img class="matches__elem-img" src="<?= $_SESSION['user_info']['user_img'] ?>" alt="#">
        </div>
        <div class="matches__elem-gradient"></div>
        <span class="matches__elem-name-container">
            <div class="matches__elem-name-wrapper">
                <div class="matches__elem-name">
                    <?= $_SESSION['user_info']['user_name'] ?>
                </div>
            </div>
        </span>
    </a>
</li>