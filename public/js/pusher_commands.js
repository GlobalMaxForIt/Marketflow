//
// Pusher.logToConsole = true;
//
// var pusher = new Pusher('c269e7cb3a6819f86947', {
//     cluster: 'ap1'
// });
//
// let notification_html = ''
// let currentUnread = 0
//
// var channel = pusher.subscribe('post-order');
// channel.bind('post-event', function(data) {
//     if(data.users_id != null && data.users_id != undefined){
//         if(data.users_id.length>0){
//             if(data.users_id.includes(parseInt(current_user_id)) || data.users_id.includes(current_user_id)){
//                 if(data.product_data != null && data.product_data != undefined && data.product_data){
//                     if(data.product_data.message != null && data.product_data.message != undefined && data.product_data.message){
//                         toastr.success(data.product_data.message)
//                     }
//                     getAllNotifications(data.product_data)
//                 }
//             }
//         }
//     }
// });
//
// if(unread_notifications_quantity != undefined && unread_notifications_quantity != null){
//     let currentUnread = parseInt(unread_notifications_quantity.innerText);
//     if (isNaN(currentUnread)) {
//         currentUnread = 0;
//     }
// }
// function getAllNotifications(product_data){
//     if(unread_notifications_quantity == undefined && unread_notifications_quantity == null){
//         let unread_notifications_quantity = document.getElementById('unread_notifications_quantity')
//     }
//     if(current_user_notifications == undefined && current_user_notifications == null){
//         let current_user_notifications = document.getElementById('current_user_notifications')
//     }
//     if(current_user_no_notifications == undefined && current_user_no_notifications == null){
//         let current_user_no_notifications = document.getElementById('current_user_no_notifications')
//     }
//     if(current_user_no_notifications != undefined && current_user_no_notifications != null){
//         if(!current_user_no_notifications.classList.contains('d-none')){
//             current_user_no_notifications.classList.add('d-none')
//         }
//     }
//     currentUnread = currentUnread+1
//     notification_html = ''
//     setTimeout(function () {
//         notification_html = `
//         <a href="${cashier_product_url.replaceAll('=', product_data.product_id)}" class="dropdown-item notify-item">
//             <div class="notify-icon" style="background-image: url(${product_data.product_image})"></div>
//             <p class="notify-details">
//                 <small>${product_data.message}</small>
//             </p>
//         </a>
//         <hr style="margin: 0px">`
//         if(current_user_notifications != undefined && current_user_notifications != null) {
//             current_user_notifications.insertAdjacentHTML('beforeend', notification_html);
//         }
//         if(unread_notifications_quantity != undefined && unread_notifications_quantity != null) {
//             if(unread_notifications_quantity.classList.contains('d-none')){
//                 unread_notifications_quantity.classList.remove('d-none')
//             }
//             unread_notifications_quantity.innerText = currentUnread
//         }
//     }, 244)
// }


// var channel_reload = pusher.subscribe('reload-order');
// channel_reload.bind('reload-event', function(data) {
//     if(data.message != null && data.message != undefined){
//         toastr.success(data.message)
//
//     }
// });
