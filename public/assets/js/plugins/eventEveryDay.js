
var url = $("#urlWeb").val();
var user_id = ($("#user_id").val() != 'null')?$("#user_id").val():null;
var statusCheckedUser = Number($("#statusCheckedUser").val()) + 5;
function checkedEvent(){
    if(user_id == null){
        // return confirm("You must be logged in to comment on this product!");
        return swal({
            title: "Are you sure?",
            text: "You must be logged in to participate in this event!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              window.location('login');
            }
          });
    }else{
        let urlchecked = url +'/event/checkedEventEveryDay' ;
        $.ajax({
            url : urlchecked,
            type : "post",
            cache: false,
            dataType:"text",
            data : {
                _token: $("#csrf_token").val()
            },
            success : function (result){
                if(result){
                    let htmlcheck = '<p class="checkedIcon"><i class="bi-check-circle" ></i></p>';
                    $("#tagACheckToday").html(htmlcheck);
                    swal('Success','You Get '+statusCheckedUser+' Points','success');

                }
            }
        });
    }
}