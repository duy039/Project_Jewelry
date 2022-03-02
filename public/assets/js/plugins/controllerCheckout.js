var url = $("#urlWeb").val();
var user_id = ($("#user_id").val() != 'null')?$("#user_id").val():null;
var keyAPI ='AIzaSyBBILQ16GymM4XtzUY6Qu_VzzgTQ8Vk87U';
var inputAddressCustomer = "";
function responseGeocoding() {
    // local var
    inputAddressCustomer = $("#deliveryAddress").val()
    var theResponse = null;
    // jQuery ajax
    $.ajax({
        url: "https://maps.googleapis.com/maps/api/geocode/json?address="+inputAddressCustomer+"&key="+keyAPI,
        type: 'get',
        data: {

        },
        dataType: "json",
        async: false,
        success: function(respText) {
            theResponse = respText;
        }
    });
    return theResponse;
}
function responseGeocodingShop() {
    // local var
    addressShop = "FPT Aptech";
    var theResponse = null;
    // jQuery ajax
    $.ajax({
        url: "https://maps.googleapis.com/maps/api/geocode/json?address="+addressShop+"&key="+keyAPI,
        type: 'get',
        data: {

        },
        dataType: "json",
        async: false,
        success: function(respText) {
            theResponse = respText;
        }
    });
    return theResponse;
}

var routeMap = null;
var resultAPIGeocodeCustomer =  null;
var shop = responseGeocodingShop().results[0];
var customer = null;
var customerMarker = null;
var deliveryDistance = 0;
function setCustomer(){
    resultAPIGeocodeCustomer =  responseGeocoding();
    if(resultAPIGeocodeCustomer.status == "OK"){
        customer = resultAPIGeocodeCustomer.results[0];
    }else{
        return false;
    }
}
var display= null;
function changeInput(){
    setCustomer();
    var dservie = new google.maps.DirectionsService();
    if(display){
        display.setMap(null);
    }
    display = new google.maps.DirectionsRenderer;
    display.setMap(routeMap);
    let req = {
        origin: { lat:shop.geometry.location.lat, lng:shop.geometry.location.lng },
        destination: {lat:customer.geometry.location.lat, lng:customer.geometry.location.lng},
        travelMode: "DRIVING",
        provideRouteAlternatives: true
    };
    dservie.route(req, function(result, status){
        if(status == "OK"){
            console.log(result);
            deliveryDistance = result.routes[0].legs[0].distance.value/1000 ;
            deliveryDistance = deliveryDistance.toFixed(1)
            display.setDirections(result);
        }
    });

}

function initialize(){
    // khởi tạo map
    routeMap = new google.maps.Map(document.getElementById("map"), {
        center: {lat:shop.geometry.location.lat, lng:shop.geometry.location.lng},
        zoom: 14
    });
    var shopMarker = new google.maps.Marker({
        position: {lat:shop.geometry.location.lat, lng:shop.geometry.location.lng},
        map: routeMap
    });

}
