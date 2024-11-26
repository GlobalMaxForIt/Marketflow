let languages_url="/super-admin/language/language/update/value"
function copyTranslation() {
    let old_value = ''
    $('.lang_key').each(function(index) {
        var _this = $(this); // "this" ni saqlaymiz
        var currentStatus = _this.text();
        setTimeout(function() {
            // Yangi shart qo'yish: Agar status o'zgarmagan bo'lsa, so'rov yubormaslik
            console.log(currentStatus)
            $.post(languages_url, {
                _token: $('input[name=_token]').val(),
                id: index,
                code: document.getElementById("language_code").value,
                status: currentStatus // statusni yuboramiz
            }, function(data) {
                _this.siblings('.lang_value').find('input').val(data); // Javobni o'zgartiramiz
            });
        }, 444 * index);  // Har bir key uchun intervalni uzaytirish
    });
}

function sort_keys(el) {
    // formni submit qilishni oldini olish
    el.preventDefault();
    $('#sort_keys').submit();
}
