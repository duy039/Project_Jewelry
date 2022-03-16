var url = $("#urlWeb").val();
// user_id có thể = null nếu chưa đăng nhập
var user_id = ($("#user_id").val() != 'null')?$("#user_id").val():null;
// sản phẩm đang xem
var pro_id = $("#pro_id").val();
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
function commentsResponse() {
    // local var
    var theResponse = null;
    // jQuery ajax
    $.ajax({
        url: url +'/product/commentsAjax/' + pro_id,
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
function raitingResponse() {
    // local var
    var theResponse = null;
    // jQuery ajax
    $.ajax({
        url: url +'/product/raitingAjax/' + pro_id,
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

function countLikeRating(ratings_id) {
    // local var
    var theResponse = null;
    // jQuery ajax
    $.ajax({
        url: url +'/product/like/getLikeRating/'+ratings_id+'/'+user_id,
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
let wishlists = (user_id != null)?wishlistsResponse():null;
let comments = commentsResponse();
let raitings = raitingResponse();

function rendercomment(){
    comments = commentsResponse();
    let htmlComments = "";
    let htmlAvatarComment = "";
    for(let i=0; i<comments.length; i++){
        if(comments[i].user_Avatar == "null"){
                htmlAvatarComment = '<img src="'+url+'/assets/images/user/avatarDefault.jpg" alt="avatar">'
        }else{
            htmlAvatarComment = '<img src="'+url+'/assets/images/user/'+comments[i].user_Avatar+'" alt="avatar">'
        }
       htmlComments +=  '<div>'
                    +        '<table>'
                    +            '<tr>'
                    +                '<td class="avatarComment">'
                    + htmlAvatarComment
                    +                '</td>'
                    +                '<td class="contentComment" rowspan="2">'
                    +                    '<table class="table table-striped table-bordered">'
                    +                        '<tbody>'
                    +                            '<tr>'
                    +                                '<td style="width: 35%; font-size: 17px"><strong>'+comments[i].user_Name+'</strong></td>'
                    +                                '<td class="text-right">'+comments[i].Date+'</td>'
                    +                            '</tr>'
                    +                            '<tr>'
                    +                                '<td colspan="2">'
                    +                                    '<p>'+comments[i].Content+'</p>'
                    +                                '</td>'
                    +                            '</tr>'
                    +                        '</tbody>'
                    +                    '</table>'
                    +                '</td>'
                    +            '</tr>'
                    +            '<tr>'
                    +                '<td><p> </p></td>'
                    +            '</tr>'
                    +        '</table>'
                    +    '</div>'
    }
    $("#viewComment").html(htmlComments);
    $("#lengthComment").html(comments.length);
}
function renderRaiting(){
    raitings = raitingResponse();
    let htmlRaitings = "";

    for(let i=0; i<raitings.length; i++){
        let likeRating = countLikeRating(raitings[i].Raiting_id);
        let htmlAvatarRaiting = "";
        let htmlCountRaiting = "";
        let iconLiked='';
        if(likeRating.liked == true){
            iconLiked = '<i class="fas fa-thumbs-up yesLiked"></i>';
        }else{
            iconLiked = '<i class="far fa-thumbs-up"></i>';
        }
        if(raitings[i].user_Avatar == "null"){
            htmlAvatarRaiting = '<img src="'+url+'/assets/images/user/avatarDefault.jpg" alt="avatar">'
        }else{
            htmlAvatarRaiting = '<img src="'+url+'/assets/images/user/'+raitings[i].user_Avatar+'" alt="avatar">'
        }
        // đếm số sao
        for(let r=0; r<raitings[i].Rating; r++){
            htmlCountRaiting += '<span> </span><li><i class="fa fa-star-of-david"></i></li>'
        }
        for(let r=0; r < (5 - raitings[i].Rating); r++){
            htmlCountRaiting += '<span> </span><li class="silver-color"><i class="fa fa-star-of-david"></i></li>'
        }

       htmlRaitings +=  '<div>'
                    +        '<table>'
                    +            '<tr>'
                    +                '<td class="avatarComment">'
                    + htmlAvatarRaiting
                    +                '</td>'
                    +                '<td class="contentComment" rowspan="2">'
                    +                    '<table class="table table-striped table-bordered">'
                    +                        '<tbody>'
                    +                            '<tr>'
                    +                                '<td style="width: 35%; font-size: 17px"><strong>'+raitings[i].user_Name+'</strong></td>'
                    +                                '<td class="text-right">'+raitings[i].Date+'</td>'
                    +                            '</tr>'
                    +                            '<tr>'
                    +                                '<td colspan="2">'
                    +                                   '<p>'+raitings[i].Content+'</p>'
                    +                                    '<div class="rating-box">'
                    +                                       '<ul>'
                    +                      htmlCountRaiting
                    +                                       '</ul>'
                    +                                    '</div>'
                    +                                    '<a href="javascript:void(0)"  onclick="addLikeRaiting(\'' +raitings[i].Raiting_id+ '\')" class="iconLike">'+iconLiked+'</a>  <span> '+likeRating.count+'</span>'
                    +                                '</td>'
                    +                            '</tr>'
                    +                        '</tbody>'
                    +                    '</table>'
                    +                '</td>'
                    +            '</tr>'
                    +            '<tr>'
                    +                '<td><p> </p></td>'
                    +            '</tr>'
                    +        '</table>'
                    +    '</div>'
    }
    $("#viewRaiting").html(htmlRaitings);
    $("#lengthRaiting").html(raitings.length);
}
function renderIconWishlist(){
    wishlists = (user_id != null)?wishlistsResponse():null;
    let htmlWishkist = "";
    let test = true;
    if(wishlists != null){
        for(let i=0; i<wishlists.length; i++){
            if(wishlists[i].Product_id == pro_id){
                htmlWishkist = '<a class="qty-wishlist_btn" href="javascript:void(0)" onclick="wishlistDelete(\'' +wishlists[i].WishList_id+ '\')" data-toggle="tooltip" title="Add To Wishlist" style="color: rgb(255, 51, 0)"><i class="fas fa-heart"></i></a>'
                test = false;
            }
        }
    }
    if(test){
        htmlWishkist = '<a class="qty-wishlist_btn" href="javascript:void(0)" onclick="wishlistHandler(\'' +pro_id + '\')" data-toggle="tooltip" title="Add To Wishlist"><i class="ion-android-favorite-outline"></i></a>'
    }
    $("#iconWishlist").html(htmlWishkist);
}
// xử lý khi user Thêm 1 comment
function addComment(){
    let  content = $("#con_message").val();
    if(content.trim() == ""){
        return swal('Success',"You have not entered the comment content!!",'success');
    }
    if(user_id == null){
        // return confirm("You must be logged in to comment on this product!");
        return swal({
            title: "Warning",
            text: "You must be logged in to comment on this product!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((value) => {
            if (value) {
              window.location='/login';
            }
          });
    }else{
        let urlAddComment = url +'/addComment' ;
        $.ajax({
            url : urlAddComment,
            type : "post",
            cache: false,
            dataType:"text",
            data : {
                _token: $("#csrf_token").val(),
                'user_id' : user_id,
                'product_id' : pro_id,
                'content' : content
            },
            success : function (result){
                rendercomment();
                $("#con_message").val("");
            }
        });
    }
}
// xử lý khi user Thêm 1 Raiting
function addRaiting(){
    let  content = $("#contenRaiting").val();
    let  raiting = $("#start_Raiting").val();
    if(content == ""){
        content = "-@.@.@-"
    }
    if(user_id == null){
        return swal({
            title: "Warning",
            text: "You must be logged in to rating on this product!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((value) => {
            if (value) {
              window.location='/login';
            }
          });
    }else{
        let urlAddRaiting = url +'/addRaiting' ;
        $.ajax({
            url : urlAddRaiting,
            type : "post",
            cache: false,
            dataType:"text",
            data : {
                _token: $("#csrf_token").val(),
                'user_id' : user_id,
                'product_id' : pro_id,
                'content' : content,
                'raiting' : raiting
            },
            success : function (result){
                if(result == false){
                    return swal('Warning',"You have already rated this product!",'warning');
                }
                raitings = raitingResponse();
                renderRaiting();
                $("#contenRaiting").val("");
            }
        });
    }
}
// xử lý khi user Thêm 1 Raiting
function addLikeRaiting(ratingID){
    if(user_id == null){
        return swal({
            title: "Warning",
            text: "You must be logged in to like rating on this product!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((value) => {
            if (value) {
              window.location='/login';
            }
          });
    }else{
        let urlAddRaiting = url +'/addLikeRaiting' ;
        $.ajax({
            url : urlAddRaiting,
            type : "post",
            cache: false,
            dataType:"text",
            data : {
                _token: $("#csrf_token").val(),
                'user_id' : user_id,
                'ratingID' : ratingID,
            },
            success : function (result){
                renderRaiting();
            }
        });
    }
}
// xử lý khi user chọn Thêm sản phẩm vào danh sách yêu thích
function wishlistHandler(prod_id){
    if(user_id == null){
        return swal({
            title: "Warning",
            text: "You must be logged in to add products to your wish list!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((value) => {
            if (value) {
              window.location='/login';
            }
          });
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
                renderIconWishlist();
            }
        });

    }

}
// xử lý khi user chọn Xóa sản phẩm ra khỏi danh sách yêu thích
function wishlistDelete(wishlist_id){
    if(user_id == null){
        return swal({
            title: "Warning",
            text: "You must be logged in to delete products to your wishlist!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((value) => {
            if (value) {
              window.location='/login';
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
                renderIconWishlist();
            }
        });

    }

}
function chartRating(){
    // dùng array đi nha tôi
    let total = 0;
    let ratingx     = [0,0,0,0,0];
    let percentx    = [0,0,0,0,0];
    let widthx      = [0,0,0,0,0];
    for(let i=0; i<raitings.length; i++){
        switch(raitings[i].Rating){
            case 1:{
                    ratingx[0]++;
                    break;
                }
             case 2:{
                    ratingx[1]++;
                    break;
                }
             case 3:{
                    ratingx[2]++;
                    break;
                }
             case 4:{
                    ratingx[3]++;
                    break;
                }
             case 5:{
                    ratingx[4]++;
                    break;
                }
            default:{
                break;
            }
        }
    }
    if(raitings.length > 0){
        total = ratingx[0] + ratingx[1] + ratingx[2] + ratingx[3] + ratingx[4];
        for(let u=0; u<5; u++){
            percentx[u]= (ratingx[u]/total) * 100;
            if(percentx[u] == 0){
                percentx[u] = 0;
            }else{
                percentx[u] = percentx[u].toFixed(1)
            }
        }
    }
    for(let u=0; u<5; u++){
        if(percentx[u] == 0){
            widthx[u] = 30;
        }else{
            widthx[u] = (percentx[u] * 5)+30;
        }
    }
    for(let u=0; u<5;u++){
        let r= u + 1;
        $("#ca"+r).css({
            "text-align" : "center",
            "padding-top" : "3px",
            "background-color" : "rgb(31, 233, 31)",
            "width" : widthx[u] +"px",
            "height" : "30px"
            });
    }
    for(let u=0; u<5;u++){
        let r= u + 1;
        document.getElementById('ca'+r).innerHTML = percentx[u]+"%";
    }
    for(let u=0; u<5;u++){
        let r= u + 1;
        $("#numberRating"+r).html(" ( "+ratingx[u] +" Reviews )");
    }
}

function renderIconWishlistList(productIDWishlist){
    wishlists = (user_id != null)?wishlistsResponse():null;
    let htmlWishkist = "";
    let test = true;
    if(wishlists != null){
        for(let i=0; i<wishlists.length; i++){
            if(wishlists[i].Product_id == productIDWishlist){
                htmlWishkist = '<a class="hiraola-add_compare" href="javascript:void(0)" onclick="wishlistDeleteList(\'' +productIDWishlist+ '\',\'' +wishlists[i].WishList_id+ '\')" data-toggle="tooltip" data-placement="top" title="Remove from favorites" style="color: rgb(255, 51, 0)"><i class="fas fa-heart"></i></a>'
                test = false;
            }
        }
    }
    if(test){
        htmlWishkist = '<a class="hiraola-add_compare" href="javascript:void(0)" onclick="wishlistHandlerList(\'' +productIDWishlist+ '\')" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="far fa-heart"></i></a>';
    }
    if($("#w"+productIDWishlist) != null){
        $("#w"+productIDWishlist).html(htmlWishkist);
    }
    if($("#rw"+productIDWishlist) != null){
        $("#rw"+productIDWishlist).html(htmlWishkist);
    }
}
// xử lý khi user chọn Thêm sản phẩm vào danh sách yêu thích của 2 list bên dưới
function wishlistHandlerList(prod_id){
    if(user_id == null){
        return swal({
            title: "Warning",
            text: "You must be logged in to add products to your wishlist!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((value) => {
            if (value) {
              window.location='/login';
            }
          });
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
                renderIconWishlistList(prod_id);
            }
        });

    }

}
// xử lý khi user chọn Xóa sản phẩm ra khỏi danh sách yêu thích của 2 list bên dưới
function wishlistDeleteList(prod_id, wishlist_id){
    if(user_id == null){
        return swal({
            title: "Warning",
            text: "You must be logged in to add products to your wishlist!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              window.location='/login';
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
                renderIconWishlistList(prod_id);
            }
        });

    }

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
                let addtoCartQuickView = '<a href="javascript:void(0)" onclick="addToCartQuickView(\''+product.Product_id+'\')" class="add-to_cart">Add To Cart</a>';
                if(product.Size.length > 0){
                    let sizeQuickView = '<span>Size</span> <select id="getSizeQuickView" class="myniceselect nice-select">';
                    for(let o=0; o<product.Size.length; o++){
                        sizeQuickView += '<option value="'+product.Size[o]+'">'+product.Size[o]+'</option>'
                    }
                    sizeQuickView += '</select>';
                    $('#sizeQuickView').html(sizeQuickView);
                }
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
// xử lý thêm 1 product vào giỏ hàng
function addToCart(productAdd){
    let urlAddToCart = url +'/addToCart';
    let size = "null";
    if($("#getSize").val()!= undefined){
        size = $("#getSize").val();
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
            'quantity' : $("#quantityProduct").val()
        },
        success : function (result){
            if(result == true){
                renderMiniCart();
                return swal('Success',"The product has been added to the cart",'success');
            }
        }
    });
}

// xử lý thêm 1 product quickView vào giỏ hàng
function addToCartQuickView(productAdd){
    // controler xử lý chức năng
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
                return swal('Success',"The product has been added to the cart",'success');
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
                        return swal('Success',"The product has been added to the cart",'success');
                    }
                }
            });
        }
    })
}


