var url = $("#urlWeb").val();
var user_id = ($("#user_id").val() != 'null')?$("#user_id").val():null;
// trả về các sản phẩm có trong giỏ hàng
function productsResponse() {
    var theResponse = null;
    $.ajax({
        url: url +'/cart/getProduct',
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

function renderMiniCart(){
    if(user_id == null){
        $("#sessionMiniCart").html("Cart is currently empty!!!");
        $("#sessionMiniCart").css({
            "text-align" : "center"
            });
        return 0;
    }else{
        products = productsResponse();
        console.log(products);
        let htmlMiniCart = "";
        if(products == null){
            $("#sessionMiniCart").html("Cart is currently empty!!!");
            $("#sessionMiniCart").css({
                "text-align" : "center"
                });
            return 0;
        }
        let sum = 0;
        for(let i=0; i< products.length; i++){
            let size="";
            if(products[i].Size != "null"){
                size = products[i].Size;
            }
            let total = products[i].Quantity * products[i].CurrentPrice;
            sum +=total;
            htmlMiniCart += '<li class="minicart-product">'
                        +    '<a class="product-item_remove" onclick="cartDeleteMini(\'' +products[i].cart_id+ '\')" href="javascript:void(0)"><i class="ion-android-close"></i></a>'
                        +    '<div class="product-item_img">'
                        +        '<img src="'+url+'/assets/images/product/'+products[i].Avatar+'" alt="Product Image">'
                        +    '</div>'
                        +    '<div class="product-item_content">'
                        +        '<a class="product-item_title" href="'+url + "/product/" + products[i].Product_id+'">'+ products[i].Name+'</a>'
                        +        '<span class="product-item_quantity">'+products[i].Quantity+' x $'+products[i].CurrentPrice.toFixed(2)+'</span>'
                        +    '</div>'
                        +'</li>';
        }
        $("#sessionMiniCart").html(htmlMiniCart);
        $("#subTotal").html("$"+sum.toFixed(2));
    }
}
function cartDeleteMini(id){
    if(user_id == null){
        return confirm("You must be logged in to do this!!!");
    }else{
        let urlcartDelete = url +'/cart/cartDelete/'+id ;
        $.ajax({
            url : urlcartDelete,
            type : "get",
            cache: false,
            dataType:"text",
            data : {
            },
            success : function (result){
                if(result){
                    alert("The product has been removed from the cart!");
                };
                renderMiniCart();
            }
        });
    }
}
renderMiniCart();
