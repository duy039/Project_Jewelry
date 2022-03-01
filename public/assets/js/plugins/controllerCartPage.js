
var url = $("#urlWeb").val();
var user_id = ($("#user_id").val() != 'null')?$("#user_id").val():null;
// trả về các sản phảm có trong giỏ hàng
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
let products = productsResponse();

// thay đổi số lượng sản phẩm
function changeQuantity(id, method){
    let urlcartDelete = url +'/cart/quantityChange/'+id +"/"+method;
    $.ajax({
        url : urlcartDelete,
        type : "get",
        cache: false,
        dataType:"text",
        data : {
        },
        success : function (result){
            renderListProduct();
        }
    });

}


function renderListProduct(){
    products = productsResponse();
    console.log(products);
    let htmlCart = "";
    if(products == null){
        $("#sessionCart").html("Cart is currently empty!!!");
        $("#sessionCart").css({
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
        htmlCart += '<tr>'
                    +        '<td  class="hiraola-product_remove">'
                    +            '<a style="font-size: 30px" onclick="cartDelete(\'' +products[i].cart_id+ '\')" href="javascript:void(0)"><i class="fas fa-trash-alt" title="Remove"></i></a>'
                    +        '</td>'
                    +        '<td class="hiraola-product-thumbnail"><a href="'+url + "/product/" + products[i].Product_id+'"><img src="'+url+'/assets/images/product/'+products[i].Avatar+'" alt="Cart Thumbnail" width="100px"></a>'
                    +        '</td>'
                    +        '<td class="hiraola-product-name"><a href="'+url + "/product/" + products[i].Product_id+'">'+ products[i].Name+'</a></td>'
                    +        '<td class="hiraola-product-price"><span class="amount">$'+products[i].CurrentPrice+'</span></td>'
                    +        '<td class="hiraola-product-price"><span class="amount">'+size+'</span></td>'
                    +        '<td class="quantity">'
                    +           '<div class="cart-plus-minus">'
                    +               '<input onchange="changeQuantity()" id="quantity'+i+'"  class="cart-plus-minus-box" value="'+products[i].Quantity+'" type="number">'
                    +                '<div class="dec qtybutton" onclick="changeQuantity(\'' +products[i].cart_id+ '\',\'down\')"><i class="fa fa-angle-down"></i></div>'
                    +                '<div class="inc qtybutton" onclick="changeQuantity(\'' +products[i].cart_id+ '\',\'up\')"><i class="fa fa-angle-up"></i></div>'
                    +           '</div>'
                    +       '</td>'
                    +       '<td class="product-subtotal"><span id="total'+i+'" class="amount">$'+total.toFixed(2)+'</span></td>'
                    +    '</tr>';
    }
    $("#listProducts").html(htmlCart);
    $("#subTotalMiniCart").html("$"+sum.toFixed(2));
}
function cartDelete(id){
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
                swal('Success',"The product has been removed from the cart!",'success');
            };
            renderListProduct();
        }
    });
}
renderListProduct();
