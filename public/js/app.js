document.getElementById("sendEmail").addEventListener("click", function(event){
    event.preventDefault()

    // hide previous errors and confirmations
    let element = document.getElementById('error');
    element.classList.add('d-none');
    element = document.getElementById('confirmation');
    element.classList.add('d-none');

    let email = document.getElementById("email").value;
    if (email) {
        let sendData = {"email" : email};
        fetch("/post", {
            method: "POST",
            body: JSON.stringify(sendData),
            header: {
                "Content-Type": "application/json; charset=UTF-8",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.response['confirmation']) {
                    let element = document.getElementById("confirmation");
                    element.classList.remove("d-none");
                    // JS template literals
                    element.innerHTML = `Your email ${data.response['email']} was successfully added!`;
                }
                if (data.response['error'] && data.response['error'] !== "") {
                    let element = document.getElementById("error");
                    element.classList.remove("d-none");
                    element.innerHTML = data.response['error'];
                }
            })
    }
});