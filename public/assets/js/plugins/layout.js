var url = $("#urlWeb").val();
var user_id = ($("#user_id").val() != 'null') ? $("#user_id").val() : null;
// trả về các sản phẩm có trong giỏ hàng
function productsCart() {
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

function renderMiniCart() {
    let productsCartLatout = productsCart();
    let htmlMiniCart = "";
    if (productsCartLatout == null) {
        $("#sessionMiniCart").html("Cart is currently empty!!!");
        $("#sessionMiniCart").css({
            "text-align": "center"
        });
        return 0;
    }
    let sum = 0;
    for (let i = 0; i < productsCartLatout.length; i++) {
        let size = "";
        if (productsCartLatout[i].Size != "null") {
            size = productsCartLatout[i].Size;
        }
        let total = productsCartLatout[i].Quantity * productsCartLatout[i].CurrentPrice;
        sum += total;
        htmlMiniCart += '<li class="minicart-product">'
            + '<a class="product-item_remove" onclick="cartDeleteMini(\'' + productsCartLatout[i].cart_id + '\')" href="javascript:void(0)"><i class="ion-android-close"></i></a>'
            + '<div class="product-item_img">'
            + '<img src="' + url + '/assets/images/product/' + productsCartLatout[i].Avatar + '" alt="Product Image">'
            + '</div>'
            + '<div class="product-item_content">'
            + '<a class="product-item_title" href="' + url + "/product/" + productsCartLatout[i].Product_id + '">' + productsCartLatout[i].Name + '</a>'
            + '<span class="product-item_quantity">' + productsCartLatout[i].Quantity + ' x $' + productsCartLatout[i].CurrentPrice.toFixed(2) + '</span>'
            + '</div>'
            + '</li>';
    }
    $("#sessionMiniCart").html(htmlMiniCart);
    $("#subTotalMiniCart").html("$" + sum.toFixed(2));
}
function cartDeleteMini(id) {
    let urlcartDelete = url + '/cart/cartDelete/' + id;
    $.ajax({
        url: urlcartDelete,
        type: "get",
        cache: false,
        dataType: "text",
        data: {
        },
        success: function (result) {
            if (result) {
                swal('Success','The product has been removed from the cart!','success');
            };
            renderMiniCart();
        }
    });
}
renderMiniCart();
