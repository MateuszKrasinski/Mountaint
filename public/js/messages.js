const search = document.querySelector('input[placeholder="search friend"]');
const projectContainer = document.querySelector('.search-container');
search.addEventListener("keyup", function (event) {
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
            loadProjects(projects);
        });
});


function loadProjects(projects) {
    document.querySelectorAll('.user-container').forEach((user)=>user.remove())
    projects['users'].forEach(project => {
        createProject(project);
    });
}

function createProject(project) {
    let div = document.createElement("div");
    div.setAttribute('class', 'user-container')
    div.innerHTML = '<a href="chat?profile='+project.id+'">\n' +
        '                            <img src="/public/img/' + project.photo +'">\n' +
        '                        </a>'

    document.querySelector('.searched-friends').appendChild(div);

}