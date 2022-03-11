var url = $("#urlWeb").val();
function renderTowCompare(){
    var htmlProduct = " ";
    var urlGetCompare = url +'/product/compare/getProduct' ;
    $.ajax({
            url : urlGetCompare,
            type : "get",
            dataType:"text",
            data : {

            },
            success : function (result){
                var productsCo = JSON.parse(result);
                var html = "";
                var htmlimage ="";
                var htmlAll = [];
                // Avatar của sản phẩm
                for(let productC of productsCo){
                    htmlimage +=            '<td class="comparetd compare-column-productinfo">'
                    +                        '<div class="compare-pdoduct-image">'
                    +                            '<a href="'+url+'/product/'+ productC.Product_id + '" >'
                    +                                '<img src="'+url+'/assets/images/product/' + productC.Avatar   + '" alt="Product Image">'
                    +                            '</a>'
                    +                            '<a href="javascript:void(0)" class="hiraola-compare_btn"  onclick="addToCartProduct(\'' +productC.Product_id+ '\')" >'
                    +                                '<span>ADD TO CART</span>'
                    +                            '</a>'
                    +                        '</div>'
                    +                    '</td>';
                }
                for(let i =0; i < (2-productsCo.length); i++){
                    htmlimage +=            '<td class="compare-column-productinfo">'
                    +                        '<div class="compare-pdoduct-image">'
                    +                            '<div class="compareDiv">'
                    +                                '<span class="formsg">'
                    +                                    '<a href="#searchProductCompare" style="font-size: 100px; opacity: 0.4; " class="cp-plus cp-plus_new" onclick="OpenDialSearch()">'
                    +                                        '<i class="bi bi-plus-square-dotted"></i>'
                    +                                        '<p style="padding-top: 20px; font-size: 20px">Add Product</p>'
                    +                                    '</a>'
                    +                                '</span>'
                    +                            '</div>'
                    +                        '</div>'
                    +                    '</td>';
                }
                
                
                // các thành phần còn lại
                for(let y=0;  y < productsCo.length; y++){
                    let i = y;
                    // name
                    htmlAll[i+=2] =     '<td class="comparetd"><h5 class="compare-product-name"><a href="'+url+'/product/'+ productsCo[y].Product_id + '">'+productsCo[y].Name+'</a></h5></td>';
                    // description
                    htmlAll[i+=2] =     '<td class="comparetd">'+ productsCo[y].Description + '</td>';
                    // price
                    htmlAll[i+=2] =     '<td class="comparetd">$'+ productsCo[y].Price + '</td>';

                    // size
                    let htmlsize= '';
                    for(let z in productsCo[y].Size){
                        if(z == 0){
                            htmlsize += " "+productsCo[y].Size[z]+" ";
                        }else{
                            htmlsize += ", "+productsCo[y].Size[z]+" ";
                        }
                    }

                    htmlAll[i+=2] =     '<td class="comparetd">'+htmlsize+'</td>';

                    // stock
                    if(productsCo[y].Quantity > 0){
                        htmlAll[i+=2] =     '<td class="comparetd">In Stock</td>';
                    }else{
                        htmlAll[i+=2] =     '<td class="comparetd">Out Stock</td>';
                    }
                    
                    // rating
                    let htmlRating = "";
                    for(r=0; r < productsCo[y].Rating.toFixed(); r++){
                        htmlRating+= '<span> </span><li> <i class="fa fa-star-of-david"></i></li>';
                    }
                    for(r=0; r < (5 - productsCo[y].Rating.toFixed()); r++){
                        htmlRating+= '<span> </span><li class="silver-color"><i class="fa fa-star-of-david"></i></li>';
                    }
                    htmlAll[i+=2] =     '<td class="comparetd">'
                    +                        '<div class="rating-box">'
                    +                            '<ul>'
                    +                                htmlRating
                    +                            '</ul>'
                    +                        '</div>'
                    +                    '</td>';

                    // quantity sold
                    htmlAll[i+=2] =     '<td class="comparetd">'+productsCo[y].Sold_Product_Quantity+'</td>';
                    
                    // Active
                    htmlAll[i+=2] =     '<td><button type="button" onclick="deleteProductCompare(\'' +productsCo[y].Product_id+ '\')" class="btn btn-danger">DeleteProducts</button></td>';                  
                }
                for(let y =productsCo.length; y < 2 ; y++){
                    let i = y;
                    // name
                    htmlAll[i+=2] =     '<td class="comparetd"></td>';
                    // description
                    htmlAll[i+=2] =     '<td class="comparetd"></td>';
                    // price
                    htmlAll[i+=2] =     '<td class="comparetd"></td>';
                    // size
                    htmlAll[i+=2] =     '<td class="comparetd"></td>';
                    // stock
                    htmlAll[i+=2] =     '<td class="comparetd"></td>';
                    // rating
                    htmlAll[i+=2] =     '<td class="comparetd"></td>';
                    // quantity sold
                    htmlAll[i+=2] =     '<td class="comparetd"></td>';
                    // Active
                    htmlAll[i+=2] =     '<td></td>';                  
                }

                htmlProduct =   '<tr>'
                +                    '<th class="compare-column-titles">Image</th>'
                +                    htmlimage
                +                '</tr>'
                +                '<tr>'
                +                    '<th>Product Name</th>'
                +                    htmlAll[2]
                +                    htmlAll[3]
                +                '</tr>'
                +                '<tr>'
                +                    '<th>Description</th>'
                +                    htmlAll[4]
                +                    htmlAll[5]
                +                '</tr>'
                +                '<tr>'
                +                    '<th>Price</th>'
                +                    htmlAll[6]
                +                    htmlAll[7]
                +                '</tr>'
                +                '<tr>'
                +                    '<th>Size</th>'
                +                    htmlAll[8]
                +                    htmlAll[9]
                +                '</tr>'
                +                '<tr>'
                +                    '<th>Stock</th>'
                +                    htmlAll[10]
                +                    htmlAll[11]
                +                '</tr>'
                +                '<tr>'
                +                    '<th>Rating</th>'
                +                    htmlAll[12]
                +                    htmlAll[13]
                +                '</tr>'
                +                '<tr>'
                +                    '<th>Quantity sold</th>'
                +                    htmlAll[14]
                +                    htmlAll[15]
                +                '</tr>'
                +                '<tr>'
                +                    '<th>Active</th>'
                +                    htmlAll[16]
                +                    htmlAll[17]
                +                '</tr>';
                $("#compareTowProduct").html(htmlProduct);
                console.log(htmlAll)
            }
    });

}
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
                        renderMiniCart();
                        return swal('Success',"The product has been added to the cart",'success');
                    }
                }
            });
        }
    })
}
function OpenDialSearch(){
    $("#searchProductCompare").toggleClass('open');
}

