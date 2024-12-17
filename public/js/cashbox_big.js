// JavaScript

// Display element
let display = document.getElementById('display');
let display_card = document.getElementById('display_card');
let display_password = document.getElementById('display_password');
let cashier_password = document.getElementById('cashier_password')
let entered_cash_sum = '0'
let entered_card_sum = '0'
let cash_sum = 0
let card_sum = 0
let accepting_sum_int = 0
let leaving_sum_int = 0
let change_sum_int = 0
let klaviaturaNumber = 0

let getTotalSum = 0
let payment_sum = document.getElementById('payment_sum')
let accepting_sum = document.getElementById('accepting_sum')
let leaving_sum = document.getElementById('leaving_sum')
let change_sum = document.getElementById('change_sum')

let calculators = document.getElementById('calculators')
let cashCalculator = document.getElementById('cashCalculator')
let cardCalculator = document.getElementById('cardCalculator')
let cardContent = document.getElementById('cardContent')
let card_payment_ = document.getElementById('card_payment_')
let selected_product_name = document.getElementById('selected_product_name')
let selected_product_price = document.getElementById('selected_product_price')
let selected_product_amount = document.getElementById('selected_product_amount')
let selected_product_unit = document.getElementById('selected_product_unit')
let dotKeyboard = document.getElementById('dotKeyboard')
let is_set_mixed = false
let dot_has = false
let orderProductData = {}

function format_entered_sum(numbers){
    if(parseInt(numbers)>0){
        return parseInt(numbers).toLocaleString()
    }else{
        return 0
    }
}

function setValues(cash_sum_, card_sum_){
    display.value = format_entered_sum(cash_sum_); // Aks holda, raqamni qo'shamiz
    display_card.value = format_entered_sum(card_sum_); // Aks holda, raqamni qo'shamiz
    if(parseInt(getTotalSum) > (cash_sum_ + card_sum_)){
        accepting_sum.innerText = format_entered_sum(cash_sum_ + card_sum_); // Aks holda, raqamni qo'shamiz
        accepting_sum_int = cash_sum_ + card_sum_
        leaving_sum.innerText = format_entered_sum(parseInt(getTotalSum) - accepting_sum_int)
        leaving_sum_int = parseInt(getTotalSum) - accepting_sum_int
        change_sum.innerText = '0'
        change_sum_int = 0
    }else if(parseInt(getTotalSum) == (cash_sum_ + card_sum_)){
        accepting_sum.innerText = format_entered_sum(parseInt(getTotalSum)); // Aks holda, raqamni qo'shamiz
        accepting_sum_int = parseInt(getTotalSum)
        leaving_sum.innerText = '0'
        leaving_sum_int = 0
        change_sum.innerText = '0'
        change_sum_int = 0
    }else{
        accepting_sum.innerText = format_entered_sum(parseInt(getTotalSum)); // Aks holda, raqamni qo'shamiz
        accepting_sum_int = parseInt(getTotalSum)
        leaving_sum.innerText = '0'
        leaving_sum_int = 0
        change_sum.innerText = format_entered_sum(cash_sum_ + card_sum_ - parseInt(getTotalSum))
        change_sum_int = cash_sum_ + card_sum_ - parseInt(getTotalSum)
    }
}

// Function to append numbers to the display
function appendNumber(number) {
    if (display.value == '0') {
        entered_cash_sum = parseInt(number)
    } else {
        entered_cash_sum = String(entered_cash_sum) + number
    }
    cash_sum = parseInt(entered_cash_sum)
    if(is_set_mixed){
        autoSetCardSum()
    }
    setValues(cash_sum, card_sum)
}

// Function to append numbers to the display
function appendNumberCard(number) {
    if (display_card.value == '0') {
        entered_card_sum = parseInt(number)
    } else {
        entered_card_sum = String(entered_card_sum) + number
    }
    card_sum = parseInt(entered_card_sum)
    setValues(cash_sum, card_sum)
}

// Function to clear the display
function clearDisplay() {
    cash_sum = 0
    if(is_set_mixed){
        autoSetCardSum()
    }
    setValues(cash_sum, card_sum)
}

