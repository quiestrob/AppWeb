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
const navDonations = document.querySelector('.navegation .nav-donations');
const separator = document.querySelector('.navegation .separator');

if (type.textContent === 'Acudiente' || type.textContent === 'Profesor' || type.textContent === 'Estudiante') {
    navInscription.style.display = 'none';
}

if (type.textContent === 'Acudiente' || type.textContent === 'Estudiante'){
    navStudents.style.display = 'none';
}

if (type.textContent === 'Estudiante') {
    navDonations.style.display = 'none';
    separator.style.display = 'none';
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

//Mostrar mensajes
const mensajes = document.querySelector('.container-messages');
const iconMessage = document.querySelector('.container-profile .options i');
const container = document.querySelector('.container-sections');

iconMessage.addEventListener('click', ()=> {
    mensajes.style.opacity = 1;
    mensajes.style.zIndex = 100;
});

container.addEventListener('click', ()=> {
    mensajes.style.opacity = 0;
    mensajes.style.zIndex = -1;
});

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

        mensajes.style.opacity = 0;
        mensajes.style.zIndex = -1;

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

//Ocultar opcion mensajes
const options = document.querySelector('.container-profile .options');
const spanOption = document.querySelector('.container-profile .content-profile span:nth-child(2)');

if (spanOption.textContent.replace(/\s/g, "") === 'Profesor' || spanOption.textContent.replace(/\s/g, "") === 'Acudiente') {
    
} else {
    options.style.display = 'none'
}

const valueDonation = document.querySelector('.container-content .container-sections .section-content .container-donation input');
const identificationUser = document.querySelector('#section-information .span-information:nth-child(2) span');

paypal.Buttons({
    style: {
        color: 'blue'
    },
    
    createOrder: function (data, actions) {
        let value = valueDonation.value;

        if (value && !isNaN(value) && parseFloat(value) > 0) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: value
                    }
                }]
            });
        } 
    },
    
    onApprove: function(data, actions) {
        actions.order.capture().then(function (detalles){
            let value = valueDonation.value;

            const xhr = new XMLHttpRequest();
            xhr.open("GET", "../../controllers/DonacionController.php?monto=" + value + "&identification=" + identificationUser.textContent +  "&type=" + spanOption.textContent.replace(/\s/g, "") + "&action=Guardar", true);

            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    const donation = document.querySelector('.container-data-donations');
                    donation.innerHTML = xhr.responseText;
                }
            };

            xhr.send();

            valueDonation.value = null;
        });
    },
    
    onCancel: function(data) {
        valueDonation.value = null;
    }
}).render('#paypal-button-container');

if (spanOption.textContent.replace(/\s/g, "") === 'Profesor' || spanOption.textContent.replace(/\s/g, "") === 'Acudiente') {
    const professorNombre = document.querySelector('.container-edit-profile #name');
    const professorIdentification = document.querySelector('.container-edit-profile #identification');
    const professorPhone = document.querySelector('.container-edit-profile #phone');
    const professorMail = document.querySelector('.container-edit-profile #email');
    const professorPass = document.querySelector('.container-edit-profile #pass');
    const professorAddress = document.querySelector('.container-edit-profile #address');

    const proffesorButton = document.querySelector('.container-edit-profile #actionProffesor');

    proffesorButton.addEventListener('click', ()=> {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../../controllers/UsuarioController.php?identification=" + professorIdentification.value + "&name=" + professorNombre.value +  "&phone=" + professorPhone.value + "&mail=" + professorMail.value + "&address=" + professorAddress.value + "&pass=" + professorPass.value + "&action=Editar", true);

        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                editContainerProfile.style.zIndex = -1;

                const information = document.querySelector('.container-information');
                information.innerHTML = xhr.responseText;
            }
        };

        xhr.send();
    });
} else if (spanOption.textContent.replace(/\s/g, "") === 'Administrador') {
    //Editar administrador
    const adminNombre = document.querySelector('.container-edit-profile #name');
    const adminIdentification = document.querySelector('.container-edit-profile #identification');
    const adminMail = document.querySelector('.container-edit-profile #email');
    const adminPass = document.querySelector('.container-edit-profile #pass');

    const adminButton = document.querySelector('.container-edit-profile #actionAdmin');

    adminButton.addEventListener('click', ()=> {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../../controllers/FundadorController.php?identification=" + adminIdentification.value + "&name=" + adminNombre.value + "&mail=" + adminMail.value + "&pass=" + adminPass.value, true);

        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                editContainerProfile.style.zIndex = -1;

                const information = document.querySelector('.container-information');
                information.innerHTML = xhr.responseText;
            }
        };

        xhr.send();
    });
} else {
    const attendedNombre = document.querySelector('.container-edit-profile #nameAttended');
    const attendedIdentification = document.querySelector('.container-edit-profile #idAttended');
    const attendedGender = document.querySelector('.container-edit-profile #radio-gender');
    const attendedDate = document.querySelector('.container-edit-profile #date');

    const attendedButton = document.querySelector('.container-edit-profile #actionAttended');

    attendedButton.addEventListener('click', ()=> {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../../controllers/AcudidoController.php?identification=" + attendedIdentification.value + "&name=" + attendedNombre.value + "&gender=" + attendedGender.value + "&date=" + attendedDate.value + "&action=Editar", true);

        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                editContainerProfile.style.zIndex = -1;

                const information = document.querySelector('.container-information');
                information.innerHTML = xhr.responseText;
            }
        };

        xhr.send();
    });
}

