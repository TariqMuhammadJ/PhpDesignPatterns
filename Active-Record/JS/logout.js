const button = document.getElementById("logout-btn");
button.addEventListener("click", function(){
    fetch("processor.php",{
        method: "POST",
        headers:{'Content-Type': "application/x-www-form-urlencoded"},
        body:"action=logout"
    })
    .then(res => res.text())
    .then(data => {
        if (data.trim() === 'success'){
            window.location.href = "index.php";
        }

    })
})
