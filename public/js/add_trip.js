const tripContainer = document.querySelector('.create-trip-container');

function newPoint(event) {
    if (event.keyCode === 13) {
        event.preventDefault();

        let divPoint = document.createElement("div");
        divPoint.setAttribute('class', 'point');
        divPoint.innerHTML = '<i class="fas fa-minus-circle minus-i"></i>';
        document.querySelector(".create-trip-container").appendChild(divPoint);
        let divMarker = document.createElement("div");
        divMarker.setAttribute('class', 'marker');
        divMarker.innerHTML = '<i class="fas fa-map-marker-alt"></i>' + event.target.value;
        divPoint.appendChild(divMarker);
        document.querySelector(".point-input").value = "";
        getPoints();

        divPoint.addEventListener('click', function (point) {
            tripContainer.removeChild(point.target.parentElement);
        })

    }
}

function getPoints() {
    let pointsArray = [];
    let points = document.querySelectorAll(".marker");
    points.forEach(function (point) {
        pointsArray.push(point.outerText);
    })
    console.log(pointsArray);
}

