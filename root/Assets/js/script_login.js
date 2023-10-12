const message = document.querySelector('.message');
const span = document.querySelector('.message span');

if (span.textContent == "") {
    message.style.animation = 'none';
}