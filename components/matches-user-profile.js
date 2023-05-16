const profileButton = document.querySelector('.matches__user-link');
const profileField = document.querySelector('.matches__user-profile');
const matchesButton = document.querySelector('.matches__button-container');


profileButton.addEventListener('click', () => {
    profileField.classList.toggle('show');
    matchesButton.classList.toggle('--mbc-dn')
})

let currentUserShowed = false;

function showCurrentUser(user_info) {
    const user = {}
    if (!currentUserShowed) {
        const userInfo = JSON.parse(user_info)
        user.userName = userInfo['user_name']
        user.userAge = userInfo['user_age']
        user.userPhoto = userInfo['user_img']
        user.userInfo = userInfo['user_info']

        currentUserShowed = true
    } else {
        user.userName = users[currentIndex].userName
        user.userAge = users[currentIndex].userAge
        user.userPhoto = users[currentIndex].userPhoto
        user.userInfo = users[currentIndex].userInfo

        currentUserShowed = false
    }

    updateCard(card, user);
}

async function logout() {
    try {
        const response = await fetch('./vendor/logout.php');

        document.cookie = 'user=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        sessionStorage.clear();
        window.location.href = '/';
        
    } catch (error) {
        console.error(error)
    }
}