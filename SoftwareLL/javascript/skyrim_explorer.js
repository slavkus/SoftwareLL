$(document).ready(function () {
    var trigger = null;
    var background = 1;
    $('body').css('background-image', 'url(../skyrim_source/backgrounds/back2.jpg)');
    backgroundTrigger();

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
        }, 2000);
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
});
