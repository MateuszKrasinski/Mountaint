const search = document.querySelector('input[placeholder="search friend"]');
const projectContainer = document.querySelector(".projects");
const buttonMyProject = document.querySelector("select.filter");
const followButtons = document.querySelectorAll(".join-btn");
const likeButtons = document.querySelectorAll(".fa-heart");
const dislikeButtons = document.querySelectorAll(".fa-minus-square");
search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/searchFriend", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (projects) {
            projectContainer.innerHTML = "";
            loadProjects(projects);
            followButtons.forEach(button=>button.addEventListener('click', giveFollow));
        });
    }
});
function loadProjects(projects) {
    console.log(projects)
    projects.forEach(project => {
        createProject(project);
    });
}

function createProject(project) {
    const template = document.querySelector("#friend-template");
    const clone = template.content.cloneNode(true);
    const div = clone.querySelector("div");
    div.id = project.id;
    const image = clone.querySelector("img");
    image.src = `/public/img/uploads/${project.photo}`;
    const name = clone.querySelector("h2");
    name.innerHTML = project.name + "  " +project.surname;
    const description = clone.querySelector("p");
    description.innerHTML = project.description;
    const like = clone.querySelector(".fa-heart");
    like.innerText = 0;
    like.addEventListener('click',giveLike);
    const dislike = clone.querySelector(".fa-minus-square");
    dislike.innerText = 0;
    dislike.addEventListener('click', giveDislike);
    const wantToGo = clone.querySelectorAll(".want-to-go")
    wantToGo[0].innerText= project.first_mountain;
    wantToGo[1].innerText= project.second_mountain;
    const  follow = clone.querySelector(".join-btn");
    follow.addEventListener('click', giveFollow);
    follow.addEventListener('click', moveAway);
    projectContainer.appendChild(clone);

}


buttonMyProject.addEventListener('change',function (event){
    let selectedOption = buttonMyProject.value;
    fetch(`/${selectedOption}`).then(function (response) {
        return response.json();
    }).then(function (projects) {
        projectContainer.innerHTML = "";
        loadProjects(projects);

    });
})

function giveFollow(){
    const follow = this;
    const container = follow.parentElement.parentElement.parentElement;
    const id = container.getAttribute('id');
    const data = {id: id};
    fetch(`/follow/${id}`)
        .then();
}

function giveLike() {
    const likes = this;
    const container = likes.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");
    const firstValue = likes.innerHTML;
    fetch(`/likeFriend/${id}`)
        .then(function (response) {
            return response.json();
        }).then(function (number) {
        if (firstValue>number) likes.classList.remove("highlight");
        else if (firstValue<number) likes.classList.add("highlight");
        likes.innerHTML = number;
    });
}

function giveDislike() {
    const dislikes = this;
    const container = dislikes.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");
    const firstValue = dislikes.innerHTML;
    fetch(`/dislikeFriend/${id}`)
        .then(function (response) {
            return response.json();
        }).then(function (number) {
        console.log(number);
        if (firstValue>number) dislikes.classList.remove("highlight");
        else if (firstValue<number) dislikes.classList.add("highlight");
        dislikes.innerHTML = number;
    });
}

function moveAway() {
    let projectContainer = this.parentElement.parentElement.parentElement.parentElement;
    let project = this.parentElement.parentElement.parentElement;
    project.classList.add("animation");
    project.addEventListener("animationend", ()=>{projectContainer.removeChild(project)})

}
followButtons.forEach(button => button.addEventListener('click', giveFollow));
followButtons.forEach(button => button.addEventListener('click', moveAway));
likeButtons.forEach(button => button.addEventListener("click", giveLike));
dislikeButtons.forEach(button => button.addEventListener("click", giveDislike));
