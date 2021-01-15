const likeButtons = document.querySelectorAll(".fa-heart");
const dislikeButtons = document.querySelectorAll(".fa-minus-square");


function giveLike() {
    const likes = this;
    const container = likes.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");
    const firstValue = likes.innerHTML;
    fetch(`/like/${id}`)
        .then(function (response) {
            console.log("Response")
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
    fetch(`/dislike/${id}`)
        .then(function (response) {
            console.log("Response")
            return response.json();
        }).then(function (number) {
        if (firstValue>number) dislikes.classList.remove("highlight");
        else if (firstValue<number) dislikes.classList.add("highlight");
        dislikes.innerHTML = number;
    });
}

likeButtons.forEach(button => button.addEventListener("click", giveLike));
dislikeButtons.forEach(button => button.addEventListener("click", giveDislike));