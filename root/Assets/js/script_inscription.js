const inputAttended = document.querySelectorAll('.data__attended input:not([type="radio"])');
const inputAttendant = document.querySelectorAll('.data__attendant input');

const dataAttended = document.querySelector('.data__attended');
const dataAttendant = document.querySelector('.data__attendant');

const point = document.querySelector('.point:nth-child(2) .circle');
const point__2 = document.querySelector('.point:nth-child(3) .circle');

const line = document.querySelector('.point:nth-child(1) .line');
const line__2 = document.querySelector('.point:nth-child(3) .line');

const text = document.querySelector('.point:nth-child(2) span');
const text__2 = document.querySelector('.point:nth-child(3) span');

function next(input, data, point, line, text) {
    input.forEach((input)=> {
        if (input.value === "") {
            input.setAttribute('placeholder', 'Campo obligatorio');
            input.style.border = '2px solid red';

            input.addEventListener('input', ()=> {
                input.style.border = '2px solid #d9d9d9';
                input.removeAttribute('placeholder');
            });
        } else if (input.value !== "") {
            data.style.opacity = 0;
            data.style.zIndex = -1;
            paint(point, line, text);
        }
    });
}

function paint(point, line, text) {
    point.style.background = "#7E57C2";
    text.style.color = "#7E57C2";

    line.style.animation = "animationColor 1s ease-in-out";
    line.style.background = "#7E57C2";
    line.style.width = "155px";
}

const nameAttendant = document.getElementById('nameAttendant');
const nameAttended = document.getElementById('nameAttended');

const profileAttendant = document.getElementById('profileAttendant');
const profileAttended = document.getElementById('profileAttended');

function getName() {
    profileAttended.textContent = nameAttended.value;
    profileAttendant.textContent = nameAttendant.value;
}

const message = document.querySelector('.message');
const span = document.querySelector('.message span');

if (span.textContent == "") {
    message.style.animation = 'none';
}

const imageAttended = document.getElementById('image-attended');
const imageAttendant = document.getElementById('image-attendant');

const inputAte = document.getElementById('input-attended');
const inputAta = document.getElementById('input-attendant');

const srcAte = document.getElementById('src-attended');
const srcAta = document.getElementById('src-attendant');

inputAte.addEventListener('change', (e) => {    
    srcAte.value = URL.createObjectURL(e.target.files[0]);
    imageAttended.src = URL.createObjectURL(e.target.files[0]);  
});

inputAta.addEventListener('change', (e) => {  
    srcAta.value = URL.createObjectURL(e.target.files[0]);  
    imageAttendant.src = URL.createObjectURL(e.target.files[0]);
});


const buttonPlatform = document.querySelector('.container-nav nav .button-inscription');

buttonPlatform.onmousemove = function(e) {
    const x = e.pageX  - buttonPlatform.offsetLeft;
    const y = e.pageY  - buttonPlatform.offsetTop;

    buttonPlatform.style.setProperty('--x', x + 'px');
    buttonPlatform.style.setProperty('--y', y + 'px');
}