var directionDisplay, map;
var directionsService = new google.maps.DirectionsService();
var geocoder = new google.maps.Geocoder();

function initialize() {

    var latlng = new google.maps.LatLng(34.703705, 137.734902);
    var rendererOptions = {
        draggable: true
    };
    directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);

    var myOptions = {
        zoom: 15,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById("directionsPanel"));
}

function calcRoute() {
    var travelMode = $('input[name="travelMode"]:checked').val();
    var from = $("#from").val();
    var to = $("#to").val();

    var request = {
        origin: from,
        destination: to,
        unitSystem: google.maps.UnitSystem.METRIC,
        travelMode: google.maps.DirectionsTravelMode[travelMode]
    };

    directionsService
        .route(
            request,
            function (response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    $('#directionsPanel').empty();
                    directionsDisplay.setDirections(response);

                    var time = response.routes[0].legs[0].duration.text;
                    var distance = response.routes[0].legs[0].distance.text;
                    insert_history(time, distance);

                } else {
                    alert("Error!");
                }
            });
}

function insert_history(time, distance) {
    console.log(userid);
    $(function () {
        $.ajax({
            url: "./insert_history.php",
            type: "post",
            dataType: "json",
            data: {
                "userid": userid,
                "origin": $("#from").val(),
                "destination": $("#to").val(),
                "travelMode": $('input[name="travelMode"]:checked').val(),
                "time": time,
                "distance": distance,
            }
        }).done(function (response) {
            console.log(response);
        }).fail(function () {
        });
    });
}