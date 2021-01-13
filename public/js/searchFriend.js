const search = document.querySelector('input[placeholder="search friend"]');
const projectContainer = document.querySelector(".projects");

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
            console.log("Response")
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
    console.log(project)
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
    like.innerText = project.likes;
    const dislike = clone.querySelector(".fa-minus-square");
    dislike.innerText = project.dislikes;
    const wantToGo = clone.querySelectorAll(".want-to-go")
    wantToGo[0].innerText= project.first_mountain;
    wantToGo[1].innerText= project.second_mountain;
    projectContainer.appendChild(clone);
}

