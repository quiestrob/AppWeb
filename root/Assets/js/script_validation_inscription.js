const closed = document.querySelector('.container-status i');
const container = document.querySelector('.container-status');
const button = document.querySelector('.button-validation');

button.addEventListener('click', () => {
    container.style.opacity = 1;
    container.style.zIndex = 10000;
});

closed.addEventListener('click', () => {
    container.style.opacity = 0;
    container.style.zIndex = -1;
});