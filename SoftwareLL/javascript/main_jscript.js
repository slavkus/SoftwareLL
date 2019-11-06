//Login

var modalLogin = document.getElementById('modalLoginButton');

window.onclick = function (event) {
    if (event.target == modalLogin) {
        modalLogin.style.display = "none";
    }
}

var modalRegister = document.getElementById('modalRegisterButton');

window.onclick = function (event) {
    if (event.target == modalRegister) {
        modalRegister.style.display = "none";
    }
}

var logout = document.getElementById('');