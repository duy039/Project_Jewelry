window.onload = function () {
    document.getElementById("download").addEventListener("click", function () {
        var invoice = document.getElementById("invoice");
        window.print();
    });
}

function quickView(orderViewId) {
    var urlajax = url + '/my-account/view/' + orderViewId;
    $.ajax({
        url: urlajax,
        type: "get",
        dataType: "text",
        data: {
        },
        success: function (result) {
            var order = JSON.parse(result);
            var str1 = '<div class="container-fluid" >'
                + '<div class="card">'
                + '<div class="card-header"> Invoice: '
                + '<strong>' + order.Create_Date + '</strong>'
            if (order.Status == 'Success') {
                str1 += '<span class="text-success float-right">' + order.Status + '</span><strong class="float-right" >Status: </strong>'
            } else {
                str1 += '<span class="text-danger float-right">' + order.Status + '</span><strong class="float-right">Status: </strong>'
            }
            str1 += '</div>'
                + '<div class="card-body">'
                    + '<div class="row mb-4">'
                        + '<div class="col-sm-6">'
                            + '<div><strong class="mb-3">Recive Address: </strong> <span>' + order.Address + '</span></div>'
                            + '<div><strong class="mb-3">Email: </strong> <span>' + order.Email + '</span></div>'
                            + '<div><strong class="mb-3">Payment Method: </strong> <span>' + order.Method + '</span></div>'
                            + '<div><strong class="mb-3">Shipping Fee: </strong> <span>' + order.Shipping_Fee + '%' + '</span></div>'
                        + '</div>'
                        + '<div class="col-sm-6">'
                            + '<div><strong class="mb-3">Name: </strong> <span>' + order.Name + '</span></div>'
                            + '<div><strong class="mb-3">Phone: </strong> <span>' + '0' + order.Phone_Number + '</span></div>'
                            + '<div><strong class="mb-3">Point Used: </strong> <span>' + order.Point_Used + '</span></div>'
                            + '<div><strong class="mb-3">Discount: </strong> <span>' + order.Discount + '%' + '</span></div>'
                        + '</div>'
                    + '</div>'
                    + '<div class="table-responsive-sm">'
                        + '<table class="table table-striped">'
                            + '<thead>'
                                + '<tr>'
                                    + '<th class="center">#</th>'
                                    + '<th>Product</th>'
                                    + '<th class="right">Size</th>'
                                    + '<th class="right">Price</th>'
                                + '</tr>'
                            + '</thead>'
                            + '<tbody>'
                var sum = 0;
            for (var i = 0; i < order.Or.length; i++) {
                sum += order.Or[i].Price;
                str1 += '<tr>'
                    + '<td class="center">' + order.Or[i].Order_id + '</td>'
                    + '<td class="center">' + order.Or[i].Product_id + '</td>'
                if (order.Or[i].Size != 'null') {
                    str1 += '<td class="center">' + order.Or[i].Size + '</td>'
                } else {
                    str1 += '<td class="center">No size</td>'
                }
                str1 += '<td class="center">' + '$' + order.Or[i].Price + '</td>'
                    + '</tr>'
            }
            str1            += '</tbody>'
                        + '</table>'
                if (order.Note == null) {
                    order.Note = '';
                } else {
                    order.Note = order.Note
                }
                str1+= '<strong class="float-left">Note: </strong> <span>' + order.Note + '</span>'
                + '</div>'
                + '<div class="row">'
                    + '<div class="col-lg-4 col-sm-5 ml-auto">'
                        + '<table class="table table-clear">'
                            + '<tbody>'
                                + '<tr>'
                                    + '<td class="left">'
                                    + '<strong>Subtotal</strong>'
                                    + '</td>'
                                    + '<td class="right">' + sum.toFixed(2) + '</td>'
                                + ' </tr>'
                                + '<tr>'
                                    + '<td class="left">'
                                    + '<strong>Discount</strong>'
                                    + '</td>'
                                    + '<td class="right">' + order.Discount + '%' + '</td>'
                                + ' </tr>'
                                + '<tr>'
                                    + '<td class="left">'
                                    + '<strong>Shipping Fee</strong>'
                                    + '</td>'
                                    + '<td class="right">' + order.Shipping_Fee + '%' + '</td>'
                                + ' </tr>'
                                + '<tr>'
                                    + '<td class="left">'
                                    + '<strong>TAX</strong>'
                                    + '</td>'
                                    + '<td class="right">' + order.Tax + '%' + '</td>'
                                + '</tr>'
                                + '<tr>'
                                    + '<td class="left">'
                                    + '<strong>Total</strong>'
                                    + '</td>'
                                    + '<td class="right">'
                                    + '<strong>$' + (order.Total / 100).toFixed(2) + '</strong>'
                                    + '</td>'
                                + '</tr>'
                            + '</tbody>'
                        + '</table>'
                    + '</div>'
                + '</div>';

            var html = str1;
            $('#history').html(html);
        }
    })
}
$(function (data) {
    $('#account').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function () {
                $(document).find('span.error-text').text('');

            },
            success: function (data) {
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                    });
                }
                else if (data.status == 2) {
                    $('span.current_password_error').text(data.invalid);
                }
                else {
                    swal('Success', data.msg, 'success');
                    setInterval('location.reload()', 2500);
                }
            }
        })
    })
});

