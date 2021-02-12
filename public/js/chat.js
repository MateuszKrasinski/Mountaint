const messageInput = document.querySelector(".message-input");
const chat = document.querySelector(".chat");
const img = document.querySelector(".msg-to>a>img");

messageInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        let content = e.target.value;
        let div = document.createElement("div");
        div.setAttribute("class", "msg msg-right");
        let div2 = document.createElement("div");
        div2.setAttribute("class", "right");
        div2.innerHTML = content;
        div.appendChild(div2);
        chat.appendChild(div);
        let id;
        const data = {messageTo: img.getAttribute('id'), content: content};

        fetch("/sendMessage", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
    }
});

function getMessages() {
    idUser = img.getAttribute('id')

    fetch(`/getMessages/${idUser}`).then(function (response) {
        return response.json();
    }).then(function (projects) {
        console.log(projects);
        chat.innerHTML = "";
        loadMessages(projects['messages'], projects['loggedUser']);
    });

}
// setInterval(getMessages, 2000);
// function loadMessages(messages, loggedUser) {
//     messages.forEach((msg) => {
//         createMessage(msg, loggedUser);
//     })
// }

function createMessage(passedContent, loggedUser) {
    let content = passedContent['content'];
    let div = document.createElement("div");
    if (loggedUser == passedContent['id_from']) div.setAttribute("class", "msg msg-right");
    else div.setAttribute("class", "msg");
    let div2 = document.createElement("div");
    div2.setAttribute("class", "right");
    div2.innerHTML = content;
    div.appendChild(div2);
    chat.appendChild(div);
}


// document.querySelector(".right.left").addEventListener('click', getMessages)