// các  function dùng cho compare
//  show ra bảng các product đang có trong session compare
function showCompare(){
    $("#divShowCompare").css({
        "display" : "block"
    });
    $("#ss-now").css({
        "display" : "none"
    });
}
//  ngược lại với showCompare()
function shortenCompare(){
    $("#divShowCompare").css({
        "display" : "none"
    });
    $("#ss-now").css({
        "display" : "block"
    });
}
function renderListCompare(){
    var htmlProduct = " ";
    var urlGetCompare = url +'/product/compare/getProduct' ;
    $.ajax({
            url : urlGetCompare,
            type : "get",
            dataType:"text",
            data : {

            },
            success : function (result){
                productsCo = JSON.parse(result);
                var htmlLi ="";
                for(let productC of productsCo){
                    htmlLi += '<li class="inProductCompare">'
                    +            '<a href="javascript:void(0)" onclick="deleteProductCompare(\'' +productC.Product_id+ '\')" class="iconDeleteCompareProduct"><i class="ion-android-close"></i></a>'
                    +            '<a href="'+url+'/product/'+ productC.Product_id + '" class="cp-plus cp-plus_new">'
                    +                '<img src="'+url+'/assets/images/product/' + productC.Avatar   + '" alt="product" width="120px">'
                    +                '<p>'+ productC.Name + '</p>'
                    +            '</a>'
                    +        '</li>';
                }
                for(let i =0; i < (2-productsCo.length); i++){
                    htmlLi += '<li class="formsg">'
                            +            '<a href="#searchProductCompare" class="cp-plus cp-plus_new" onclick="OpenDialSearch()">'
                            +                '<i class="bi bi-plus-square-dotted"></i>'
                            +                '<p>Add Product</p>'
                            +            '</a>'
                            +        '</li>'
                }

                htmlProduct =   '<ul class="listcompare" >'
                            +        htmlLi
                            +        '<li class="actionCompare">'
                            +            '<a class="clearall" href="javascript:;" onclick="shortenCompare();" >'
                            +                '<i class="bi-chevron-down"></i> Shorten'
                            +            '</a>'
                            +            '<div class="buttonActionCompare">'
                            +                '<p><button type="button" class="btn btn-primary"><a style="text-decoration: none; color: #fff" href="'+url+'/compare">Compare Now</a></button></p>'
                            +                '<button type="button" onclick="deleteAllProductCompare()" class="btn btn-danger">Delete All Products</button>'
                            +            '</div>'
                            +       '</li>'
                            +    '</ul>';
                $("#divShowCompare").html(htmlProduct);
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
                renderListCompare();
                showCompare();
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
            renderListCompare();
        }
    });
}

function deleteAllProductCompare(){
    let urlCompareDelete = url +'/product/compare/deleteAll' ;
    $.ajax({
        url : urlCompareDelete,
        type : "get",
        cache: false,
        dataType:"text",
        data : {
        },
        success : function (result){
            renderListCompare();
        }
    });
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

renderListCompare();
rendercomment();
renderIconWishlist();
renderRaiting();
chartRating();
