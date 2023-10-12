/*const profileNikol = document.getElementById('selected');
const profileJose = document.getElementById('profile-jose');
const profileRoberto = document.getElementById('profile-roberto');

profileNikol.addEventListener("click", ()=> {
    profileNikol.setAttribute("id", "selected");
    profileJose.removeAttribute("id");
    profileRoberto.removeAttribute("id");

    const cardNikol = document.getElementById('card-nikol');
    const cardJose = document.getElementById('card-jose');
    const cardRoberto = document.getElementById('card-roberto');

    cardNikol.style.opacity = 1;
    cardNikol.style.zIndex = 100;
    
    cardJose.style.opacity = 0;
    cardJose.style.zIndex = 0;

    cardRoberto.style.opacity = 0;
    cardRoberto.style.zIndex = 0;
});

profileJose.addEventListener("click", ()=> {
    profileJose.setAttribute("id", "selected");
    profileNikol.removeAttribute("id");
    profileRoberto.removeAttribute("id");

    const cardNikol = document.getElementById('card-nikol');
    const cardJose = document.getElementById('card-jose');
    const cardRoberto = document.getElementById('card-roberto');

    cardNikol.style.opacity = 0;
    cardNikol.style.zIndex = 0;

    cardJose.style.opacity = 1;
    cardJose.style.zIndex = 100;

    cardRoberto.style.opacity = 0;
    cardRoberto.style.zIndex = 0;
});

profileRoberto.addEventListener("click", ()=> {
    profileRoberto.setAttribute("id", "selected");
    profileJose.removeAttribute("id");
    profileNikol.removeAttribute("id");

    const cardNikol = document.getElementById('card-nikol');
    const cardJose = document.getElementById('card-jose');
    const cardRoberto = document.getElementById('card-roberto');

    cardNikol.style.opacity = 0;
    cardNikol.style.zIndex = 0;

    cardJose.style.opacity = 0;
    cardJose.style.zIndex = 0;

    cardRoberto.style.opacity = 1;
    cardRoberto.style.zIndex = 100;
});*/

const profile = document.querySelectorAll('.container-profile');

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
        } else {
            if (current.id === "selected") {
                current.removeAttribute('id');
            }
        }
    }
}