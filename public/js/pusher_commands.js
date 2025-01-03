
Pusher.logToConsole = true;

var pusher = new Pusher('c269e7cb3a6819f86947', {
    cluster: 'ap1'
});
console.log('working')
var channel = pusher.subscribe('post-order');
channel.bind('post-event', function(data) {
    console.log(data)
    if(data.message != null && data.message != undefined){

        toastr.success(data.message)
    }
});
// var channel_reload = pusher.subscribe('reload-order');
// channel_reload.bind('reload-event', function(data) {
//     if(data.message != null && data.message != undefined){
//         toastr.success(data.message)
//
//     }
// });
