const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const confirmedPasswordInput = form.querySelector('input[name="confirmedPassword"]');
const numberInput = form.querySelector('input[name="phone"]');
const nameInput = form.querySelector('input[name="name"]');
const surnameInput = form.querySelector('input[name="surname"]');
const submitButton = form.querySelector('button');
function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}
function isName(name){
    return !/\s/.test(name) && isNaN(name);
}
function isPhone(number){
    console.log("Number:"+ number  );
    return number.length === 9;
}

function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid')
}
surnameInput.addEventListener('keyup',()=>{
    setTimeout(function () {
        markValidation(nameInput, isName(nameInput.value));
    }, 1000);
})
nameInput.addEventListener('keyup',()=>{
    setTimeout(function () {
        markValidation(nameInput, isName(nameInput.value));
    }, 1000);
})
numberInput.addEventListener('keyup',function () {
    setTimeout(function () {
        markValidation(numberInput, isPhone(numberInput.value));
    }, 1000);
})
emailInput.addEventListener('keyup', function () {
    setTimeout(function () {
        markValidation(emailInput, isEmail(emailInput.value));
    }, 1000);
});

confirmedPasswordInput.addEventListener('keyup', function () {
    setTimeout(function () {
        const condition = arePasswordsSame(
            confirmedPasswordInput.previousElementSibling.value,
            confirmedPasswordInput.value
        );
        markValidation(confirmedPasswordInput, condition);
    }, 1000);
});
const inputs =  document.querySelectorAll('input');

submitButton.addEventListener('click',(e)=>{
    inputs.forEach((input)=>{
        if (input.classList[0] ==='no-valid' || input.value === "")
            e.preventDefault();
    })
})

