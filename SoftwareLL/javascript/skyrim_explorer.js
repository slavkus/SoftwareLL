$(document).ready(function () {
    var trigger = null;
    var background = 1;
    $('body').css('background-image', 'url(../skyrim_source/backgrounds/back2.jpg)');
    
    $("#iframeLoader").hide();
    
    $("#btnAutoBackground").click(function(){
        backgroundTrigger();
    });
    
    $("#btnChooseBackground").click(function(){
        clearInterval(trigger);
    });
    
    function switchBackground() {
        preloader();
        switch (background) {
            case 1:
                $('body').css('background-image', 'url(../skyrim_source/backgrounds/back1.jpg)');
                break;
            case 2:
                $('body').css('background-image', 'url(../skyrim_source/backgrounds/back2.jpg)');
                break;
            case 3:
                $('body').css('background-image', 'url(../skyrim_source/backgrounds/back3.jpg)');
                break;
            case 4:
                $('body').css('background-image', 'url(../skyrim_source/backgrounds/back4.jpg)');
                break;
            case 5:
                $('body').css('background-image', 'url(../skyrim_source/backgrounds/back5.jpg)');
                break;
            case 6:
                $('body').css('background-image', 'url(../skyrim_source/backgrounds/back6.jpg)');
                break
            default:
                break;

        }
    }

    //rigged to trigger every minute
    function backgroundTrigger() {
        trigger = setInterval(function () {
            if (background > 6) {
                background = 1;
                switchBackground();
            } else {
                background++;
                switchBackground();
            }
        }, 60000);
    }
    
    

    //preloader --> helps with animation transitions (smoothing)
    function preloader() {
        if (document.images) {
            var img1 = new Image();
            var img2 = new Image();
            var img3 = new Image();
            var img4 = new Image();
            var img5 = new Image();
            var img6 = new Image();

            img1.src = "../skyrim_source/backgrounds/back1.jpg";
            img2.src = "../skyrim_source/backgrounds/back2.jpg";
            img3.src = "../skyrim_source/backgrounds/back3.jpg";
            img4.src = "../skyrim_source/backgrounds/back4.jpg";
            img5.src = "../skyrim_source/backgrounds/back5.jpg";
            img6.src = "../skyrim_source/backgrounds/back6.jpg";
        }
    }
    
    $("#refreshUserBtn").click(function () {
        reload();
    });


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

function reload() {
    //window.location.replace('http://softwarell.epizy.com/');
    document.location.reload(true);
}

function showLogout() {
    $("#loginLi").hide();
    $("#registrationLi").hide();
    $("#logoutLi").show();
    $("#displayUsername").show();
}

function showLoginRegistration() {
    $("#displayUsername").hide();
    $("#loginLi").show();
    $("#registrationLi").show();
    $("#logoutLi").hide();
}

function showAdminData() {
    $("#users_table").show();
    $("#adminLi").show();
}

function showAdminBlank() {
    $("#users_table").hide();
    $("#adminLi").hide();
}

function showSkyPicker() {
    $("#skyrimPicker").show();
    $("#iframeLoader").hide();
}

function hideSkyPicker() {
    $("#skyrimPicker").hide();
    $("#iframeLoader").show();
}