$(document).ready(function(){
    $("#prokatit-landing .owl-carousel").owlCarousel({
        loop: true,
        items: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        autoplayTimeout: 5000,
        smartSpeed: 1000,
        animateOut: 'fadeOut',
        touchDrag: false,
        mouseDrag: false,
        dots: false
    });

    var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

    $('#upper .date').datepicker({
        startDate: today,
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        language: "ru",
        daysOfWeekHighlighted: "0,6",
        orientation: "auto",
        autoclose: true,
        todayHighlight: true,
        beforeShowDay: function(date) {
            //console.log(date);
            var dateFormat = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
            //console.log(dateFormat);
            if (dateFormat == '2016-05-06'){
                console.log('here');
                return {classes: 'highlight', tooltip: 'Title'};
            }
        }
    });

    $('#upper form').validator().on('submit', function (e) {
        if (e.isDefaultPrevented()) {
        } else {
            // everything looks good!
            e.preventDefault();
            submitForm();
        }
    });

    function submitForm(){
        var dateFrom = $('#upper [name=dateFrom]').val();
        var dateTo = $('#upper [name=dateTo]').val();
        var console = $('#upper [name=console]').val();
        var phone = $('#upper [name=phone]').val();

        $.ajax({
            type: "POST",
            url: "https://" + window.location.host + "/home/sendMail",
            data: "dateFrom=" + dateFrom + "&dateTo=" + dateTo + "&console=" + console + "&phone=" + phone,
            success : function(text){
                if (text == "success"){
                    formSuccess();
                }
            }
        });
    }

    function formSuccess() {
        $( "#upper form" ).addClass('animated fadeOut');
        $('#prokatit-modal').modal();
    }


});
