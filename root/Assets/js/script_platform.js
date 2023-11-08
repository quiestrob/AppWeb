//Mostrar seccion selecionada
const section = document.querySelectorAll('.container-sections section');
const nav = document.querySelectorAll('.navegation .nav');

for (let i = 0; i < nav.length; i++) { 
    nav[i].addEventListener('click', ()=> {
        for (let j = 0; j < nav.length; j++) {
            
            section[j].style.opacity = 0;
            section[j].style.zIndex = -1;
        }

        
        section[i].style.opacity = 1;
        section[i].style.zIndex = 1;
    });

    section[i].style.opacity = 0;
    section[i].style.zIndex = -1;  
} 

const button = document.querySelector('.logout span');


//Funcion boton cerrar sesion
button.addEventListener('click', ()=> {
    window.location.href = '../../root/pages/session_destroy.php';
});

//Marcar opcion seleccionada
nav.forEach(function(navClick) {
    navClick.addEventListener('click', ()=> {
        const nav = document.querySelectorAll('.navegation .nav');

        for (var i = 0; nav.length; i++) {
            const current = nav[i];

            if (current === navClick) {
                current.setAttribute('id', 'selected');
            } else {
                if (current.id === "selected") {
                    current.removeAttribute('id');
                }
            }
        }
    });
}); 

//Mostrar mensajes
const mensajes = document.querySelector('.container-messages');
const iconMessage = document.querySelector('.container-profile .options i');
const container = document.querySelector('.container-sections');

console.log(iconMessage);

iconMessage.addEventListener('click', ()=> {
    mensajes.style.opacity = 1;
    mensajes.style.zIndex = 100;
});

container.addEventListener('click', ()=> {
    mensajes.style.opacity = 0;
    mensajes.style.zIndex = -1;
});

//Ocultar opciones segun tipo de usuario
const type = document.querySelector('.container-profile span:nth-child(2)');
const navInscription = document.querySelector('.navegation .nav-inscriptions');
const navStudents = document.querySelector('.navegation .nav-students');


if (type.textContent === 'Acudiente' || type.textContent === 'Profesor' || type.textContent === 'Estudiante') {
    navInscription.style.display = 'none';
}

if (type.textContent === 'Acudiente' || type.textContent === 'Estudiante'){
    navStudents.style.display = 'none';
}

//Manejar respuesta botones inscripcion
function accept(id, identificacion, idI) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../../controllers/EstadoController.php?estado=" + id + "&action=Aceptar" + "&fundador=" + identificacion + "&id=" + idI, true);

    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            const content = document.querySelector('#section-inscriptions .section-content');
            content.innerHTML = xhr.responseText;

            updateInscription();
        }
    };

    xhr.send();
}

function decline(id, identificacion, idI) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../../controllers/EstadoController.php?estado=" + id + "&action=Rechazar" + "&fundador=" + identificacion + "&id=" + idI, true);

    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            const content = document.querySelector('#section-inscriptions .section-content');
            content.innerHTML = xhr.responseText;

            updateInscription();
        }
    };

    xhr.send();
}

function updateInscription() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../../controllers/InscripcionController.php", true);

    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            
        }
    };

    xhr.send();
}

//Animacion boton aceptar y eliminar
const buttonAccept = document.querySelectorAll('#section-inscriptions .button-accept');
const buttonDecline = document.querySelectorAll('#section-inscriptions .button-decline');

buttonAccept.forEach((e) => {
    e.addEventListener('click', () => {
        e.classList.add('active');
    });
});

for (let i = 0; i < buttonDecline.length; i++) {
    if (buttonDecline[i].classList.contains('active')) {
        buttonAccept[i].style.display = 'none';
    }

    buttonDecline[i].addEventListener('click', () => { 
        if (buttonDecline[i].classList.contains('active')) {
            
        } else {
            buttonDecline[i].classList.add('active');
            buttonAccept[i].style.display = 'none';
            console.log(i);
        } 
    });
}

//Visualizacion de grupo estudiante
const ident = document.querySelector('.section-content .card .content .identification a');
const group = document.querySelector('.section-content .card .content .group a');

ident.addEventListener('click', ()=> {
    group.style.opacity = 1;
    group.style.zIndex = 2;
});

group.addEventListener('click', ()=> {
    group.style.opacity = 0;
    group.style.zIndex = 0;
});

