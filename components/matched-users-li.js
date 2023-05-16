function createMatchedUserLiMenu(user) {
    const li = document.createElement('li');
    li.className = 'matches__menu-elem';
  
    const a = document.createElement('a');
    a.className = 'matches__link';
    a.href = '#';
    li.appendChild(a);
  
    const imgCard = document.createElement('div');
    imgCard.className = 'matches__img-card';
    a.appendChild(imgCard);
  
    const img = document.createElement('img');
    img.className = 'matches__elem-img';
    img.src = '../' + user.userPhoto;
    img.alt = '#';
    imgCard.appendChild(img);
  
    const gradient = document.createElement('div');
    gradient.className = 'matches__elem-gradient';
    a.appendChild(gradient);
  
    const nameContainer = document.createElement('span');
    nameContainer.className = 'matches__elem-name-container';
    a.appendChild(nameContainer);
  
    const nameWrapper = document.createElement('div');
    nameWrapper.className = 'matches__elem-name-wrapper';
    nameContainer.appendChild(nameWrapper);
  
    const name = document.createElement('div');
    name.className = 'matches__elem-name';
    name.textContent = user.userName;
    nameWrapper.appendChild(name);
  
    const id = document.createElement('div');
    id.className = 'matches__elem-id';
    id.hidden = true;
    id.textContent = user.userId;
    nameWrapper.appendChild(id);
  
    return li;
  }

  function createMatchedUserLiMessages(user) {
    const li = document.createElement('li');
    li.className = 'matches__messages-elem';
  
    const a = document.createElement('a');
    a.draggable = false;
    a.className = 'matches__messages-link';
    a.href = '#';
    li.appendChild(a);
  
    const imgContainer = document.createElement('div');
    imgContainer.className = 'matches__messages-img-container';
    a.appendChild(imgContainer);
  
    const imgWrapper = document.createElement('div');
    imgWrapper.className = 'matches__messages-img-wrapper';
    imgContainer.appendChild(imgWrapper);
  
    const img = document.createElement('img');
    img.className = 'matches__messages-img';
    img.src = '../' + user.userPhoto;
    img.alt = '#';
    imgWrapper.appendChild(img);
  
    const textContainer = document.createElement('div');
    textContainer.className = 'matches_messages-text-container';
    a.appendChild(textContainer);
  
    const nameContainer = document.createElement('div');
    nameContainer.className = 'matches__messages-name-container';
    textContainer.appendChild(nameContainer);
  
    const nameWrapper = document.createElement('div');
    nameWrapper.className = 'matches__messages-name-wrapper';
    nameContainer.appendChild(nameWrapper);
  
    const name = document.createElement('h3');
    name.className = 'matches__messages-name';
    name.textContent = user.userName;
    nameWrapper.appendChild(name);
  
    const messageText = document.createElement('div');
    messageText.className = 'matches__messages-message';
    messageText.textContent = "Вы образовали пару!";
    textContainer.appendChild(messageText);
  
    return li;
  }