//Register & Login Checkups
//Javascript/Jquery attempt

$(document).ready(function () {
    $("#modalLoginButton").click(function () {
        $("#inputLoginButton").prop('disabled', false);
    });
    $("#modalRegisterButton").click(function (){
        $("#inputRegisterButton").prop('disabled', false);
    });
    $("#inputLoginButton").click(function () {
        if ($("#usernameLogin").val().length > 0 && $("#passwordLogin").val().length > 0) {
            $("#inputLoginButton").prop('disabled', false);
        } else {
            $("#inputLoginButton").prop('disabled', true);
            $("#inputLoginButton").prop('color', 'gray');
            alert("Please, fill the fields to login.");
        }
    });
    $("#inputRegisterButton").click(function () {
        if ($("#nameRegister").val().length > 0 &&
                $("#surnameRegister").val().length > 0 &&
                $("#emailRegister").val().length > 0 &&
                $("#usernameRegister").val().length > 0 &&
                $("#passwordRegister").val().length > 0 &&
                $("#repeatPassRegister").val().length > 0) {

            $("#inputRegisterButton").prop('disabled', false);
        } else {
            $("#inputRegisterButton").prop('disabled', true);
            $("#inputRegisterButton").prop('color', 'gray');
            alert("Please fill all fields to register.");
        }
    });
});


//Login modal animation

var modalLogin = document.getElementById('modalLoginButton');

window.onclick = function (event) {
    if (event.target == modalLogin) {
        modalLogin.style.display = "none";
    }
}

//Register modal animation

var modalRegister = document.getElementById('modalRegisterButton');

window.onclick = function (event) {
    if (event.target == modalRegister) {
        modalRegister.style.display = "none";
    }
}
