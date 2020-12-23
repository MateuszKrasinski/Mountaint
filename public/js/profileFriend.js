const icons = document.querySelectorAll(".social-section>i");
const heartIcon = icons[0];
const minusIcon = icons[1];
//const followIcon = icons[2];


function increment(element){
    element.outerText +=1;
}

let reactionIcons = [heartIcon, minusIcon];

reactionIcons.forEach((icon)=>{
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

