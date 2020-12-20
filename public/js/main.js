const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const confirmedPasswordInput = form.querySelector('input[name="confirmedPassword"]');

function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid')
}

emailInput.addEventListener('keyup', function () {
    setTimeout(function () {
        markValidation(emailInput, isEmail(emailInput.value));
    }, 1000);
});

confirmedPasswordInput.addEventListener('keyup', function () {
    setTimeout(function () {
        console.log('password event')
        const condition = arePasswordsSame(
            confirmedPasswordInput.previousElementSibling.value,
            confirmedPasswordInput.value
        );
        console.log(condition);
        markValidation(confirmedPasswordInput, condition);
    }, 1000);
});

// form.addEventListener("submit", e => {
//     e.preventDefault();
//
//     //TODO check again if form is valid after submitting it
// });
function onFileSelected(event) {
    var selectedFile = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function (event) {
        let imgtag = document.querySelector(".custom-file-input");
        imgtag.style.background = "url(" + event.target.result + ")";

    };

    reader.readAsDataURL(selectedFile);
}

function newPoint(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        let div = document.createElement("div");
        div.setAttribute('class', 'point');
        div.innerHTML = '<i class="fas fa-map-marker-alt"></i>' + event.target.value;
        document.querySelector(".create-trip-container").appendChild(div);
    }
}

function noReload(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
    }
}