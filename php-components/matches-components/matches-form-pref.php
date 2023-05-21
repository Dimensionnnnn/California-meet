<?php  session_start(); ?>

<form action="../../vendor/preference-change.php" class="form__configuration" method="POST">
    <label for="" class="form__label">Возраст</label>
    <div class="form__input-container">
        <div class="form__input-wrapper">
            <span class="form__range-value" id="rangeValueF"><?= $_SESSION['user_preference']['user_age_from'] ?></span>
            <div class="form__input-info">
                <label class="form__input-label">От</label>
                <input class="form__input-range" value="<?= $_SESSION['user_preference']['user_age_from'] ?>" type="range" id="user-input-from" name='user-age-from' min='18' max='<?= $_SESSION['user_preference']['user_age_to'] ?>' onchange="rangeSlideFrom(this.value)"/>
            </div>
        </div>
        <div class="form__input-wrapper">
            <span class="form__range-value" id="rangeValueT"><?= $_SESSION['user_preference']['user_age_to'] ?></span>
            <div class="form__input-info">
                <label class="form__input-label">До</label>
                <input class="form__input-range" value="<?= $_SESSION['user_preference']['user_age_to'] ?>" type="range" id="user-input-to" name='user-age-to' min='<?= $_SESSION['user_preference']['user_age_from'] ?>' max='98' onchange="rangeSlideTo(this.value)"/>
            </div>
        </div>
    </div>
    <label class="form__label">Пол</label>
    <select required class="form__select" name="user-gender">
        <option value="0">Мужской</option>
        <option value="1">Женский</option>
        <option value="2" selected>Любой</option>
    </select>
    <button class="form__button" type="submit">Сохранить</button>
</form>