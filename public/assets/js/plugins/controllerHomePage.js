var user_id = ($("#user_id").val() != 'null') ? $("#user_id").val() : null;
var url = $("#urlWeb").val();
var pro_id = $("#pro_id").val();

function wishlistsResponse() {
    // local var
    var theResponse = null;
    // jQuery ajax
    $.ajax({
        url:'wishlists/' + user_id,
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

function renderIconWishlist(productIDWishlist) {
    wishlists = (user_id != null) ? wishlistsResponse() : null;
    let htmlWishkist = "";
    let test = true;
    if (wishlists != null) {
        for (let i = 0; i < wishlists.length; i++) {
            if (wishlists[i].Product_id == productIDWishlist) {
                htmlWishkist = '<a class="hiraola-add_compare" href="javascript:void(0)" onclick="wishlistDelete(\'' + productIDWishlist + '\',\'' + wishlists[i].WishList_id + '\')" data-toggle="tooltip" data-placement="top" title="Remove from favorites" style="color: rgb(255, 51, 0)"><i class="fas fa-heart"></i></a>'
                test = false;
            }
        }
    }
    if (test) {
        htmlWishkist = '<a class="hiraola-add_compare" href="javascript:void(0)" onclick="wishlistHandler(\'' + productIDWishlist + '\')" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="far fa-heart"></i></a>';
    }
    if ($("#a" + productIDWishlist) != null || $("#r" + productIDWishlist) != null || $("#ra" + productIDWishlist) != null || $("#b" + productIDWishlist) != null || $("#ba" + productIDWishlist) != null) {
        $("#a" + productIDWishlist).html(htmlWishkist);
        $("#n" + productIDWishlist).html(htmlWishkist);
        $("#na" + productIDWishlist).html(htmlWishkist);
        $("#b" + productIDWishlist).html(htmlWishkist);
        $("#ba" + productIDWishlist).html(htmlWishkist);
        $("#r" + productIDWishlist).html(htmlWishkist);
        $("#ra" + productIDWishlist).html(htmlWishkist);
    }
    if ($("#r" + productIDWishlist) != null || $("#ra" + productIDWishlist) != null) {
        $("#r" + productIDWishlist).html(htmlWishkist);
        $("#ra" + productIDWishlist).html(htmlWishkist);
    }
    if ($("#b" + productIDWishlist) != null || $("#ba" + productIDWishlist) != null) {
        $("#b" + productIDWishlist).html(htmlWishkist);
        $("#ba" + productIDWishlist).html(htmlWishkist);
    }
    if ($("#n" + productIDWishlist) != null || $("#na" + productIDWishlist) != null) {
        $("#n" + productIDWishlist).html(htmlWishkist);
        $("#na" + productIDWishlist).html(htmlWishkist);
    }
}
function wishlistHandler(prod_id) {
    if(user_id == null){
        return swal('Warning',"You must be logged in to add products to your wish list",'warning');
    }else{
    var urlAddWishlist = '/wishlistHandler';
    $.ajax({
        url: urlAddWishlist,
        type: "post",
        cache: false,
        dataType: "text",
        data: {
            _token: $("#csrf_token").val(),
            'user_id': user_id,
            'product_id': prod_id
        },
        success: function (result) {
            if (result) {
                swal('Success',"The product has been added to favorites",'success');
            };
            renderIconWishlist(prod_id);
        }
    });
    }
}

function wishlistDelete(prod_id, wishlist_id) {
    let urlDeleteWishlist = '/wishlistDelete/' + user_id + '/' + wishlist_id;
    $.ajax({
        url: urlDeleteWishlist,
        type: "get",
        cache: false,
        dataType: "text",
        data: {
        },
        success: function (result) {
            if (result) {
                swal('Success',"The product has been removed from favorites",'success');
            };
            renderIconWishlist(prod_id);
        }
    });

}

function productsResponse() {
    var theResponse = null;
    $.ajax({
        url: '/getProduct',
        type: 'get',
        data: {

        },
        dataType: "text",
        async: false,
        success: function(respText) {
            if(respText!=false){
                theResponse = JSON.parse(respText);
            }else{
                theResponse = null;
            }

        }
    });
    return theResponse;
}

function renderMiniCart() {
    if (user_id == null) {
        $("#sessionMiniCart").html("Cart is currently empty!!!");
        $("#sessionMiniCart").css({
            "text-align": "center"
        });
        return 0;
    } else {
        products = productsResponse();
        console.log(products);
        let htmlMiniCart = "";
        if (products == null) {
            $("#sessionMiniCart").html("Cart is currently empty!!!");
            $("#sessionMiniCart").css({
                "text-align": "center"
            });
            return 0;
        }
        let sum = 0;
        for (let i = 0; i < products.length; i++) {
            let size = "";
            if (products[i].Size != "null") {
                size = products[i].Size;
            }
            let total = products[i].Quantity * products[i].CurrentPrice;
            sum += total;
            htmlMiniCart += '<li class="minicart-product">'
                + '<a class="product-item_remove" onclick="cartDeleteMini(\'' + products[i].cart_id + '\')" href="javascript:void(0)"><i class="ion-android-close"></i></a>'
                + '<div class="product-item_img">'
                + '<img src="/assets/images/product/' + products[i].Avatar + '" alt="Product Image">'
                + '</div>'
                + '<div class="product-item_content">'
                + '<a class="product-item_title" href=""/product/"' + products[i].Product_id + '">' + products[i].Name + '</a>'
                + '<span class="product-item_quantity">' + products[i].Quantity + ' x $' + products[i].CurrentPrice.toFixed(2) + '</span>'
                + '</div>'
                + '</li>';
        }
        $("#sessionMiniCart").html(htmlMiniCart);
        $("#subTotalMiniCart").html("$" + sum.toFixed(2));
    }
}

function cartDeleteMini(id) {
    if (user_id == null) {
        return confirm("You must be logged in to do this!!!");
    } else {
        let urlcartDelete = 'cartDelete/' + id;
        $.ajax({
            url: urlcartDelete,
            type: "get",
            cache: false,
            dataType: "text",
            data: {
            },
            success: function (result) {
                if (result) {
                    swal('Success',"The product has been removed from the cart!",'success');
                };
                renderMiniCart();
            }
        });
    }
}
renderMiniCart();
