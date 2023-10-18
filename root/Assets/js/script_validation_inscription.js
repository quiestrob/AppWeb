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

const buttonPlatform = document.querySelector('.button-platform');
const span = document.querySelector('.hidden');

buttonPlatform.addEventListener('click', () => {
    if (span.textContent.replace(/\s/g, "") === 'Pendiente') {
        container.style.opacity = 1;
        container.style.zIndex = 10000;
    } else {
        window.location.href = '../../root/pages/platform.php';
    }
});