// Function to clear the display
function clearDisplayCard() {
    card_sum = 0
    setValues(cash_sum, card_sum)
}
// Function to remove the last digit (Backspace)
function backspace() {
    if (display.value.length > 1) {
        entered_cash_sum = String(entered_cash_sum).slice(0, -1)
        cash_sum = parseInt(entered_cash_sum)
        if(is_set_mixed){
            autoSetCardSum()
        }
        setValues(cash_sum, card_sum)
    } else {
        entered_cash_sum = '0'
        cash_sum = parseInt(entered_cash_sum)
        if(is_set_mixed){
            autoSetCardSum()
        }
        setValues(cash_sum, card_sum)
    }
}

// Function to remove the last digit (Backspace)
function backspaceCard() {
    if (display_card.value.length > 1) {
        entered_card_sum = String(entered_card_sum).slice(0, -1)
        card_sum = parseInt(entered_card_sum)
        setValues(cash_sum, card_sum)
    } else {
        entered_card_sum = '0'
        card_sum = parseInt(entered_card_sum)
        setValues(cash_sum, card_sum)
    }
}
// Function to append numbers to the display
function appendPassword(number) {
    if (display_password.value == '') {
        cashier_password.value = String(number)
        display_password.value = String(number); // Agar dastlabki raqam 0 bo'lsa, uni o'zgartiramiz
    } else {
        cashier_password.value = String(cashier_password.value) + String(number)
        display_password.value = cashier_password.value; // Aks holda, raqamni qo'shamiz
    }
}

display_password.addEventListener('input', function (event) {
    cashier_password.value = String(event.target.value)
    display_password.value = cashier_password.value; // Aks holda, raqamni qo'shamiz
})

// Function to clear the display
function clearDisplayPassword() {
    cashier_password.value = ''
    display_password.value = ''; // Ekrandagi raqamni tozalash
}

// Function to remove the last digit (Backspace)
function backspacePassword() {
    if (display_password.value.length > 1) {
        cashier_password.value = String(cashier_password.value).slice(0, -1)
        display_password.value = String(cashier_password.value); // Oxirgi belgini o'chirish
    } else {
        display_password.value = ''; // Agar faqat bir raqam qolgan bo'lsa, uni 0 ga o'zgartiramiz
        cashier_password.value = ''
    }
}
let selectedProductPrice = ''
let selectedProductAmount = ''
let product_element_quantity = ''
let product_element_sum = ''
let product_element_id = ''
let orderProduct_amount = ''
let orderProduct_barcode = ''
let orderProduct_discount = ''
let orderProduct_discount_percent = ''
let orderProduct_id = ''
let orderProduct_last_price = ''
let orderProduct_name = ''
let orderProduct_price = ''
let orderProduct_quantity = ''
let orderProduct_stock = ''
let orderProduct_unit = ''
let orderProduct_unit_id = ''
function editProductFunc(orderProduct){
    if(orderProduct != null && orderProduct != undefined){
        product_element_quantity = orderProduct.querySelector('td h6 .product__quantity')
        product_element_sum = orderProduct.querySelector('td h6 .product__sum')
    }
    orderProductData = JSON.parse(orderProduct.getAttribute('data-product'))
    if(Object.keys(orderProductData).length>0){
        selected_product_name.innerText = orderProductData.name + ' '+orderProductData.amount
        selected_product_price.value = orderProductData.quantity*parseInt(orderProductData.last_price.replace(/\s/g, ''), 10)
        selected_product_amount.value = parseFloat(orderProductData.quantity)
        selected_product_unit.innerText = orderProductData.unit
        selectedProductAmount = parseFloat(selected_product_amount.value)
        selectedProductPrice = parseInt(selected_product_price.value)/selectedProductAmount

        orderProduct_amount = parseFloat(orderProductData.amount)
        orderProduct_barcode = orderProductData.barcode
        orderProduct_discount = orderProductData.discount
        orderProduct_discount_percent = orderProductData.discount_percent
        orderProduct_id = orderProductData.id
        orderProduct_last_price = orderProductData.last_price
        orderProduct_name = orderProductData.name
        orderProduct_price = orderProductData.price
        orderProduct_quantity = parseFloat(orderProductData.quantity)
        orderProduct_stock = parseFloat(orderProductData.stock)
        orderProduct_unit = orderProductData.unit
        orderProduct_unit_id = orderProductData.unit_id
    }
}
let amount_or_price = ''
function selected_product_input_func(){
    setTimeout(function () {
        if(selected_product_amount.matches(":focus")){
            amount_or_price = 'amount'
            if(Object.keys(orderProductData).length>0){
                if([4, 7, 8, 10, 11].includes(parseInt(orderProductData.unit_id))){
                    if(dotKeyboard.classList.contains('d-none')){
                        dotKeyboard.classList.remove('d-none')
                    }
                }
            }
            display_edit_product = selected_product_amount
        }else{
            amount_or_price = 'price'
            if(!dotKeyboard.classList.contains('d-none')){
                dotKeyboard.classList.add('d-none')
            }
            display_edit_product = selected_product_price
        }
    }, 94)
}

