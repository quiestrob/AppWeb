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

//Abrir chat
const chat = document.querySelector('.container-chat');
const chatUser = document.querySelectorAll('.container-messages .profile-message');

const idTransmitter = document.querySelectorAll('#idTransmitter');
const idReceiver = document.querySelectorAll('#idReceiver');

const messageTransmitter = document.querySelector('#messageTransmitter');
const messageReceiver = document.querySelector('#messageReceiver');

for (let i = 0; i < chatUser.length; i++) {
    chatUser[i].addEventListener('click', ()=> {
        chat.style.opacity = 1;
        chat.style.zIndex = 1000;

        messageTransmitter.value = idTransmitter[i].value;
        messageReceiver.value = idReceiver[i].value;

        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../../controllers/MensajeController.php?transmitter=" + idTransmitter[i].value + "&receiver=" + idReceiver[i].value + "&action=Listar", true);

        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const content = document.getElementById('content-messages');
                content.innerHTML = xhr.responseText;

                const trMessage = document.querySelectorAll('.container-chat .container-content tr');
                const textMessage = document.querySelectorAll('.container-chat .container-content td span');
                const nameMessage = document.querySelector('.container-profile .content-profile span:nth-child(1)');
                const colorMessage = document.querySelectorAll('.container-chat .container-content #content-messages td');
                
                for (let i = 0; i < textMessage.length; i++) {
                    if (textMessage[i].textContent === nameMessage.textContent + ":") {
                        colorMessage[i].style.background = '#7E57C2';
                        textMessage[i].style.right = '12px';
                        trMessage[i].style.textAlign = 'right'; 
                    } else {
                        colorMessage[i].style.background = '#D1C4E9';
                    }
                }    
            }
        };

        xhr.send();
    });
}

//Cerrar chat
const closeChat = document.querySelector('.container-chat__title h2');

closeChat.addEventListener('click', ()=> {
    chat.style.opacity = 0;
    chat.style.zIndex = -1;
});

//Mostrar mensajes
const mensajes = document.querySelector('.container-messages');
const iconMessage = document.querySelector('.container-profile .options i');
const container = document.querySelector('.container-sections');

iconMessage.addEventListener('click', ()=> {
    mensajes.style.opacity = 1;
    mensajes.style.zIndex = 100;
    chat.style.right = '15%';
});

container.addEventListener('click', ()=> {
    mensajes.style.opacity = 0;
    mensajes.style.zIndex = -1;
    chat.style.right = '2%';
});

//Enviar mensaje
const buttonSend = document.querySelector('.container-chat .container-send i');
const inputMessage = document.getElementById('message-content');

buttonSend.addEventListener('click', ()=> {
    if (inputMessage.value != '') {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../../controllers/MensajeController.php?transmitter=" + messageTransmitter.value + "&receiver=" + messageReceiver.value + "&message=" + inputMessage.value + "&action=Enviar", true);

        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const content = document.getElementById('content-messages');
                content.innerHTML = xhr.responseText;

                const trMessage = document.querySelectorAll('.container-chat .container-content tr');
                const textMessage = document.querySelectorAll('.container-chat .container-content td span');
                const nameMessage = document.querySelector('.container-profile .content-profile span:nth-child(1)');
                const colorMessage = document.querySelectorAll('.container-chat .container-content #content-messages td');

                for (let i = 0; i < textMessage.length; i++) {
                    if (textMessage[i].textContent === nameMessage.textContent + ":") {
                        colorMessage[i].style.background = '#7E57C2';
                        textMessage[i].style.right = '12px';
                        trMessage[i].style.textAlign = 'right'; 
                    } else {
                        colorMessage[i].style.background = '#D1C4E9';
                    }
                } 
            }
        };

        xhr.send();

        inputMessage.value = '';
    } 
});

//Abrir edicion perfil
const editContainerProfile = document.querySelector('.container-edit-profile');
const editContainerActivity = document.querySelector('.container-edit-activity');
const openEdit = document.querySelector('.container-content .container-sections .section-content .container-information .information .span-information:last-child');

openEdit.addEventListener('click', ()=> {
    editContainerProfile.style.zIndex = 100;
});

//Cerrar edicion perfil
const closeEditProfile = document.querySelector('.container-edit-profile .close-edit i');
const closeEditActivity = document.querySelector('.container-edit-activity .close-edit i');

closeEditProfile.addEventListener('click', ()=> {
    editContainerProfile.style.zIndex = -1;
});

closeEditActivity.addEventListener('click', ()=> {
    editContainerActivity.style.zIndex = -1;
});

//Visualizacion de grupo estudiante
const showIdent = document.querySelector('.section-content .card .content .identification a');
const showGroup = document.querySelector('.section-content .card .content .group a');

showIdent.addEventListener('click', ()=> {
    showGroup.style.opacity = 1;
    showGroup.style.zIndex = 100;
});

showGroup.addEventListener('click', ()=> {
    showGroup.style.opacity = 0;
    showGroup.style.zIndex = 0;
});

//Ocultar opcion mensajes
const options = document.querySelector('.container-profile .options');
const spanOption = document.querySelector('.container-profile .content-profile span:nth-child(2)');

if (spanOption.textContent.replace(/\s/g, "") === 'Profesor' || spanOption.textContent.replace(/\s/g, "") === 'Acudiente') {
    
} else {
    options.style.display = 'none'
}

function openEditActivity() {
    const editContainerActivity = document.querySelector('.container-edit-activity');
    editContainerActivity.style.zIndex = 100;
}