const search = document.querySelector('input[placeholder="search project"]');
const projectContainer = document.querySelector(".projects");
const buttonMyProject = document.querySelector("select.filter");
search.addEventListener("keyup", function (event) {
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
});
function loadProjects(projects) {
    projects.forEach(project => {
        console.log(project);
        createProject(project);
    });
}

function createProject(project) {
    console.log([project])
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
    const like = clone.querySelector(".fa-heart");
    like.innerText = project.likes.length-2;
    const dislike = clone.querySelector(".fa-minus-square");
    dislike.innerText = project.dislikes.length-2;
    const dateStart = clone.querySelectorAll(".date")[0];
    dateStart.innerText = project.date_start + "\n" + project.time_start;
    const dateFinish= clone.querySelectorAll(".date")[1];
    dateFinish.innerText = project.participants.length-2
    projectContainer.appendChild(clone);
}
buttonMyProject.addEventListener('click',function (){
    fetch('/myTrips').then(function (response) {
        return response.json();
    }).then(function (projects) {
        projectContainer.innerHTML = "";
        loadProjects(projects)
    });
})