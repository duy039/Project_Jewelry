// các biến
// user:        lưu user_id đã login
// url :        url của web
// idProduct:   id của các sản phẩm có trong shop
// products:    Array chứa các product trong shop
// onePage:     số lượng sản phẩm có trong 1 trang
// currentPage: Trang hiện tại
// start:       điểm bắt đầu tính sẩn phẩm trong biến products
// end:         điểm kết thúc tính sẩn phẩm trong biến products
// wishlists:   Lưu bảng wishlist dc chuyển thành Array Object


var user_id = ($("#user_id").val() != 'null')?$("#user_id").val():null;
var url = $("#urlWeb").val();
var idProduct  = $("#idAllProductInShop").val();
function getListProduct() {
    // local var
    var theResponse = null;
    // jQuery ajax
    $.ajax({
        url: url +'/shop/listproduct/' + idProduct,
        type: 'get',
        data: {

        },
        dataType: "text",
        async: false,
        success: function(respText) {
            theResponse = JSON.parse(respText);
        }
    });
    return theResponse;
}
function wishlistsResponse() {
    // local var
    var theResponse = null;
    // jQuery ajax
    $.ajax({
        url: url +'/shop/wishlists/' + user_id,
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
let products = getListProduct();
let wishlists = (user_id == null)?null:wishlistsResponse();
let onePage = 9;
let currentPage = 1;
let start = 0;
let end = onePage;

console.log(user_id)
//   tính tổng số trang con
    function totalPage(){
        if(products != null){
            if(products.length % onePage == 0){
                return  products.length / onePage;
            }else{
                return Math.floor((products.length / onePage)) + 1;
            }
        }else{
            return 0;
        }
    }
//  render lại danh sách sản phẩm
    function renderProducts(){
        htmlProduct = " ";
        var product = products;
        if(product != null){
            for(y=0; y < product.length; y++){
                if(y >= start && y < end){
                    var str1 = '<div class="col-lg-4"> '
                        +   '<div class="slide-item">'
                        +       '<div class="single_product">'
                        +           '<div class="product-img">'
                        +               '<a href="'+url+'/product/'+ product[y].Product_id + '">'
                        +                   '<img class="primary-img"   src="'+url+'/assets/images/product/' + product[y].Avatar   + '" alt="Product Image">'
                        +                   '<img class="secondary-img" src="'+url+'/assets/images/product/' + product[y].Image[2] + '" alt="Product Image">'
                        +               '</a>'
                        +               '<span class="sticker">New</span>';
                    var str2 = "";
                            if(product[y].Sale_Type != null && product[y].Sale_Type != "normal"){
                                str2 = '<span class="sticker-2">Sale</span>';
                            }
                    var str31 = " ";
                    var str3 =              '<div class="add-actions">'
                            +                   '<ul>'
                            +                       '<li>'
                            +                           '<a class="hiraola-add_cart" onclick="addToCartProduct(\'' +product[y].Product_id+ '\')" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a>'
                            +                       '</li>'
                            +                       '<li>'
                            +                           '<a class="hiraola-add_compare" href="compare" data-toggle="tooltip" data-placement="top" title="Compare This Product">'
                            +                              ' <i class="ion-ios-shuffle-strong"></i>'
                            +                           '</a>'
                            +                       '</li>'
                            +                       '<li onclick="quickView(\'' +product[y].Product_id+ '\')" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter">'
                            +                           '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View">'
                            +                               '<i class="ion-eye"></i>'
                            +                           '</a>'
                            +                       '</li>'
                            +                   '</ul>'
                            +               '</div>'
                            +           '</div>'
                            +          '<div class="hiraola-product_content">'
                            +              '<div class="product-desc_info">'
                            +                   '<h6>'
                            +                       '<a class="product-name" href="'+ url+'/product/'+ product[y].Product_id +'">'+ product[y].Name +'</a>'
                            +                   '</h6>'
                            +                   '<div class="price-box">'
                            if (product[y].CurrentPrice != product[y].Price_Root ){
                                str31 += '<span style="color: red" class="new-price"> $' + product[y].CurrentPrice + '</span>'
                                      +  '<span class="old-price">$'+product[y].Price_Root+'</span>'
                            }else{
                                str31 += '<span class="new-price"> $' + product[y].CurrentPrice + '</span>'
                            }
                    str31+=                   '</div>'
                            +                   '<div class="additional-add_action">'
                            +                       '<ul>'
                            +                           '<li>'
                    var str32=""
                    if(wishlists == null){
                        str32='<a class="hiraola-add_compare" href="javascript:void(0)" onclick="wishlistHandler(\'' +product[y].Product_id+ '\')" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="far fa-heart"></i></a>';
                    }else if(wishlists.length == 0){
                        str32='<a class="hiraola-add_compare" href="javascript:void(0)" onclick="wishlistHandler(\'' +product[y].Product_id+ '\')" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="far fa-heart"></i></a>';
                    }else{
                        for(var i=0; i<wishlists.length; i++){
                            if(product[y].Product_id == wishlists[i].Product_id){
                                str32='<a class="hiraola-add_compare" href="javascript:void(0)" onclick="wishlistDelete(\'' +wishlists[i].WishList_id+ '\')" data-toggle="tooltip" data-placement="top" title="Remove from favorites" style="color: rgb(255, 51, 0)"><i class="fas fa-heart"></i></a>';
                                break;
                            }else{
                                str32='<a class="hiraola-add_compare" href="javascript:void(0)" onclick="wishlistHandler(\'' +product[y].Product_id+ '\')" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="far fa-heart"></i></a>';
                            };
                        }
                    }
                    var str33=                            '</li>'
                            +                       '</ul>'
                            +                   '</div>'
                            +                   '<div class="rating-box">'
                            +                       '<ul>';
                            var str4x=" ";
                            var str4 = " ";

                                for(i=0; i < product[y].Rating.toFixed(); i++){
                                    str4x+= '<span> </span><li> <i class="fa fa-star-of-david"></i></li>';
                                }
                                for(i=0; i < (5 - product[y].Rating.toFixed()); i++){
                                    str4x+= '<span> </span><li class="silver-color"><i class="fa fa-star-of-david"></i></li>';
                                }
                            str4 = str4x;
                            var str5=                  '</ul>'
                            +                    '</div>'
                            +                '</div>'
                            +            '</div>'
                            +        '</div>'
                            +    '</div>'
                            +    '<div class="list-slide_item">'
                            +        '<div class="single_product">'
                            +            '<div class="product-img">'
                            +               '<a href="'+ url+'/product/'+ product[y].Product_id +'">'
                            +                   '<img class="primary-img"   src="'+ url+'/assets/images/product/' + product[y].Avatar   + '" alt="Product Image">'
                            +                   '<img class="secondary-img" src="'+ url+'/assets/images/product/' + product[y].Image[1] + '" alt="Product Image">'
                            +               '</a>'
                            +            '</div>'
                            +            '<div class="hiraola-product_content">'
                            +                '<div class="product-desc_info">'
                            +                   '<h6>'
                            +                       '<a class="product-name" href="'+ url+'/product/' + product[y].Product_id +'">'+ product[y].Name +'</a>'
                            +                    '</h6>'
                            +                    '<div class="rating-box">'
                            +                        '<ul>';
                        var str6 = str4;
                        var str7 =                  '</ul>'
                            +                   '</div>'
                            +                   '<div class="price-box">'
                            +                       '<span class="new-price"> $' + product[y].CurrentPrice + '</span>'
                            +                   '</div>'
                            +                   '<div class="product-short_desc">'
                            +                       '<p>'+ product[y].Description +'</p>'
                            +                   '</div>'
                            +               '</div>'
                            +               '<div class="add-actions">'
                            +                   '<ul>'
                            +                       '<li><a class="hiraola-add_cart"  onclick="addToCartProduct(\'' +product[y].Product_id+ '\')" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Add To Cart">Add To Cart</a></li>'
                            +                       '<li><a class="hiraola-add_compare" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Compare This Product"><i class="ion-ios-shuffle-strong"></i></a></li>'
                            +                       '<li onclick="quickView(\'' +product[y].Product_id+ '\')" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="ion-eye"></i></a></li>'
                            +                       '<li>'
                    var str71=                       '</li>'
                            +                   '</ul>'
                            +               '</div>'
                            +           '</div>'
                            +       '</div>'
                            +   '</div>'
                            +'</div>';
                    htmlProduct += str1 + str2 + str3 + str31 + str32 + str33 + str4 + str5 + str6 + str7 + str32 + str71;
                }
            }
        }
        $('#showProducts').html(htmlProduct);
    }
// set up hàng phân trang
    function listNumberPage(){
        function StringPage(idPage){
            return '<li><a id="page'+idPage+'"href="javascript:void(0)" onclick="changePage('+idPage+')">'+idPage+'</a></li>';
        }
        var numberPage = '<li><a class="Next" href="javascript:void(0)" onclick="backPage()"><i class="ion-ios-arrow-left"></i></a></li>';
        let p1 = currentPage - 1;
        let p2 = currentPage - 2;
        let p3 = currentPage + 1;
        let p4 = currentPage + 2;
        switch (totalPage()) {
            case 0:
                    break;
            case 1:
                    numberPage += StringPage(1);
                    break;
            case 2:{
                    numberPage += StringPage(1) + StringPage(2);
                    break;
                }
            case 3:{
                    numberPage += StringPage(1) + StringPage(2) + StringPage(3);
                    break;
                }
            case 4:{
                    numberPage += StringPage(1) + StringPage(2) + StringPage(3) + StringPage(4);
                    break;
            }
            case 5:{
                numberPage += StringPage(1) + StringPage(2) + StringPage(3) + StringPage(4) + StringPage(5);
                break;
            }
            case 6:{
                numberPage += StringPage(1) + StringPage(2) + StringPage(3) + StringPage(4) + StringPage(5) + StringPage(6);
                break;
            }
            default:{
                if(currentPage <= 3){
                    numberPage += StringPage(1) + StringPage(2) + StringPage(3) + StringPage(4) + StringPage(5);
                    numberPage += '<li><a >. . . .</a></li>';
                    numberPage += StringPage(totalPage())
                }else if(currentPage == totalPage() || currentPage == (totalPage() - 1) || currentPage == (totalPage() - 2) || currentPage == (totalPage() - 3)){
                    numberPage += StringPage(totalPage() - 4) + StringPage(totalPage() - 3) + StringPage(totalPage() - 2) + StringPage(totalPage() - 1) + StringPage(totalPage());
                }else{
                    numberPage += StringPage(p2) + StringPage(p1) +StringPage(currentPage) + StringPage(p3) +StringPage(p4) ;
                    numberPage += '<li><a >. . . .</a></li>';
                    numberPage += StringPage(totalPage())
                }
                break;
            }

        }
        numberPage +=    '<li>'
                +            '<a class="Next" href="javascript:void(0)" onclick="nextPage()">'
                +               '<i class="ion-ios-arrow-right"></i>'
                +            '</a>'
                +        '</li>';

        $('#numberPage').html(numberPage);
        let textShowing = "";
        if(end > products.length){
            textShowing = "<p>Showing "+(start+1)+" to "+(products.length)+" of "+(products.length)+" Products ( <span style='color: red'>Pages "+currentPage+" </span>)</p>";
        }else{
            textShowing = "<p>Showing "+(start+1)+" to "+(end+1)+" of "+(products.length)+" Products ( <span style='color: red'>Pages "+currentPage+" </span>)</p>";
        }
        $('#showingPage').html(textShowing);
        // làm thêm hiệu ứng
        for(var i = 1; i < totalPage()+1; i++){
            var idPage = "#page" + i ;
            if(i == currentPage){
                $(idPage).css({
                    "background-color" : "#cda557",
                    "color"            : "#ffffff"
                    });
            }else{
                $(idPage).css({
                    "background-color" : "#ffffff",
                    "color"            : "black"
                    });
                $(idPage).hover(
                    function(){
                        $(this).css({
                            "background-color" : "#cda557",
                            "color"            : "#ffffff"
                        })},
                    function(){
                        $(this).css({
                            "background-color" : "#ffffff",
                            "color"            : "black"
                        });
                    });
            }

        }
    }
//  sự kiện khi ta click vào nút số trang cần đến
    function changePage(choose){
        currentPage = choose;
        start = (currentPage - 1) * onePage;
        end   = currentPage * onePage
        listNumberPage();
        renderProducts();
    }
//  sự kiện khi ta click vào nút > của hàng phần trang
    function nextPage(){
        if(currentPage >= totalPage()){
            return alert("you are on the last page");
        }
        currentPage++;
        start = (currentPage - 1) * onePage;
        end   = currentPage * onePage
        renderProducts();
        listNumberPage();
    }
//  sự kiện khi ta click vào nút < của hàng phần trang
    function backPage(){
        if(currentPage == 1){
            return alert("you are on the first page");
        }
        currentPage--;
        start = (currentPage - 1) * onePage;
        end   = currentPage * onePage
        renderProducts();
        listNumberPage();
    }

// xử lý khi user chọn phương  thức sắp xếp
    function shorting(){
        var urlshort = url +'/shop/short/' + $("#short").val() + "/" + idProduct ;
        $.ajax({
                url : urlshort,
                type : "get",
                dataType:"text",
                data : {

                },
                success : function (result){
                    products = JSON.parse(result);
                    currentPage = 1
                    renderProducts();
                    listNumberPage();
                }
        });

    }
// xử lý khi user chọn mức giá
    function priceFromTo(){
        idProduct  = $("#idAllProductInShop").val();
        var urlprice = url +"/shop/pricefromto/" + $("#priceFrom").val() + "/" + $("#priceTo").val() + "/" + idProduct ;
        $.ajax({
                url : urlprice,
                type : "get",
                dataType:"text",
                data : {

                },
                success : function (result){
                    // vị trí cần sửa
                    console.log(idProduct);
                    products = JSON.parse(result);
                    idProduct = "";
                    for(y=0; y < products.length; y++){
                        if(y == (products.length - 1)){
                            idProduct += products[y].Product_id;
                        }else{
                            idProduct += products[y].Product_id + ",";
                        }
                    }
                    currentPage = 1
                    renderProducts();
                    listNumberPage();
                }
        });

    }
// xử lý quickView
    function quickView(id_ProductQuickView){
        var urlajax = url +'/shop/quickView/' + id_ProductQuickView;
        $.ajax({
                url : urlajax,
                type : "get",
                dataType:"text",
                data : {

                },
                success : function (result){
                   var product = JSON.parse(result);
                    var imgQuickView1 =      '<img src="'+url + '/assets/images/product/' +product.Image[0]+ '" alt="Product Image">'
                    var imgQuickView2 =      '<img src="'+url + '/assets/images/product/' +product.Image[1]+ '" alt="Product Image">'
                    var imgQuickView3 =      '<img src="'+url + '/assets/images/product/' +product.Image[2]+ '" alt="Product Image">'
                    var imgQuickView4 =      '<img src="'+url + '/assets/images/product/' +product.Image[3]+ '" alt="Product Image">'

                    var nameQuickView = '<a href="'+ url+'/product/' + product.Product_id + '"> '+ product.Name +'</a>'
                        var str=" ";
                    var ratingQuickView = " ";
                        for(i=0; i < product.Rating.toFixed(); i++){
                            str+= '<span> </span><li><i class="fa fa-star-of-david"></i></li>';
                        }
                        for(i=0; i < (5 - product.Rating.toFixed()); i++){
                            str+= '<span> </span><li class="silver-color"><i class="fa fa-star-of-david"></i></li>';
                        }
                        ratingQuickView = str;
                    var priceQuickView = '<span class="new-price">$'+product.CurrentPrice+'</span>';
                        if(product.Sale_Type == 'percent' && product.Sale_Type == 'direct'){
                            priceQuickView +='<span class="old-price">$'+product.Price_Root+'</span>';
                        }
                    var codeAndQuantity =' <li>Product Code: '+product.Product_id+'</li> <li>Current item quantity: '+product.Quantity+'</li> <li>Number Of Products Sold: '+product.Sold_Product_Quantity+'</li>'
                    var tagQuickViews = " ";
                        for(u=0; u < product.tag_name.length; u++){
                            if( u < (product.tag_name.length - 1) ){
                                tagQuickViews += '<a href="'+ url + '/shop/categories/'+ product.tag_id[u] + '"> '+ product.tag_name[u] +'</a><span>, </span>';
                            }else{
                                tagQuickViews += '<a href="'+ url + '/shop/categories/'+ product.tag_id[u] + '"> '+ product.tag_name[u] +'</a>';
                            }
                        }
                    if(product.Size.length > 0){
                        let sizeQuickView = '<span>Size</span> <select id="getSizeQuickView" class="myniceselect nice-select">';
                        for(let o=0; o<product.Size.length; o++){
                            sizeQuickView += '<option value="'+product.Size[o]+'">'+product.Size[o]+'</option>'
                        }
                        sizeQuickView += '</select>';
                        $('#sizeQuickView').html(sizeQuickView);
                    }
                    let addtoCartQuickView = '<a href="javascript:void(0)" onclick="addToCartQuickView(\''+product.Product_id+'\')" class="add-to_cart">Add To Cart</a>';
                    $('#imgBigQuickView1').html(imgQuickView1);
                    $('#imgBigQuickView2').html(imgQuickView2);
                    $('#imgBigQuickView3').html(imgQuickView3);
                    $('#imgBigQuickView4').html(imgQuickView4);
                    $('#imgSmallQuickView1').html(imgQuickView1);
                    $('#imgSmallQuickView2').html(imgQuickView2);
                    $('#imgSmallQuickView3').html(imgQuickView3);
                    $('#imgSmallQuickView4').html(imgQuickView4);
                    $('#nameQuickView').html(nameQuickView);
                    $('#ratingQuickView').html(ratingQuickView);
                    $('#priceQuickView').html(priceQuickView);
                    $('#codeAndQuantity').html(codeAndQuantity);
                    $('#tagQuickView').html(tagQuickViews);
                    $('#addtoCartQuickView').html(addtoCartQuickView);


                }
        })



    }
// xử lý khi user chọn Thêm sản phẩm vào danh sách yêu thích
    function wishlistHandler(prod_id){
        if(user_id == null){
            return confirm("You must be logged in to add products to your wish list");
        }else{
            var urlAddWishlist = url +'/wishlistHandler' ;
            $.ajax({
                url : urlAddWishlist,
                type : "post",
                cache: false,
                dataType:"text",
                data : {
                    _token: $("#csrf_token").val(),
                    'user_id' : user_id,
                    'product_id' : prod_id
                },
                success : function (result){
                    if(result){
                        swal('Success',"The product has been added to favorites",'success');
                    }else{
                        swal('Success',"The product has been removed from favorites",'success');
                    };
                    wishlists = wishlistsResponse();
                    renderProducts();
                    listNumberPage();
                }
            });
        }
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
                        swal('Success',"The product has been removed from favorites",'success');
                        wishlists = wishlistsResponse();
                        renderProducts();
                        listNumberPage();
                    };
                }
            });
        }
    }

    // xử lý thêm 1 product quickView vào giỏ hàng
function addToCartQuickView(productAdd){
    let urlAddToCart = url +'/addToCart';
    let size = "null";
    if($("#getSizeQuickView").val()!= undefined){
        size = $("#getSizeQuickView").val();
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
            'quantity' : $("#quantityQuickView").val()
        },
        success : function (result){
            if(result == true){
                renderMiniCart()
                return alert("The product has been added to the cart");
            }
        }
    });
}
// tối về làm tiếp thêm sản phẩm cho list product
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
    renderProducts();
    listNumberPage();

