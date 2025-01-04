
Pusher.logToConsole = true;

var pusher = new Pusher('c269e7cb3a6819f86947', {
    cluster: 'ap1'
});
var channel = pusher.subscribe('post-order');
channel.bind('post-event', function(data) {
    console.log(data)
    if(data.users_id != null && data.users_id != undefined){
        if(data.users_id.length>0){
            if(data.users_id.includes(current_user_id)){
                if(data.message != null && data.message != undefined){
                    toastr.success(data.message)
                    getAllNotifications()
                }
            }
        }
    }
});
let current_user_notifications = document.getElementById('current_user_notifications')
let notification_html = ''
function getAllNotifications(){
    console.log('working')
    notification_html = ''
    $(document).ready(function () {
        $.ajax({
            url: get_notifications_url,
            type:'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept':'application/json'
            },
            data:{
                'id':bill_id,
                'data':selected_sales_items_object
            },
            success: function (data) {
                console.log(data)
                setTimeout(function () {
                    if(data.status == true && data.data.length>0){
                        notification_html = `
                        <a href="${cashier_product_url.replaceAll('=', data.product_id)}" class="dropdown-item notify-item">
                            <div class="notify-icon" style="background-image: url(${data.data.product_image})"></div>
                            <p class="notify-details">
                                <small>${data.message}</small>
                            </p>
                        </a>
                        <hr style="margin: 0px">`
                    current_user_notifications.appendChild(notification_html)
                    }else{
                        notification_html = `<a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                            ${no_notification_text}
                            <i class="fe-arrow-right"></i>
                        </a>`
                    }
                    current_user_notifications.innerText = ''
                    current_user_notifications.appendChild(notification_html)
                }, 244)
            },
            error: function (e) {
                console.log(e)
            }
        })
    })
}


// var channel_reload = pusher.subscribe('reload-order');
// channel_reload.bind('reload-event', function(data) {
//     if(data.message != null && data.message != undefined){
//         toastr.success(data.message)
//
//     }
// });
