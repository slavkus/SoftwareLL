$(document).ready(function () {
    var trigger = null;
    var background = 1;
    $('body').css('background-image', 'url(../skyrim_source/backgrounds/back2.jpg)');
    backgroundTrigger();

    function switchBackground() {
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
        }, 10000);
    }
});
