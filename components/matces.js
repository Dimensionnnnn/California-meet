const linePair = document.getElementById("line-pair");
const lineMessage = document.getElementById("line-message");

const buttonPair = document.getElementById("button-pair");
const buttonMessage = document.getElementById("button-message");

const menuPair = document.querySelector(".matches__menu-wrapper");
const menuMessages = document.querySelector(".matches__messages-wrapper");

buttonPair.addEventListener("click", () => {
    if (lineMessage.classList.contains("--active")) {
        lineMessage.classList.remove("--active");
        menuMessages.classList.remove("--show");

    }
    if (!linePair.classList.contains("--active")) {
        linePair.classList.add("--active");
        // menuPair.hidden = false;
    }

    menuMessages.classList.remove("show");

    menuPair.classList.remove("hidden");
    menuPair.classList.add("show");
})

buttonMessage.addEventListener("click", () => {
    if (linePair.classList.contains("--active")) {
        linePair.classList.remove("--active");
    }

    if (!lineMessage.classList.contains("--active")) {
        lineMessage.classList.add("--active");
        // menuPair.hidden = true;
    }

    menuPair.classList.remove("show");
    menuPair.classList.add("hidden");

    menuMessages.classList.remove("hidden");
    menuMessages.classList.toggle("show");
})

menuMessages.addEventListener("transitionend", () => {
    if (!menuMessages.classList.contains("show")) {
        menuMessages.classList.add("hidden");
    }
})

const messagesList = document.querySelector('.matches__messages-list')

messagesList.addEventListener("click", (event) => {
    const a = event.target.closest('a');
    if (a) {
        const allLinks = messagesList.querySelectorAll('.matches__messages-link');
        allLinks.forEach((link) => {
            if (link.classList.contains('--hs')) {
                link.classList.remove('--hs');
            } else {
                link.style.backgroundColor = "var(--color-divider-primary, inherit)";
            }
        })

        if (!a.classList.contains('--hs')) {
            a.classList.add('--hs');
        }
    }
})

const card = document.querySelector('.card');
const leftButton = document.querySelector('.button--left');
const rightButton = document.querySelector('.button--right');
let currentIndex = 0;
let users = [];

// Функция для загрузки данных о пользователях из базы данных
function loadUsers() {
    fetch('./vendor/load-users.php?page=0')
      .then(response => response.json())
      .then(data => {
        // Сохраняем полученные данные
        users = data;

        // Обновляем содержимое первой карточки
        updateCard(card, users[currentIndex]);
      })
      .catch(error => console.error(error));
  }

// Функция для обновления содержимого карточки с данными пользователя
function updateCard(card, user) {
    card.querySelector('img').src = "../" + user.userPhoto;
    card.querySelector('h2').textContent = user.userName;
    card.querySelector('h3').textContent = user.userInfo;
    card.querySelector('p').textContent = user.userAge;
  }

// Функция для отображения следующей карточки
function showNextCard() {
    // Удаляем классы swipe-right и swipe-left у текущей карточки
    card.classList.remove('swipe-right', 'swipe-left');

    // Увеличиваем индекс текущей карточки
    currentIndex++;
    
    // Если достигнут конец списка пользователей, загружаем данные из базы данных
    if (currentIndex >= users.length) {
        loadUsers();
        currentIndex = 0;
    } else {
        // Иначе обновляем содержимое следующей карточки
        updateCard(card, users[currentIndex]);
    }
}

showNextCard();

leftButton.addEventListener('click', () => {
    const activeCard = document.querySelector('.card:not(.swipe-right):not(.swipe-left)');
    if (activeCard) {
        activeCard.classList.add('swipe-left');
        // Отображаем следующую карточку после завершения анимации
        setTimeout(showNextCard, 300);
    }
});

rightButton.addEventListener('click', () => {
    const activeCard = document.querySelector('.card:not(.swipe-right):not(.swipe-left)');
    if (activeCard) {
        activeCard.classList.add('swipe-right');
        // Отображаем следующую карточку после завершения анимации 
        setTimeout(showNextCard, 300);

        console.log(sendCurrentUser(getUserId(), users[currentIndex].userId));
    }
});

async function getUserId() {
    try {
        const response = await fetch('./vendor/user-id.php')
        return await response.json()
    } catch (error) {
        console.log(error)
    }
}

async function sendCurrentUser(currentUserId, likedUserId) {
    const currentUserIdResponse = await currentUserId;
    try {
        const response = await fetch('./vendor/user-choose.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                user_id: currentUserIdResponse['user_id'],
                liked_user_id: likedUserId
            })
        })
    } catch (error) {
        console.log(error)
    }
}