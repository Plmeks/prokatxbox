$(document).ready(function(){
    alert('here');
    $.ajax({
        type: "GET",
        url: "http://" + window.location.host + "test/",
        dataType: 'json',
        data: "",
        success: (function (data) {
            console.log(data);
        })
    });
});
