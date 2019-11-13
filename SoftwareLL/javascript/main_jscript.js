//Register & Login Checkups

$(document).ready(function () {

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
        } else {
            alert('Welcome!');
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
                    "border": "",
                    "background": ""
                });
            }
        });
        $("#modalRegisterForm input[type=password]").each(function () {
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
        $("#modalRegisterForm input[type=email]").each(function () {
            if ($.trim($(this).val()) == '') {
                filledEmail = false;
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
