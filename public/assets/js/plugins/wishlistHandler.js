
var url = $("#urlWeb").val();
var user_id = ($("#user_id").val() != 'null')?$("#user_id").val():null;
function wishlistResponse() {
    // local var
    var theResponse = null;
    // jQuery ajax
    $.ajax({
        url: url +'/wishlist/wishlist/' + user_id,
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
let products = wishlistResponse();

function renderWishlist(){
    products = wishlistResponse();
    let htmlWishkist = "";
    for(let i=0; i< products.length; i++){
        let htmlstock="";
        if(products[i].Quantity >= 1){
            htmlstock = '<td class="hiraola-product-stock-status"><span class="in-stock">In Stock</span></td>'
        }else{
            htmlstock = '<td class="hiraola-product-stock-status"><span class="out-stock">Out Stock</span></td>'
        }
        htmlWishkist += '<tr>'
                    +        '<td  class="hiraola-product_remove">'
                    +            '<a style="font-size: 30px" onclick="wishlistDelete(\'' +products[i].WishList_id+ '\')" href="javascript:void(0)"><i class="fas fa-trash-alt" title="Remove"></i></a>'
                    +        '</td>'
                    +        '<td class="hiraola-product-thumbnail"><a href="'+url + "/product/" + products[i].Product_id+'"><img src="'+url+'/assets/images/product/'+products[i].Avatar+'" alt="Wishlist Thumbnail" width="100px"></a>'
                    +        '</td>'
                    +        '<td class="hiraola-product-name"><a href="'+url + "/product/" + products[i].Product_id+'">'+ products[i].Name+'</a></td>'
                    +        '<td class="hiraola-product-price"><span class="amount">$'+products[i].CurrentPrice+'</span></td>'
                    +        htmlstock
                    +        '<td class="hiraola-cart_btn"><a onclick="addToCartProduct(\'' +products[i].Product_id+ '\')" href="javascript:void(0)">add to cart</a></td>'
                    +    '</tr>';
    }
    $("#sessionWishlist").html(htmlWishkist);
}

// xử lý khi user chọn Xóa sản phẩm ra khỏi danh sách yêu thích
function wishlistDelete(wishlist_id){
    if(user_id == null){
        return swal({
            title: "Warning",
            text: "You must be logged in to add products to your wish list!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              window.location('http://127.0.0.1:8000/login');
            }
          });
    }else{
        let urlDeleteWishlist = url +'/wishlistDelete/'+user_id + '/' + wishlist_id ;
        $.ajax({
            url : urlDeleteWishlist,
            type : "get",
            cache: false,
            dataType:"text",
            data : {
            },
            success : function (result){
                if(result){
                    swal('Success',"The product has been removed from favorites",'success');
                };
                renderWishlist();
            }
        });
    }
}

//render minicart
function renderMiniCart() {
    // if (user_id == null) {
    //     $("#sessionMiniCart").html("Cart is currently empty!!!");
    //     $("#sessionMiniCart").css({
    //         "text-align": "center"
    //     });
    //     return 0;
    // } else {
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
        $("#homeMiniCart").html("$" + sum.toFixed(2));
    // }
}
 // thêm sản phẩm vào giỏ
function addToCartProduct(productAdd){
    var urlajax = url +'/shop/quickView/' + productAdd;
    $.ajax({
        url : urlajax,
        type : "get",
        dataType:"text",
        data : {

        },
        success : function (result){
            var product = JSON.parse(result);
            let urlAddToCart = url +'/addToCart';
            let size = "null";
            if(product.Size.length > 0){
                size = product.Size[0];
            }
            $.ajax({
                url : urlAddToCart,
                type : "post",
                cache: false,
                dataType:"text",
                data : {
                    _token: $("#csrf_token").val(),
                    'product_id' : productAdd,
                    'size' : size,
                    'quantity' : 1
                },
                success : function (result){
                    if(result == true){
                        return swal('Success',"The product has been added to the cart",'success');
                    }renderMiniCart();
                }
            });
        }
    })
}

renderWishlist();
renderMiniCart();
