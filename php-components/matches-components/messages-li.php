<?php session_start();?>

<li>
    <a draggable="false" class="matches__messages-link" href="#">
        <div class="matches__messages-img-container">
            <div class="matches__messages-img-wrapper">
                <img class="matches__messages-img" src="<?= $_SESSION['user_info']['user_img'] ?>" alt="#">
            </div>
        </div>
        <div class="matches_messages-text-container">
            <div class="matches__messages-name-container">
                <div class="matches__messages-name-wrapper">
                    <h3 class="matches__messages-name">
                        <?= $_SESSION['user_info']['user_name'] ?>
                    </h3>
                </div>
            </div>
            <div class="matches__messages-message">
                Вы образовали пару!
            </div>
        </div>
    </a>
</li>