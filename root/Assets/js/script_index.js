const profile = document.querySelectorAll('.container-profile');
const card = document.querySelectorAll('.container-section-team .card');

profile.forEach(function(container) {
    container.addEventListener('click', ()=> {
        toogleSelected(container);
    });
}); 


function toogleSelected(container) {
    const profile = document.querySelectorAll('.container-profile');

    for (var i = 0; profile.length; i++) {
        const current = profile[i];

        if (current === container) {
            current.setAttribute('id', 'selected');

            card[i].style.opacity = 1;
            card[i].style.zIndex = 100;
        } else {
            if (current.id === "selected") {
                current.removeAttribute('id');

                card[i].style.opacity = 0;
                card[i].style.zIndex = 0;
            }
        }
    }
}

const button = document.querySelectorAll('.container-section-team button');

for (let i = 0; i < button.length; i++) {
    button[i].addEventListener('click', ()=> {
        if (button[0] === button[i]) {
            window.open("https://www.instagram.com/nikolbaute_/", "_blank");
        } else if (button[1] === button[i]) {
            window.open("https://www.instagram.com/jose_agamezg/", "_blank");
        } else if (button[2] === button[i]) {
            window.open("https://www.instagram.com/imnotk4rlos/", "_blank");
        }
    });
}