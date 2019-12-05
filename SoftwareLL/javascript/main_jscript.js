//Register & Login Checkups

$(document).ready(function () {

    $(".fancybox-button").fancybox({
        prevEffect: 'none',
        nextEffect: 'none',
        closeBtn: false,
        helpers: {
            title: {type: 'inside'},
            buttons: {}
        }
    });

    var userTable = $("#users_table").DataTable({
        "ajax": {
            "url": "../javascript/users.json",
            "dataSrc": ""
        },
        //"bProcessing": true, --> commented cus' it seemed redundant, it would disable my sorting, and other features of datatables.net
        //"bServerSide": true,
        "aoColumns": [
            {"mData": "id", "title": "User ID"},
            {"mData": "email", "title": "Email"},
            {"mData": "username", "title": "Username"}
        ]

    });
    //A bad looking init., but I needed the data, and browser doesn't
    // recognize a $(this) as a clear object for some reason, so I stored
    // it into a variable, and row()/rows()/data() functions started working.
    userTable;

    $("#users_table tbody").on("click", "tr", function () {
        var data = userTable.row(this).data();
        if ($(this).hasClass("selected")) {
            $(this).removeClass("selected");
        } else {
            userTable.$("tr.selected").removeClass("selected");
            $(this).addClass("selected");

            $("#deleteUserBtn").click(function () {
                console.log(data);
                $.ajax({
                    "type": "POST",
                    "url": "../DB/deleteUser.php",
                    "data": data,
                    "success": function (response) {
                        alert("User deleted " + response);
                    },
                    "error": function (exception) {
                        alert('Exception:', exception);
                    }
                });

                userTable.row(".selected").remove().draw(false);
            });
        }
    });

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

$(function () {
    $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
});