//Abrir añadir informe
const buttonAddReport = document.querySelector('.container-content .container-sections #section-reports .sorter-add .button-add i');
const addContainerReport = document.querySelector('.container-add-report');

buttonAddReport.addEventListener('click', ()=> {
    addContainerReport.style.zIndex = 100;
    addContainerReport.style.opacity = 1;
}); 

//Cerrar añadir informe
const closeAddReport = document.querySelector('.container-add-report .close-add i');

closeAddReport.addEventListener('click', ()=> {
    addContainerReport.style.zIndex = -1;
    addContainerReport.style.opacity = 0;
});

//Añadir reporte
const addDescriptionReport = document.querySelector('.container-add-report #description');
const addIdAttended = document.querySelector('.container-add-report #idAttended');
const addIdUser = document.querySelector('.container-add-report #idUser');

const addButtonReport = document.querySelector('.container-add-report #actionReport');

addButtonReport.addEventListener('click', ()=> {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../../controllers/InformeController.php?description=" + addDescriptionReport.value + "&idAttended=" + addIdAttended.value + "&idUser=" + addIdUser.value + "&action=Guardar", true);

    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            addContainerReport.style.zIndex = -1;

            const report = document.querySelector('.container-report');
            report.innerHTML = xhr.responseText;
        }
    };

    xhr.send();
});

//Abrir añadir actividad
const buttonAdd = document.querySelector('.container-content .container-sections .sorter-add .button-add i');
const addContainerActivity = document.querySelector('.container-add-activity');

buttonAdd.addEventListener('click', ()=> {
    addContainerActivity.style.zIndex = 100;
    addContainerActivity.style.opacity = 1;
}); 

//Cerrar añadir actividad
const closeAddActivity = document.querySelector('.container-add-activity .close-add i');

closeAddActivity.addEventListener('click', ()=> {
    addContainerActivity.style.zIndex = -1;
    addContainerActivity.style.opacity = 0;
});

//Añadir actividad
const addTitle = document.querySelector('.container-add-activity #title');
const addDescription = document.querySelector('.container-add-activity #description');
const addArchive = document.querySelector('.container-add-activity #archive');
const addGroup = document.querySelector('.container-add-activity #group');
const professorIdentification = document.querySelector('.container-edit-profile #identification');

const addButton = document.querySelector('.container-add-activity #actionActivity');

addButton.addEventListener('click', ()=> {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../../controllers/ActividadController.php?title=" + addTitle.value + "&description=" + addDescription.value + "&archive=" + addArchive.files[0] + "&identification=" + professorIdentification.value + "&group=" + addGroup.value + "&action=Guardar", true);

    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            editContainerProfile.style.zIndex = -1;

            const activity = document.querySelector('#section-activities .section-content');
            activity.innerHTML = xhr.responseText;

            addTitle.value = null;
            addDescription.value = null;
            addArchive.value = null;
            addGroup.value = null;

            addContainerActivity.style.zIndex = -1;
        }
    };

    xhr.send();
});

//Editar actividad
const editTitle = document.querySelector('.container-edit-activity #title');
const editDescription = document.querySelector('.container-edit-activity #description');
const editArchive = document.querySelector('.container-edit-activity #archive');
const editId = document.querySelector('.container-edit-activity #id');

const editButton = document.querySelector('.container-edit-activity #actionActivity');

editButton.addEventListener('click', ()=> {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../../controllers/ActividadController.php?id=" + editId.value + "&description=" + editDescription.value + "&archive=" + editArchive.files[0] + "&identification=" + professorIdentification.value + "&action=Editar", true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            editContainerProfile.style.zIndex = -1;

            const activity = document.querySelector('#section-activities .section-content');
            activity.innerHTML = xhr.responseText;

            const editContainerActivity = document.querySelector('.container-edit-activity');
            editContainerActivity.style.zIndex = -1;
        }
    };

    xhr.send();
});

function openEditActivity(id, titulo, descripcion) {
    const editContainerActivity = document.querySelector('.container-edit-activity');
    editContainerActivity.style.zIndex = 100;

    document.querySelector('.container-edit-activity #id').value = id;
    document.querySelector('.container-edit-activity #title').value = titulo;
    document.querySelector('.container-edit-activity #description').value = descripcion;
}

function openDeleteActivity(id, identificacion) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../../controllers/ActividadController.php?id=" + id + "&identification=" + identificacion +  "&action=Eliminar", true);
    
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            editContainerProfile.style.zIndex = -1;
    
            const activity = document.querySelector('#section-activities .section-content');
            activity.innerHTML = xhr.responseText;
        }
    };
    
    xhr.send();
}