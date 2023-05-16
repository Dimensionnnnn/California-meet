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
    }

    menuPair.classList.toggle("show");
    menuPair.classList.toggle("hidden");

    menuMessages.classList.remove("hidden");
    menuMessages.classList.toggle("show");
})

menuMessages.addEventListener("transitionend", () => {
    if (!menuMessages.classList.contains("show")) {
        menuMessages.classList.add("hidden");
    }
})

function addEventListenerMessagesList(list) {
    list.addEventListener("click", async (event) => {
        const a = event.target.closest('a');
        if (a) {
            const allLinks = list.querySelectorAll('.matches__messages-link');
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
}

const card = document.querySelector('.card');
const leftButton = document.querySelector('.button--left');
const rightButton = document.querySelector('.button--right');
let currentIndex = 0;
let users = [];

function loadUsers() {
    fetch('./vendor/load-users.php?page=0')
        .then(response => response.json())
        .then(data => {
            users = data;

            console.log(users);
            updateCard(card, users[currentIndex]);
        })
        .catch(error => console.error(error));
}

function updateCard(card, user) {
    card.querySelector('img').src = "../" + user.userPhoto;
    card.querySelector('h2').textContent = user.userName;
    card.querySelector('h3').textContent = user.userInfo;
    card.querySelector('p').textContent = user.userAge;
}

function showNextCard() {
    card.classList.remove('swipe-right', 'swipe-left');
    currentIndex++;

    if (currentIndex >= users.length) {
        loadUsers();
        currentIndex = 0;
    } else {
        updateCard(card, users[currentIndex]);
    }
}

showNextCard();

leftButton.addEventListener('click', async () => {
    const activeCard = document.querySelector('.card:not(.swipe-right):not(.swipe-left)');
    if (activeCard) {
        activeCard.classList.add('swipe-left');
        setTimeout(showNextCard, 300);

        deleteCurrentUser(await getUserId(), users[currentIndex].userId);
    }
});

rightButton.addEventListener('click', async () => {
    const activeCard = document.querySelector('.card:not(.swipe-right):not(.swipe-left)');
    if (activeCard) {
        activeCard.classList.add('swipe-right');
        setTimeout(showNextCard, 300);

        sendCurrentUser(await getUserId(), users[currentIndex].userId);
    }
});

async function getUserId() {
    try {
        const response = await fetch('./vendor/user-id.php')
        const userId = await response.json()
        return userId['user_id']
    } catch (error) {
        console.log(error)
    }
}

async function sendCurrentUser(currentUserId, likedUserId) {
    const url = './vendor/user-choose.php'
    const body = {
        user_id: currentUserId,
        liked_user_id: likedUserId
    }
    try {
        const response = await (await useFetch(url, 'POST', body)).json()

        if (response['match'] === true) {
            deleteCurrentUsersPair(currentUserId, likedUserId);
            loadMatchedUserToMenuAndMessages(users[currentIndex]);
        }

    } catch (error) {
        console.log(error)
    }
}

async function deleteCurrentUsersPair(currentUserId, likedUserId) {
    deleteCurrentUser(likedUserId, currentUserId);
    deleteCurrentUser(currentUserId, likedUserId);
}

async function deleteCurrentUser(currentUserId, likedUserId) {
    const url = './vendor/user-delete.php'
    const body = {
        user_id: currentUserId,
        liked_user_id: likedUserId
    }
    try {
        const response = await useFetch(url, 'DELETE', body)
        console.log(await response.json())
    } catch (error) {
        console.log(error)
    }
}

async function loadMatchedUsers() {
    const url = './vendor/get-matched-users.php'
    const body = {
        user_id: await getUserId()
    }

    try {
        const response = await useFetch(url, 'POST', body)
        loadMatchedUsersToMenuAndMessages(await response.json())
    } catch (error) {
        console.log(error)
    }
}

const menuWrapper = document.querySelector('.matches__menu-wrapper');
const messagesWrapper = document.querySelector('.matches__messages-list-wrapper');

async function loadMatchedUsersToMenuAndMessages(users) {
    try {
        const ulMenu = document.createElement('ul')
        const ulMessages = document.createElement('ul')

        ulMessages.className = 'matches__messages-list'
        ulMenu.className = 'matches__menu-list'

        users['users'].forEach((user) => {
            const [liMenu, liMessages] = getMatchedUserMessagesLi(user)

            ulMenu.appendChild(liMenu)
            ulMessages.appendChild(liMessages)
        })

        menuWrapper.insertBefore(ulMenu, menuWrapper.firstChild);
        messagesWrapper.insertBefore(ulMessages, messagesWrapper.firstChild);

        addEventListenerMessagesList(ulMessages)
        
    } catch (error) {
        console.log(error)
    }
}

async function loadMatchedUserToMenuAndMessages(user) {
    try {
        const ulMenu = document.querySelector('.matches__menu-list')
        const ulMessages = document.querySelector('.matches__messages-list')
        const [liMenu, liMessages] = getMatchedUserMessagesLi(user)

        ulMenu.appendChild(liMenu)
        ulMessages.appendChild(liMessages)
    } catch (error) {
        console.log(error)
    }
}

function getMatchedUserMessagesLi(user) {
    const liMenu = createMatchedUserLiMenu(user)
    const liMessages = createMatchedUserLiMessages(user)

    return [liMenu, liMessages]
}

loadMatchedUsers();

function useFetch(url, method, body) {
    return fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(body)
    })
}