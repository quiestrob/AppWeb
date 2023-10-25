//Funcion mostrar estado de inscripcion
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


//Mostrar boton plataforma segun estado de inscripcion
const buttonPlatform = document.querySelector('.button-platform');
const span = document.querySelector('.hidden');

if (span.textContent.replace(/\s/g, "") === 'Pendiente') {
    buttonPlatform.style.display = 'none'
} else {
    buttonPlatform.addEventListener('click', () => {
        window.location.href = '../../root/pages/platform.php';
    });
}

//Animacion botones
const buttonInscription = document.querySelector('.button-validation');
const buttonPlatform2 = document.querySelector('.container-nav nav .button-inscription');

buttonPlatform.onmousemove = function(e) {
    const x = e.pageX  - buttonPlatform.offsetLeft;
    const y = e.pageY  - buttonPlatform.offsetTop;

    buttonPlatform.style.setProperty('--x', x + 'px');
    buttonPlatform.style.setProperty('--y', y + 'px');
}

buttonInscription.onmousemove = function(e) {
    const x = e.pageX  - buttonInscription.offsetLeft;
    const y = e.pageY  - buttonInscription.offsetTop;

    buttonInscription.style.setProperty('--x', x + 'px');
    buttonInscription.style.setProperty('--y', y + 'px');
}

buttonPlatform2.onmousemove = function(e) {
    const x = e.pageX  - buttonPlatform2.offsetLeft;
    const y = e.pageY  - buttonPlatform2.offsetTop;

    buttonPlatform2.style.setProperty('--x', x + 'px');
    buttonPlatform2.style.setProperty('--y', y + 'px');
}

//Mostrar boton de estado segun tipo de usuario
const spanType = document.querySelector('.hidden-type');
const type = spanType.textContent.replace(/\s/g, "");

if (type === 'Administrador' || type === 'Profesor') {
    buttonInscription.style.display = 'none';
} else {
    //El boton se mostrara normalmente
}