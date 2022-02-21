
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
        return confirm("You must be logged in to add products to your wish list");
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
                    alert("The product has been removed from favorites");
                };
                renderWishlist();
            }
        });
    }
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
                        return alert("The product has been added to the cart");
                    }
                }
            });
        }
    })
}

renderWishlist();