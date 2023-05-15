const footer = `
<div class="container">
    <div class="footer__wrapper">
        <ul class="footer__list">
            <div class="footer__list-title">Социальные сети</div>
            <div class="footer__list-social">
                <li class="footer__social-elem">
                    <a href="#" class="footer__list-link">
                        <img src="./source/images/footer/icon _github.svg" alt="github">
                    </a>
                </li>
                <li class="footer__social-elem">
                    <a href="#" class="footer__list-link">
                        <img src="./source/images/footer/icon _twitter outline.svg" alt="twitter">
                    </a>
                </li>
                <li class="footer__social-elem">
                    <a href="#" class="footer__list-link">
                        <img src="./source/images/footer/icon _facebook.svg" alt="facebook">    
                    </a>
                </li>
                <li class="footer__social-elem">
                    <a href="#" class="footer__list-link">
                        <img src="./source/images/footer/icon _email.svg" alt="email">
                    </a>
                </li>
            </div>
        </ul>
        <ul class="footer__list">
            <div class="footer__list-title">Карьера</div>
            <li class="footer__list-elem">
                <a href="#" class="footer__list-link">Карьера</a>
            </li>
        </ul>
        <ul class="footer__list">
            <li class="footer__list-elem">
                <a href="#" class="footer__list-link">Частые вопросы</a>
            </li>
            <li class="footer__list-elem">
                <a href="#" class="footer__list-link">Страны</a>
            </li>
            <li class="footer__list-elem">
                <a href="#" class="footer__list-link">Контакты</a>
            </li>
        </ul>
    </div>
</div>
`

const footer_obj = document.createElement('footer')
footer_obj.innerHTML = footer
document.body.insertAdjacentElement('beforeend', footer_obj)