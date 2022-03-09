var url = $("#urlWeb").val();
var user_id = ($("#user_id").val() != 'null') ? $("#user_id").val() : null;
var keyAPI = 'AIzaSyBBILQ16GymM4XtzUY6Qu_VzzgTQ8Vk87U';
var inputAddressCustomer = "";
function responseGeocoding() {
    // local var
    inputAddressCustomer = $("#deliveryAddress").val()
    var theResponse = null;
    // jQuery ajax
    $.ajax({
        url: "https://maps.googleapis.com/maps/api/geocode/json?address=" + inputAddressCustomer + "&key=" + keyAPI,
        type: 'get',
        data: {

        },
        dataType: "json",
        async: false,
        success: function (respText) {
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
        url: "https://maps.googleapis.com/maps/api/geocode/json?address=" + addressShop + "&key=" + keyAPI,
        type: 'get',
        data: {

        },
        dataType: "json",
        async: false,
        success: function (respText) {
            theResponse = respText;
        }
    });
    return theResponse;
}
function productsResponse() {
    var theResponse = null;
    $.ajax({
        url: url + '/cart/getProduct',
        type: 'get',
        data: {

        },
        dataType: "text",
        async: false,
        success: function (respText) {
            if (respText != false) {
                theResponse = JSON.parse(respText);
            } else {
                theResponse = null;
            }
        }
    });
    return theResponse;
}
var productsInCart = productsResponse();

var routeMap = null;
var resultAPIGeocodeCustomer = null;
var shop = responseGeocodingShop().results[0];
var customer = null;
var customerMarker = null;
var deliveryDistance = 0;

var shippingFee = 0;
var discount = 0;
var orderTotal = 0;
var limitedVoucher = 0;
var display = null;
function setCustomer() {
    resultAPIGeocodeCustomer = responseGeocoding();
    if (resultAPIGeocodeCustomer.status == "OK") {
        customer = resultAPIGeocodeCustomer.results[0];
    } else {
        return false;
    }
}
function changeInput() {
    setCustomer();
    var dservie = new google.maps.DirectionsService();
    if (display) {
        display.setMap(null);
    }
    display = new google.maps.DirectionsRenderer;
    display.setMap(routeMap);
    let req = {
        origin: { lat: shop.geometry.location.lat, lng: shop.geometry.location.lng },
        destination: { lat: customer.geometry.location.lat, lng: customer.geometry.location.lng },
        travelMode: "DRIVING",
        provideRouteAlternatives: true
    };
    dservie.route(req, function (result, status) {
        if (status == "OK") {
            console.log(result);
            deliveryDistance = result.routes[0].legs[0].distance.value / 1000;
            deliveryDistance = deliveryDistance.toFixed(1)
            display.setDirections(result);
            renderBill();
        }
    });

}
function initialize() {
    // khởi tạo map
    routeMap = new google.maps.Map(document.getElementById("map"), {
        center: { lat: shop.geometry.location.lat, lng: shop.geometry.location.lng },
        zoom: 14
    });
    var shopMarker = new google.maps.Marker({
        position: { lat: shop.geometry.location.lat, lng: shop.geometry.location.lng },
        map: routeMap
    });

}

function checkVoucher() {
    let coupon_code = $("#coupon_code").val();
    $.ajax({
        url: url + "/checkout/checkVoucher/" + coupon_code,
        type: 'get',
        data: {},
        dataType: "text",
        success: function (respText) {
            if (respText == false) {
                alert("Invalid Code!!!");
                $("#NotificationCoupon_code").html("Voucher is not valid!");
                $("#NotificationCoupon_code").css({
                    "color": "red",
                    "font-family": "cursive"
                });
                return 0;
            }
            let voucher = JSON.parse(respText);
            let htmlNotificationCoupon_code = "";
            //  gán tỷ lệ sale và giới hạn sale
            discount = voucher.Sale;
            limitedVoucher = voucher.Limited;
            //  in ra dòng thông báo
            if (limitedVoucher > 0) {
                // tính giá giảm
                htmlNotificationCoupon_code = "Voucher \"" + voucher.Name + "\" has been successfully applied <br>"
                    + "You get a total of " + discount + "% off before tax and up to $" + limitedVoucher;
            } else {
                htmlNotificationCoupon_code = "Voucher \"" + voucher.Name + "\" has been successfully applied <br>"
                    + "You get a total of " + discount + "% off before tax and  UNLIMITED";
            }
            $("#NotificationCoupon_code").html(htmlNotificationCoupon_code);
            $("#NotificationCoupon_code").css({
                "color": "rgb(50, 199, 5)",
                "font-family": "cursive"
            });
            renderBill();
        }
    });
}

// phần bill Order
function renderBill() {
    var taxName = $('#taxName').val();
    var taxPercentage = $('#taxPercentage').val();
    let htmlProductBill = '';
    let htmlDiscount = '';
    var sum = 0;
    let priceDiscount = 0;
    // tính phí ship
    if ($("input[name='mapShip']")[0].checked) {
        if (deliveryDistance <= 2) {
            shippingFee = 2;
        } else {
            shippingFee = ((deliveryDistance - 2) * 0.3) + 2;
        }
        console.log(shippingFee, deliveryDistance)
    } else {
        shippingFee = 5;
    }
    shippingFee = shippingFee.toFixed(1);

    // lấy ra các sản phẩm có trong giỏ
    for (let i in productsInCart) {
        sum += (productsInCart[i].CurrentPrice * productsInCart[i].Quantity)
        let nameProduct = '';
        if (productsInCart[i].Name.length > 12) {
            nameProduct = productsInCart[i].Name.slice(0, 13) + "... (<span class='sizeProductBill'>Size " + productsInCart[i].Size + "</span>)";
        } else {
            nameProduct = productsInCart[i].Name;
        }
        htmlProductBill += '<tr class="cart_item">'
            + '<td class="cart-product-name" title="' + productsInCart[i].Name + '"> '
            + nameProduct + '<strong class="product-quantity"> × ' + productsInCart[i].Quantity + '</strong>'
            + '</td>'
            + '<td class="cart-product-total"><span class="amount">$' + (productsInCart[i].CurrentPrice * productsInCart[i].Quantity) + '</span></td>'
            + '</tr>';

        var pro_id = '<input type="hidden" value="' + productsInCart[i].Product_id + '" id="pro_id" name="pro_id"></input>';
        var quantity = '<input type="hidden" value="' + productsInCart[i].Quantity + '" id="quantity" name="quantity"></input>'
        $('#pro_id').html(pro_id);
        $('#quantity').html(quantity);
    }
    // kiểm tra voucher
    if (discount == 0) {
        htmlDiscount = '<td class="priceBill" ><span class="amount"></span><span id="discountBill"></span></td>'
    } else if (limitedVoucher == 0) {
        // tính giá giảm
        priceDiscount = (sum * discount) / 100;
        htmlDiscount = '<td class="priceBill" ><span class="amount">- $</span><span id="discountBill">' + priceDiscount + '</span></td>'
    } else {
        priceDiscount = (sum * discount) / 100;
        if (priceDiscount > limitedVoucher) {
            priceDiscount = limitedVoucher;
        }
        htmlDiscount = '<td class="priceBill discountBill" ><span class="amount">- $</span><span id="discountBill">' + priceDiscount + '</span></td>'
    }

    // tính tổng hóa đơn
    let totalz = sum + Number(shippingFee) - priceDiscount;
    orderTotal = totalz + ((totalz * taxPercentage) / 100);
    orderTotal = orderTotal.toFixed(2);
    var htmlTotalBill = '<tr class="cart-subtotal">'
        + '<th>Cart Subtotal</th>'
        + '<td class="priceBill" ><span class="amount">$</span><span id="subtotalBill">' + sum.toFixed(2) + '</span></td>'
        + '</tr>'
        + '<tr class="cart-subtotal">'
        + ' <th>Shipping Fee</th>'
        + ' <td class="priceBill" ><span class="amount">$</span><span id="shippingFeeBill">' + shippingFee + ' (' + deliveryDistance + 'Km)</span></td>'
        + '</tr>'
        + '<tr class="cart-subtotal">'
        + '<th>Discount</th>'
        + htmlDiscount
        + '</tr>'
        + ' <tr class="cart-subtotal">'
        + '<th>Price After Tax</th>'
        + '<td class="priceBill" ><span class="amount" id="taxPercentageBill">' + taxPercentage + '% ' + taxName + '</span></td>'
        + ' </tr>'
        + '<tr class="order-total">'
        + '<th>Order Total</th>'
        + '<td class="priceBill" ><strong><span class="amount">$' + orderTotal + '</span></strong></td>'
        + '</tr>'

    var total = '<input type="hidden" value="' + orderTotal + '" id="totalOrderBill" name="total"></input>';
    var tax = '<input type="hidden" value="' + taxPercentage + '" name="tax"></input>'
    var ship = '<input type="hidden" value="' + shippingFee + '" name="ship"></input>'
    var discounts = '<input type="hidden" value="' + priceDiscount + '" name="discount"></input>'

    $('#displayProductBill').html(htmlProductBill);
    $('#displayTotalBill').html(htmlTotalBill);
    $('#toTal').html(total);
    $('#tax').html(tax);
    $('#ship').html(ship);
    $('#discount').html(discounts);
}
renderBill();
