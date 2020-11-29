function onFileSelected(event) {
    var selectedFile = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function (event) {
        let imgtag = document.querySelector(".custom-file-input");
        imgtag.style.background = "url(" + event.target.result + ")";

    };

    reader.readAsDataURL(selectedFile);
}

function newPoint(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        let div = document.createElement("div");
        div.setAttribute('class', 'point');
        div.innerHTML = '<i class="fas fa-map-marker-alt"></i>' + event.target.value;
        document.querySelector(".create-trip-container").appendChild(div);
    }
}

function noReload(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
    }
}
