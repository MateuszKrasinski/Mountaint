const likeButtons = document.querySelectorAll(".fa-heart");
const dislikeButtons = document.querySelectorAll(".fa-minus-square");
const followButtons = document.querySelectorAll(".join-btn");

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

function giveFollow(){
    const follow = this;
    const container = follow.parentElement.parentElement.parentElement;
    const id = container.getAttribute('id');
    const data = {id: id};
    fetch(`/follow/${id}`)
        .then();
}


followButtons.forEach(button=>button.addEventListener('click', giveFollow));
likeButtons.forEach(button => button.addEventListener("click", giveLike));
dislikeButtons.forEach(button => button.addEventListener("click", giveDislike));