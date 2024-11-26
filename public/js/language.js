let languages_url="/super-admin/language/language/update/value"
function copyTranslation() {
    $('.lang_key').each(function(index) {
        var _this = $(this)
            setTimeout(function () {
                $.post(languages_url, {
                    _token: $('input[name=_token]').val(),
                    id: index,
                    code: document.getElementById("language_code").value,
                    status: $(this).text()
                }, function(data) {
                    const tsestQ = document.getElementsByClassName("value");
                    _this.siblings('.lang_value').find('input').val(data);
                });
            }, 444)
        });
    }

    function sort_keys(el) {
        // formni submit qilishni oldini olish
        el.preventDefault();
        $('#sort_keys').submit();
    }
