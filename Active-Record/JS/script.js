document.getElementById("login-form-real").addEventListener("submit", function(e){
    e.preventDefault();
    const email = document.getElementById("email").value;
    const pass = document.getElementById("password").value;
    const messageBox = document.getElementById("alert");
    let message = document.getElementById("alert-paragraph");

    messageBox.style.display = "none";
    
    fetch("processor.php", {
        method: "POST", 
        headers:{'Content-Type': "application/x-www-form-urlencoded"},
        body: "email="+encodeURIComponent(email)+"&pass="+encodeURIComponent(pass)


    })
    .then(res => res.text())
    .then(data => {
        if (data.trim() === 'success'){
            window.location.href = "dashboard.php";
        }
        else {
            messageBox.style.display = "block";
            message.innerText = data;
        }
    })
});