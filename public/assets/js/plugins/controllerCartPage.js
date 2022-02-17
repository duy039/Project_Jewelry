
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
function changeQuantity(){
    for(let i=0; i< products.length; i++){
        let total = $("#quantity"+i).val() * products[i].CurrentPrice;
        $("#total"+i).html("$"+total.toFixed(2));
    }
}


function renderListProduct(){
    if(user_id == null){
        $("#sessionCart").html("Cart is currently empty!!!");
        $("#sessionCart").css({
            "text-align" : "center"
            });
        return 0;
    }else{
        products = productsResponse();
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
                        +            '<a style="font-size: 30px" onclick="cartDelete(\'' +i+ '\')" href="javascript:void(0)"><i class="fas fa-trash-alt" title="Remove"></i></a>'
                        +        '</td>'
                        +        '<td class="hiraola-product-thumbnail"><a href="'+url + "/product/" + products[i].Product_id+'"><img src="'+url+'/assets/images/product/'+products[i].Avatar+'" alt="Cart Thumbnail" width="100px"></a>'
                        +        '</td>'
                        +        '<td class="hiraola-product-name"><a href="'+url + "/product/" + products[i].Product_id+'">'+ products[i].Name+'</a></td>'
                        +        '<td class="hiraola-product-price"><span class="amount">$'+products[i].CurrentPrice+'</span></td>'
                        +        '<td class="hiraola-product-price"><span class="amount">'+size+'</span></td>'
                        +        '<td class="quantity">'
                        +           '<div class="cart-plus-minus">'
                        +               '<input onchange="changeQuantity()" id="quantity'+i+'"  class="cart-plus-minus-box" value="'+products[i].Quantity+'" type="number">'
                        +                '<div class="dec qtybutton" onclick="changeQuantity()"><i class="fa fa-angle-down"></i></div>'
                        +                '<div class="inc qtybutton" onclick="changeQuantity()"><i class="fa fa-angle-up"></i></div>'
                        +           '</div>'
                        +       '</td>'
                        +       '<td class="product-subtotal"><span id="total'+i+'" class="amount">'+total.toFixed(2)+'</span></td>'
                        +    '</tr>';
        }
        $("#listProducts").html(htmlCart);
        $("#subTotal").html("$"+sum);
    }
}

renderListProduct();
