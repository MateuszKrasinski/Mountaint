btns = document.querySelectorAll(".join-btn");
btns.forEach((btn)=>{
    btn.addEventListener('click',()=>{
        const idTrip = (btn.parentElement.parentElement.parentElement.id);
        const data = {id_trip: idTrip};
        fetch("/joinTrip", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(()=>{
            console.log('finished')})
    })
})