selected_product_price.addEventListener('click', function () {
    selected_product_input_func()
})
selected_product_amount.addEventListener('click', function () {
    selected_product_input_func()
})
selected_product_input_func()

// Function to append numbers to the display
function appendEditProduct(number) {
    if (display_edit_product.value == '0' || display_edit_product.value == '') {
        if(dot_has){
            display_edit_product.value = '0.'+String(number);
        }else{
            display_edit_product.value = String(number);
        }
    } else {
        if(dot_has){
            display_edit_product.value = String(display_edit_product.value)+'.'+String(number);
        }else{
            display_edit_product.value = String(display_edit_product.value) + String(number);
        }
    }
    dot_has = false
    if(amount_or_price == 'amount'){
        selected_product_price.value = selectedProductPrice * parseFloat(display_edit_product.value)
    }else{
        selected_product_amount.value = parseInt(selected_product_price.value)/selectedProductPrice
    }
}

function appendDotEditProduct(){
    dot_has = true
}
document.addEventListener('keydown', function (event) {
    if (event.key === "Backspace") {
        if(selected_product_amount.matches(":focus")) {
            if (selected_product_amount.value.length > 1) {
                selected_product_amount.value = String(event.target.value).slice(0, -1); // Oxirgi belgini o'chirish
            } else {
                selected_product_amount.value = '0'; // Agar faqat bir raqam qolgan bo'lsa, uni 0 ga o'zgartiramiz
            }
        }
        if(selected_product_price.matches(":focus")) {
            if (selected_product_price.value.length > 1) {
                selected_product_price.value = String(event.target.value).slice(0, -1); // Oxirgi belgini o'chirish
            } else {
                selected_product_price.value = '0'; // Agar faqat bir raqam qolgan bo'lsa, uni 0 ga o'zgartiramiz
            }
        }
    }
});

function changePriceByAmount(amount__value){
    if(stock_int > 0) {
        if(amount__value == ''){
            dot_has = true
        }else{
            if(amount__value[0] == '.' && amount__value.length == 2){
                selected_product_amount.value = '0.'+String(amount__value).slice(0, 1); // Aks holda, raqamni qo'shamiz
            } else {
                selected_product_amount.value = String(amount__value); // Aks holda, raqamni qo'shamiz
            }
            selected_product_amount.value = String(amount__value);
            selected_product_price.value = selectedProductPrice * parseFloat(amount__value)
            dot_has = false
        }
    }
}

function changeAmountByPrice(price__value){
    if(stock_int > 0) {
        selected_product_price.value = String(price__value); // Aks holda, raqamni qo'shamiz
        selected_product_amount.value = parseInt(selected_product_price.value) / selectedProductPrice
    }
}

selected_product_amount.addEventListener('input', function (event) {
    is_exist = false
    changePriceByAmount(event.target.value)
})
selected_product_price.addEventListener('input', function (event) {
    changeAmountByPrice(event.target.value)
})

