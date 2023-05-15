const authObj = document.getElementById('auth-obj');
const regObj = document.getElementById('reg-obj');

const authForm = document.getElementById('auth-form');
const regForm = document.getElementById('reg-form');

const authButton = document.getElementById('button-login');
const regButton = document.getElementById('button-reg');

const showModalAuthWindow = () => {
    authObj.classList.toggle('--active');
}

const showModalRegWindow = () => {
    regObj.classList.toggle('--active');
}

document.addEventListener('click', (event) => {
    if (!event.composedPath().includes(authForm) && !event.composedPath().includes(authButton)) {
        authObj.classList.remove('--active');
    }

    if (!event.composedPath().includes(regForm) && !event.composedPath().includes(regButton)) {
        regObj.classList.remove('--active');
    }
})