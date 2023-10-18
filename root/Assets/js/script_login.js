const message = document.querySelector('.message');
const span = document.querySelector('.message span');

if (span.textContent == "") {
    message.style.animation = 'none';
}

const buttonPlatform = document.querySelector('.container-nav nav .button-inscription');

buttonPlatform.onmousemove = function(e) {
    const x = e.pageX  - buttonPlatform.offsetLeft;
    const y = e.pageY  - buttonPlatform.offsetTop;

    buttonPlatform.style.setProperty('--x', x + 'px');
    buttonPlatform.style.setProperty('--y', y + 'px');
}