function changeAmountAndPrice(){
    element_id = ''
    if(product_element_quantity != '') {
        product_element_quantity.innerText = selected_product_amount.value
    }
    if(product_element_sum != '') {
        product_element_sum.innerText = selected_product_price.value
    }
    if(stock_int > 0) {
        orderProduct_stock = orderProduct_stock
        orderProduct_quantity = parseFloat(selected_product_amount.value)
        orderProduct_last_price = selected_product_price.value
        orderProduct_stock = orderProduct_stock - orderProduct_quantity
        if (order_data.length > 0) {
            for (let i = 0; i < order_data.length; i++) {
                if (order_data[i].id == orderProduct_id) {
                    if(orderProduct_quantity>0){
                        order_data[i].quantity = orderProduct_quantity
                    }else{
                        order_data.splice(i, 1)
                    }
                }
            }
        }
        if (order_data.length > 0) {
            showHasItems()
        } else {
            hideHasItems()
        }
        if (localStorage.getItem('order_data') != undefined && localStorage.getItem('order_data') != null) {
            localStorage.setItem('order_data', JSON.stringify(order_data))
        } else {
            localStorage.removeItem('order_data')
            localStorage.setItem('order_data', JSON.stringify(order_data))
        }
        if (order_data_content != undefined && order_data_content != null) {
            order_data_html = setOrderHtml(order_data)
            order_data_content.innerHTML = order_data_html
        }
        stock_int = orderProduct_stock;

        element_id_name = 'stock__'+orderProduct_id
        if(element_id_name.length == 8){
            element_id = document.getElementById(element_id_name)
        }
        if(element_id != null && element_id != undefined && element_id != '') {
            element_id.innerText = parseFloat(stock_int)
        }
    }

    if(Object.keys(orderProductData).length>0){
        selected_product_name.innerText = orderProductData.name + ' '+orderProductData.amount
        // selected_product_price.value = orderProduct_quantity*parseInt(orderProductData.last_price.replace(/\s/g, ''), 10)
        // selected_product_price.value = orderProduct_last_price
        // selected_product_amount.value = orderProduct_quantity
        selected_product_unit.innerText = orderProductData.unit
        selectedProductAmount = parseFloat(selected_product_amount.value)
        selectedProductPrice = parseInt(selected_product_price.value)/selectedProductAmount
    }
}

// Function to clear the display
function clearDisplayEditProduct() {
    display_edit_product.value = '0'; // Ekrandagi raqamni tozalash
    selected_product_amount.value = '0'; // Ekrandagi raqamni tozalash
    selected_product_price.value = '0'; // Ekrandagi raqamni tozalash
}

// Function to remove the last digit (Backspace)
function backspaceEditProduct() {
    if (display_edit_product.value.length > 1) {
        display_edit_product.value = String(display_edit_product.value).slice(0, -1); // Oxirgi belgini o'chirish
    } else {
        display_edit_product.value = '0'; // Agar faqat bir raqam qolgan bo'lsa, uni 0 ga o'zgartiramiz
    }
    if(amount_or_price == 'amount'){
        selected_product_price.value = selectedProductPrice * parseFloat(display_edit_product.value)
    }else{
        selected_product_amount.value = parseInt(selected_product_price.value)/selectedProductPrice
    }
}

function paymentFunc() {
    getTotalSum = total_all_left_sum
    payment_sum.innerText = format_entered_sum(getTotalSum)
    change_sum.innerText = '0'
}

let payment_types = document.querySelectorAll('#payment_modal .btn-outline-secondary')

function setPaymentTypes(button_){
    for(let ij = 0;ij<payment_types.length; ij++){
        if(payment_types[ij].classList.contains('active')){
            payment_types[ij].classList.remove('active')
        }
    }
    if(!button_.classList.contains('active')){
        button_.classList.add('active')
    }
}

