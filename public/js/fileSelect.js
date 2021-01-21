



function onFileSelected(event) {
    let selectedFile = event.target.files[0];
    let reader = new FileReader();

    reader.onload = function (event) {
        let imgtag = document.querySelector(".custom-file-input");
        imgtag.style.background = "url(" + event.target.result + ")";
        imgtag.style.backgroundSize = "cover";

    };

    reader.readAsDataURL(selectedFile);
}


function noReload(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
    }
}

function loadPhoto(photo = "xD") {
    let imgtag = document.querySelector(".custom-file-input");
    imgtag.style.background = "url(/public/img/uploads/" + photo + ")";
    imgtag.style.backgroundSize = "cover";
    let buttonsInvite = document.querySelectorAll(".join-btn");
    buttonsInvite.forEach(function (btn) {
        btn.addEventListener('click', function (btn) {
            let profile = btn.target.parentElement.parentElement.parentElement;
            let profiles = profile.parentElement
            animation(profile);

            profiles.removeChild(profile);

        })
    })
}



