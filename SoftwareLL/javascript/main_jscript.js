$(document).ready(function(){

//Login

var loginSubmit = document.getElementById('inputLoginButton');
var modalLogin = document.getElementById('modalLoginButton');

window.onclick = function (event) {
    if (event.target == modalLogin) {
        modalLogin.style.display = "none";
    }
    if (event.target == loginSubmit){
        testLogin();
    }
}

//Register

var modalRegister = document.getElementById('modalRegisterButton');

window.onclick = function (event) {
    if (event.target == modalRegister) {
        modalRegister.style.display = "none";
    }
}

//Register & Login Checkups
//Javascript attempt

function testLogin() {
    var username = parseInt(document.getElementById('usernameLogin').value);
    var password = parseInt(document.getElementById('passwordLogin').value);
    if (username.length > 0 && password.length > 0) {
        document.getElementById('inputLoginButton').disabled = false;
    } else {
        document.getElementById('inputLoginButton').disabled = true;
        alert("Please, fill the fields to login.");
    }
}


function testRegister() {
    var usernameCount = parseInt(document.getElementById('usernameLogin').length);
    var passwordCount = parseInt(document.getElementById('passwordLogin').length);

}

});