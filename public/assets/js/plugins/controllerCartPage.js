
var url = $("#urlWeb").val();
var user_id = $("#user_id").val();
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

// sữa lại render
function renderListProduct(){
    products = productsResponse();
    let htmlCart = "";
    for(let i=0; i< products.length; i++){
        let htmlstock="";
        let quantityProducts = $("#quantity"+products[i].Product_id).val();
        let total = quantityProducts * products[i].CurrentPrice;
        if(products[i].Quantity >= 1){
            htmlstock = '<td class="hiraola-product-stock-status"><span class="in-stock">In Stock</span></td>'
        }else{
            htmlstock = '<td class="hiraola-product-stock-status"><span class="out-stock">Out Stock</span></td>'
        }
        htmlCart += '<tr>'
                    +        '<td  class="hiraola-product_remove">' 
                    +            '<a style="font-size: 30px" onclick="wishlistDelete(\'' +products[i].WishList_id+ '\')" href="javascript:void(0)"><i class="fas fa-trash-alt" title="Remove"></i></a>'
                    +        '</td>'
                    +        '<td class="hiraola-product-thumbnail"><a href="'+url + "/product/" + products[i].Product_id+'"><img src="'+url+'/assets/images/product/'+products[i].Avatar+'" alt="Cart Thumbnail" width="100px"></a>'
                    +        '</td>'
                    +        '<td class="hiraola-product-name"><a href="'+url + "/product/" + products[i].Product_id+'">'+ products[i].Name+'</a></td>'
                    +        '<td class="hiraola-product-price"><span class="amount">$'+products[i].CurrentPrice+'</span></td>'
                    +        '<td class="quantity">'
                    +           '<label>Quantity</label>'
                    +           '<div class="cart-plus-minus">'
                    +               '<input id="quantity'+products[i].Product_id+'" class="cart-plus-minus-box" value="1" type="text">'
                    +                '<div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>'
                    +                '<div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>'
                    +           '</div>'
                    +       '</td>'
                    +       '<td class="product-subtotal"><span class="amount">'+total+'</span></td>'
                    +    '</tr>';
       
                                        
    }
    if(products == null){
        return $("#listProducts").html(htmlCart);
    }
    $("#listProducts").html(htmlCart);
}
renderListProduct();
