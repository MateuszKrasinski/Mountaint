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
            followButtons.forEach(button => button.addEventListener('click', giveFollow));
        });
    }
});

function loadProjects(projects) {
    projects['users'].forEach(project => {
        createProject(project, projects['liked'], projects['disliked'], projects['followed']);
    });
}

function createProject(project, liked, disliked,followed) {
    console.log(liked);
    console.log(disliked);
    const template = document.querySelector("#friend-template");
    const clone = template.content.cloneNode(true);
    const div = clone.querySelector("div");
    div.id = project.id;
    const image = clone.querySelector("img");
    image.src = `/public/img/uploads/${project.photo}`;
    const name = clone.querySelector("h2");
    name.innerHTML = project.name + "  " + project.surname;
    const description = clone.querySelector("p");
    description.innerHTML = project.description;
    const like = clone.querySelector(".fa-heart");
    like.innerText = project.likes;
    like.addEventListener('click', giveLike);
    if (liked.includes(project.id)) like.classList.add('highlight');
    const dislike = clone.querySelector(".fa-minus-square");
    dislike.innerText = project.dislikes;
    dislike.addEventListener('click', giveDislike);
    if (disliked.includes(project.id)) dislike.classList.add('highlight');
    const wantToGo = clone.querySelectorAll(".want-to-go")
    wantToGo[0].innerText = project.first_mountain;
    wantToGo[1].innerText = project.second_mountain;
    const follow = clone.querySelector(".join-btn");
    if( followed.includes(project.id)) follow.innerText = 'unfollow';
    follow.addEventListener('click', giveFollow);
    follow.addEventListener('click', moveAway);
    projectContainer.appendChild(clone);

}


buttonMyProject.addEventListener('change', function (event) {
    let selectedOption = buttonMyProject.value;
    fetch(`/filter/${selectedOption}`).then(function (response) {
        return response.json();
    }).then(function (projects) {
        projectContainer.innerHTML = "";
        loadProjects(projects);

    });
})

function giveFollow() {
    const follow = this;
    console.log(this.innerText)
    const container = follow.parentElement.parentElement.parentElement;
    const id = container.getAttribute('id');
    const data = {id: id};
    if(follow.innerText === "follow"){
        fetch(`/follow/${id}`)
            .then();
        console.log('followed')
    }
    else{
        fetch(`/unfollow/${id}`)
            .then();
        console.log('unfollowed');
    }
}

function giveLike() {
    const likes = this;
    const container = likes.parentElement.parentElement.parentElement;
    const dislikes = container.querySelector(".fa-minus-square")
    const id = container.getAttribute("id");
    const firstValue = likes.innerHTML;
    if (!likes.classList.contains("highlight") && (!dislikes.classList.contains("highlight"))) {
        likes.innerHTML = +likes.innerHTML + 1;
        likes.classList.add("highlight");
        console.log("liked");
        fetch(`/likeFriend/${id}`)
            .then()
    } else if (!likes.classList.contains("highlight") && (dislikes.classList.contains("highlight"))) {
        dislikes.innerHTML = +dislikes.innerHTML - 1;
        dislikes.classList.remove("highlight");
        likes.innerHTML = +likes.innerHTML + 1;
        likes.classList.add('highlight');
        fetch(`/undislikeFriend/${id}`)
            .then()
        fetch(`/likeFriend/${id}`)
            .then()
    } else if (likes.classList.contains("highlight")) {
        likes.classList.remove("highlight");
        likes.innerHTML = +likes.innerHTML - 1;
        fetch(`/unlikeFriend/${id}`)
            .then()
    } else {
        likes.innerHTML = +likes.innerHTML - 1;
        likes.classList.remove("highlight");
        console.log("unliked");
        fetch(`/unlikeFriend/${id}`)
            .then()
    }
}

function giveDislike() {
    const dislikes = this;
    const container = dislikes.parentElement.parentElement.parentElement;
    const likes = container.querySelector(".fa-heart")
    const id = container.getAttribute("id");
    if (!dislikes.classList.contains("highlight") && (!likes.classList.contains("highlight"))) {
        dislikes.innerHTML = +dislikes.innerHTML + 1;
        dislikes.classList.add("highlight");
        fetch(`/dislikeFriend/${id}`)
            .then()
    } else if (!dislikes.classList.contains("highlight") && (likes.classList.contains("highlight"))) {
        likes.innerHTML = +likes.innerHTML - 1;
        likes.classList.remove("highlight");
        dislikes.innerHTML = +likes.innerHTML + 1;
        dislikes.classList.add('highlight');
        fetch(`/unlikeFriend/${id}`)
            .then()
        fetch(`/dislikeFriend/${id}`)
            .then()
    } else if (dislikes.classList.contains("highlight")) {
        dislikes.classList.remove("highlight");
        dislikes.innerHTML = +dislikes.innerHTML - 1;
        fetch(`/undislikeFriend/${id}`)
            .then()
    } else {
        dislikes.innerHTML = +dislikes.innerHTML - 1;
        dislikes.classList.remove("highlight");
        fetch(`/undislikeFriend/${id}`)
            .then()
    }
}

function moveAway() {
    let projectContainer = this.parentElement.parentElement.parentElement.parentElement;
    let project = this.parentElement.parentElement.parentElement;
    project.classList.add("animation");
    project.addEventListener("animationend", () => {
        projectContainer.removeChild(project)
    })

}

followButtons.forEach(button => button.addEventListener('click', giveFollow));
followButtons.forEach(button => button.addEventListener('click', moveAway));
likeButtons.forEach(button => button.addEventListener("click", giveLike));
dislikeButtons.forEach(button => button.addEventListener("click", giveDislike));