function setCash(button__) {
    if(!cardContent.classList.contains('d-none')){
        cardContent.classList.add('d-none')
    }
    if(!cardCalculator.classList.contains('d-none')){
        cardCalculator.classList.add('d-none')
    }
    if(cashCalculator.classList.contains('d-none')){
        cashCalculator.classList.remove('d-none')
    }
    entered_cash_sum = '0'
    cash_sum = parseInt(entered_cash_sum)
    card_sum = 0
    is_set_mixed = false
    setValues(cash_sum, card_sum)
    setPaymentTypes(button__)
}
function setCard(button__) {
    if(cardContent.classList.contains('d-none')){
        cardContent.classList.remove('d-none')
    }
    if(!cashCalculator.classList.contains('d-none')){
        cashCalculator.classList.add('d-none')
    }
    if(!cardCalculator.classList.contains('d-none')){
        cardCalculator.classList.add('d-none')
    }
    card_payment_.value = format_entered_sum(getTotalSum)
    entered_card_sum = getTotalSum
    entered_cash_sum = '0'
    card_sum = parseInt(entered_card_sum)
    cash_sum = 0
    is_set_mixed = false
    setValues(cash_sum, card_sum)
    setPaymentTypes(button__)
}
function setMixed(button__) {
    if(!cardContent.classList.contains('d-none')){
        cardContent.classList.add('d-none')
    }
    if(cashCalculator.classList.contains('d-none')){
        cashCalculator.classList.remove('d-none')
    }
    if(cardCalculator.classList.contains('d-none')){
        cardCalculator.classList.remove('d-none')
    }
    is_set_mixed = true
    setValues(cash_sum, card_sum)
    setPaymentTypes(button__)
}

display.addEventListener('input', () => {
    klaviaturaNumber = 0
    klaviaturaNumber = formatInput(display).replace(/\s+/g, '')
    cash_sum = parseInt(klaviaturaNumber)
    if(is_set_mixed){
        autoSetCardSum()
    }
    setValues(cash_sum, card_sum)
});

display_card.addEventListener('input', () => {
    klaviaturaNumber = 0
    klaviaturaNumber = formatInput(display_card).replace(/\s+/g, '')
    card_sum = parseInt(klaviaturaNumber)
    setValues(cash_sum, card_sum)
});
function formatInput(param){
    // Faqat raqamlarni olamiz
    let value = param.value.replace(/\D/g, '');
    // Har 3 raqamdan keyin bo‘sh joy qo‘shamiz
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

    // Formatlangan qiymatni input maydoniga qaytaramiz

    if(value != '' && value != '0'){
        param.value = value;
    }else{
        param.value = '0'
    }
    return param.value
}
function autoSetCardSum(){
    if(parseInt(getTotalSum) - cash_sum>0){
        card_sum = parseInt(getTotalSum) - cash_sum
    }else{
        card_sum = 0
    }
}

function paymentPayFunc() {
    if(loader != undefined && loader != null){
        if(loader.classList.contains("d-none")){
            loader.classList.remove("d-none")
        }
    }
    if(myDiv != undefined && myDiv != null){
        if(!myDiv.classList.contains("d-none")){
            myDiv.classList.add("d-none")
        }
    }
    $(document).ready(function () {
        if(order_data.length>0){
            try{
                $.ajax({
                    url: "/../api/payment-pay",
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    data:{
                        'order_data':order_data,
                        'client_id':client_id,
                        'client_dicount_price':clientDicountPrice,
                        'paid_amount':accepting_sum_int,
                        'return_amount':change_sum_int,
                        'card_sum':card_sum,
                        'cash_sum':cash_sum,
                        // 'client_dicount_price':clientDicountPrice,
                    },
                    success: function (data) {
                        hideHasItems()
                        if(loader != undefined && loader != null){
                            if(!loader.classList.contains("d-none")){
                                loader.classList.add("d-none")
                            }
                        }
                        if(myDiv != undefined && myDiv != null){
                            if(myDiv.classList.contains("d-none")){
                                myDiv.classList.remove("d-none")
                            }
                        }
                        if(data.status == true){
                            if(localStorage.getItem('order_data') != undefined && localStorage.getItem('order_data') != null){
                                localStorage.removeItem('order_data')
                            }
                            window.location.href = cashbox_index+'?id='+data.order_id
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle errors here
                        console.log(xhr.responseText); // Log the error response from the server
                        toastr.error('An error occurred: ' + xhr.status + ' ' + error); // Show error message
                    }
                })
            }catch (e) {
                console.log(e)
            }
        }else{
            toastr.warning(ordered_fail_text)
        }
    })
}

