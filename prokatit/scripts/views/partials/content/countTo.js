$(document).ready(function(){
    var hasBeenSeen = false;
    $(document).scroll(function(event) {
        var result = $('#prokatit-countTo').isOnScreen();
        if(result && !hasBeenSeen) {
            hasBeenSeen = true;
            $('.timer').countTo({
                speed: 4000
            });
        }
    });

    $('.parallax-window').parallax();
});
