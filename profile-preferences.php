<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/profile-preferences.css">
    <title>Настройка предпочтений</title>
</head>
<body>
    <div class="form__container">
        <div class="form__wrapper">
            <form action="./vendor/preferences.php" class="form__configuration" method="post">
                <label class="form__label form__label-header">Укажите параметры того, кто вам интересен!</label>
                <label class="form__label">Возраст</label>
                <div class="form__input-container">
                    <div class="form__input-wrapper">
                        <span class="form__range-value" id="rangeValueF">18</span>
                        <div class="form__input-info">
                            <label class="form__input-label">От</label>
                            <input class="form__input-range" value="18" type="range" id="user-input-from" name='user-age-from' min='18' max='98' onchange="rangeSlideFrom(this.value)"/>
                        </div>
                    </div>
                    <div class="form__input-wrapper">
                        <span class="form__range-value" id="rangeValueT">98</span>
                        <div class="form__input-info">
                            <label class="form__input-label">До</label>
                            <input class="form__input-range" value="98" type="range" id="user-input-to" name='user-age-to' min='18' max='98' onchange="rangeSlideTo(this.value)"/>
                        </div>
                    </div>
                </div>
                <label class="form__label">Пол</label>
                <select required class="form__select" name="user-gender">
                    <option value="0">Мужской</option>
                    <option value="1">Женский</option>
                    <option value="2">Любой</option>
                </select>
                <button class="form__button" type="submit">Сохранить</button>
            </form>
        </div>
    </div>
    <script src="./components/slider-range.js" async></script>
</body>
</html>