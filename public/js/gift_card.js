let coupon_type = document.getElementById('coupon_type')
let coupon_percent = document.getElementById('coupon_percent')
let coupon_price = document.getElementById('coupon_price')
let coupon_price_input = document.getElementById('coupon_price_input')
let coupon_percent_input = document.getElementById('coupon_percent_input')
if(current_page == 'edit'){
    if(coupon_price_value != ''){
        if(coupon_price.classList.contains('d-none')){
            coupon_price.classList.remove('d-none')
        }
        if(!coupon_percent.classList.contains('d-none')){
            coupon_percent.classList.add('d-none')
        }
        coupon_price_input.disabled = false
        coupon_percent_input.disabled = true
    }else if(coupon_percent_value != ''){
        if(coupon_percent.classList.contains('d-none')){
            coupon_percent.classList.remove('d-none')
        }
        if(!coupon_price.classList.contains('d-none')){
            coupon_price.classList.add('d-none')
        }
        coupon_percent_input.disabled = false
        coupon_price_input.disabled = true
    }
}
coupon_type.addEventListener('change', function () {
    if(coupon_type.value == 'percent'){
        if(coupon_percent.classList.contains('d-none')){
            coupon_percent.classList.remove('d-none')
        }
        if(!coupon_price.classList.contains('d-none')){
            coupon_price.classList.add('d-none')
        }
        coupon_percent_input.value = ''
        coupon_price_input.disabled = true
        coupon_percent_input.disabled = false
    }else if(coupon_type.value == 'price'){
        if(coupon_price.classList.contains('d-none')){
            coupon_price.classList.remove('d-none')
        }
        if(!coupon_percent.classList.contains('d-none')){
            coupon_percent.classList.add('d-none')
        }
        coupon_price_input.value = ''
        coupon_percent_input.disabled = true
        coupon_price_input.disabled = false
    }
})
