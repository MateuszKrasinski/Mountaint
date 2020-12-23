const icons = document.querySelectorAll(".social-section>i");
const buttons = document.querySelectorAll(".join-btn");

icons.forEach((icon)=>{
    icon.addEventListener('click', update);
})



function increment(element){
    element.textContent = Number(element.textContent) + 1;
    element.classList.add('.added');
}
function decrement(element){
    element.textContent = Number(element.textContent) - 1;
    element.classList.remove('.added');
}

function update(){
    (!this.classList.contains('.added'))? increment(this): decrement(this)
}

buttons.forEach((button)=>{
    button.addEventListener('click', moveAway);
})
function moveAway() {
    let projectContainer = this.parentElement.parentElement.parentElement.parentElement;
    let project = this.parentElement.parentElement.parentElement;
    project.classList.add("animation");
    project.addEventListener("animationend", ()=>{projectContainer.removeChild(project)})

}