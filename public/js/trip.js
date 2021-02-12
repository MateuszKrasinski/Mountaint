const likeButtons = document.querySelectorAll(".fa-heart");
const dislikeButtons = document.querySelectorAll(".fa-minus-square");
const joinButtons = document.querySelectorAll(".join-btn");

const search = document.querySelector('input[placeholder="search project"]');
const projectContainer = document.querySelector(".projects");
const buttonMyProject = document.querySelector("select.filter");

function giveLike() {
    const likes = this;
    const container = likes.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");
    const firstValue = likes.innerHTML;
    fetch(`/like/${id}`)
        .then(function (response) {
            return response.json();
        }).then(function (number) {
        console.log(number)
        if (firstValue > number) likes.classList.remove("highlight");
        else if (firstValue < number) likes.classList.add("highlight");
        likes.innerHTML = number;
    });
}

function giveDislike() {
    const dislikes = this;
    const container = dislikes.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");
    const firstValue = dislikes.innerHTML;
    fetch(`/dislike/${id}`)
        .then(function (response) {
            return response.json();
        }).then(function (number) {

        if (firstValue > number) dislikes.classList.remove("highlight");
        else if (firstValue < number) dislikes.classList.add("highlight");
        dislikes.innerHTML = number;
    });
}

function joinTrip() {
    const idTrip = (this.parentElement.parentElement.parentElement.id);
    const data = {id_trip: idTrip, option: this.innerText};
        fetch("/joinTrip", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(()=>console.log(this.innerText))
}



function searchTrip(event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (projects) {
            projectContainer.innerHTML = "";
            loadProjects(projects)
        });
    }
}


function loadProjects(projects) {
    projects['trips'].forEach(project => {
        console.log(project);
        createProject(project,projects['joined'], projects['myTrips']);
    });
}

function createProject(project, joined, myTrips) {
    const template = document.querySelector("#project-template");

    const clone = template.content.cloneNode(true);
    const div = clone.querySelector("div");
    div.id = project.id;
    const image = clone.querySelector("img");
    image.src = `/public/img/uploads/${project.image}`;
    const title = clone.querySelector("h2");
    title.innerHTML = project.title;
    const description = clone.querySelector("p");
    description.innerHTML = project.description;
    const dateStart = clone.querySelector(".date");
    dateStart.innerText = project.date_start + "\n" + project.time_start;
    const dateFinish = clone.querySelector(".users");
    dateFinish.innerHTML =  '<i class="fas fa-users"></i>'+project.participants;
    const join = clone.querySelector(".join-btn");
    if (joined.includes(project.id))join.innerText = 'leave';
    if (myTrips.includes(project.id))join.innerText = 'remove';
    join.addEventListener('click', joinTrip);
    join.addEventListener('click', moveAway);
    projectContainer.appendChild(clone);
}

function filter() {
    let selectedOption = buttonMyProject.value;
    fetch(`/filterTrips/${selectedOption}`).then(function (response) {
        return response.json();
    }).then(function (projects) {
        projectContainer.innerHTML = "";
        loadProjects(projects)
        console.log(selectedOption);
    });
}

function moveAway() {
    let projectContainer = this.parentElement.parentElement.parentElement.parentElement;
    let project = this.parentElement.parentElement.parentElement;
    project.classList.add("animation");
    project.addEventListener("animationend", () => {
        projectContainer.removeChild(project)
    })

}

function setUpOnClicks() {
    joinButtons.forEach(button => button.addEventListener('click', joinTrip));
    joinButtons.forEach(button => button.addEventListener('click', moveAway));
    likeButtons.forEach(button => button.addEventListener("click", giveLike));
    dislikeButtons.forEach(button => button.addEventListener("click", giveDislike));
    buttonMyProject.addEventListener('change', filter);
    search.addEventListener("keyup", searchTrip);
}

setUpOnClicks();