function changeSearchCompare() {
    let valueSearch = $("#inputSearchCompare").val();
    if (valueSearch.trim() == "") {
        return console.log(0);
    }
    let urlSearch = url + '/shop/searchAjax/'+valueSearch;
    console.log(urlSearch)
    $.ajax({
        url: urlSearch,
        type: "get",
        dataType: "text",
        data: {},
        success: function(result) {
            console.log(result);
            if (result == "No Products Found!!!") {
                $("#displayJewelryCompare").html(result);
                return 0;
            }
            let productSearchs = JSON.parse(result);
            let listSearch = " ";
            let test = true;
            for (let i = 0; i < productSearchs.length; i++) {
                if (i == 4) {
                    break;
                }
                if (productSearchs[i].Name.toLowerCase().search(valueSearch.toLowerCase()) != -1) {
                    test = false;
                    listSearch +=   '<li>'
                        +               '<a href="javascript:void(0)"  onclick="addProductCompare(\'' +productSearchs[i].Product_id+ '\')">'
                        +                   '<img src="'+url+'/assets/images/product/' + productSearchs[i].Avatar + '" alt="Image Product" width="80px">'
                        +                   '<span> ' + productSearchs[i].Name +'</span>'
                        +               '</a>'
                        +           '</li>';
                }
                if (test == true && i == 4) {
                    listSearch += '<li> No Products Found!!! </li>';
                    break;
                }

            }
            $("#displayJewelryCompare").css({
                "opacity": "1",
                "visibility": "visible",
                "z-index": "1"
            });
            $("#displayJewelryCompare").html(listSearch);
        }
    });
}
function addProductCompare(productAdd){
    var urlajax = url +'/addComapre';
    $.ajax({
        url : urlajax,
        type : "post",
        cache: false,
        dataType:"text",
        data : {
            _token: $("#csrf_token").val(),
            'product_id' : productAdd
        },
        success : function (result){
            if(result == true){
                $("#searchProductCompare").removeClass('open');
                $("#inputSearchCompare").val("");
                renderTowCompare();
                return swal('Success',"The product has been added to the comparison list",'success');
            }else{
                return swal('Warning',result,'warning');
            }
        }
    });
}

function deleteProductCompare(id){
    let urlCompareDelete = url +'/product/compareDelete/'+id ;
    $.ajax({
        url : urlCompareDelete,
        type : "get",
        cache: false,
        dataType:"text",
        data : {
        },
        success : function (result){
            renderTowCompare();
        }
    });
}
renderTowCompare();