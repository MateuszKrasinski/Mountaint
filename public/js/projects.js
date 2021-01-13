buttons.forEach((button)=>{
    button.addEventListener('click', moveAway);
})
function moveAway() {
    let projectContainer = this.parentElement.parentElement.parentElement.parentElement;
    let project = this.parentElement.parentElement.parentElement;
    project.classList.add("animation");
    project.addEventListener("animationend", ()=>{projectContainer.removeChild(project)})

}