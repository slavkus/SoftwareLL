//Register & Login Checkups

$(document).ready(function () {

    $("#users_table").DataTable();
    
    //All textbox checkup if empty
    $("#inputLoginButton").click(function (event) {
        var filledText = true;
        var filledPassword = true;
        $("#loginForm input[type=text]").each(function () {
            if ($.trim($(this).val()) == '') {
                filledText = false;
                $(this).css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            } else {
                $(this).css({
                    "border": "",
                    "background": ""
                });
            }
        });
        $("#loginForm input[type=password]").each(function () {
            if ($.trim($(this).val()) == '') {
                filledPassword = false;
                $(this).css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            } else {
                $(this).css({
                    "border": "",
                    "background": ""
                });
            }
        });

        if (filledText == false || filledPassword == false) {
            event.preventDefault();
            alert("Fill all of the fields.");
        }
    });

    // Register Check
    $("#inputRegisterButton").click(function (event) {
        var filledText = true;
        var filledPassword = true;
        var filledEmail = true;
        $("#modalRegisterForm input[type=text]").each(function () {
            if ($.trim($(this).val()) == '') {
                filledText = false;
                $(this).css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            } else {
                $(this).css({
                    "border": "1px solid green",
                    "background": ""
                });
            }
        });
        $("#modalRegisterForm input[type=password]").each(function () {
            if ($.trim($(this).val()) == '' ||
                    ($("#passwordRegister").val() != $("#repeatPassRegister").val())) {
                filledPassword = false;
                $(this).css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            } else {
                $(this).css({
                    "border": "1px solid green",
                    "background": ""
                });
            }
        });

        $("#modalRegisterForm input[type=email]").each(function () {
            var emailRegex = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
            if ($.trim($(this).val()) == '') {
                filledEmail = false;
                $(this).css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
            } else if (!(emailRegex.test($.trim($(this).val())))) {
                filledEmail = false;
                $(this).css({
                    "border": "1px solid red",
                    "background": "#FFCECE"
                });
                alert('Incorrect email format.');
            } else {
                $(this).css({
                    "border": "1px solid green",
                    "background": ""
                });
            }
        });
        if (filledText == false || filledPassword == false || filledEmail == false) {
            event.preventDefault();
            alert("Please fill all fields to register.");
        } else {
            alert('Thank you for registering!')
        }
    });

    //Reset checkups on tab click
    $("#cancelBtn").click(function () {
        $('input[type="text"]').each(function () {
            $(this).css({
                "border": "",
                "background": ""
            });
        });

        $('input[type="password"]').each(function () {
            $(this).css({
                "border": "",
                "background": ""
            });
        });

        $('input[type="email"]').each(function () {
            $(this).css({
                "border": "",
                "background": ""
            });
        });
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

function reload () {
    window.location.replace('http://softwarell.epizy.com/');
}

function showLogout () {
    $("#loginLi").hide();
    $("#registrationLi").hide();
    $("#logoutLi").show();
}

function showLoginRegistration () {
    $("#loginLi").show();
    $("#registrationLi").show();
    $("#logoutLi").hide();
}